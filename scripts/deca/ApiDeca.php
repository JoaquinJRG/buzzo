<?php

declare(strict_types=1);

class ApiDeca
{
    private string $baseUrl;
    private string $clientId;
    private string $keyId;
    private string $secret;

    public function __construct(
        string $baseUrl = 'https://dev.api.cubetic.cloud',
        string $clientId = '01M3ANRZHJ7HXH9B2MVDQFXTPE',
        string $keyId = '01M3ANRZJYCK12DTGQE6KWV4CM',
        string $secret = 'NJKmMjZu2IpTtDM3_837SMY_ZFoXKhynFKQhSizdyDo'
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->clientId = $clientId;
        $this->keyId = $keyId;
        $this->secret = $secret;
    }

    /**
     * Normalización canónica de query string según la especificación RFC 3986
     */
    public function normalizeQuery(string $queryString): string
    {
        $queryString = ltrim($queryString, '?');
        if ($queryString === '') {
            return '';
        }

        $parts = explode('&', $queryString);
        $pairs = [];
        foreach ($parts as $part) {
            if ($part === '') {
                continue;
            }
            $eqPos = strpos($part, '=');
            if ($eqPos === false) {
                $k = rawurldecode($part);
                $v = '';
            } else {
                $k = rawurldecode(substr($part, 0, $eqPos));
                $v = rawurldecode(substr($part, $eqPos + 1));
            }
            $pairs[] = [
                'key' => rawurlencode($k),
                'val' => rawurlencode($v),
            ];
        }

        // Ordenar por key ascendente; en caso de empate, por value ascendente
        usort($pairs, function ($a, $b) {
            $cmp = strcmp($a['key'], $b['key']);
            if ($cmp !== 0) {
                return $cmp;
            }
            return strcmp($a['val'], $b['val']);
        });

        $normalized = [];
        foreach ($pairs as $p) {
            $normalized[] = $p['key'] . '=' . $p['val'];
        }

        return implode('&', $normalized);
    }

    /**
     * Envío de petición HTTP con firma HMAC-SHA256
     */
    public function request(
        string $method,
        string $path,
        string $companyId,
        string $userId,
        array $scopes,
        $body = null,
        array $queryParams = [],
        array $additionalHeaders = []
    ): array {
        $method = strtoupper($method);

        // Convertir query params a string y normalizar
        $queryString = http_build_query($queryParams);
        $normalizedQuery = $this->normalizeQuery($queryString);

        $url = $this->baseUrl . $path;
        if ($normalizedQuery !== '') {
            $url .= '?' . $normalizedQuery;
        }

        // Serializar body
        $bodyString = '';
        if ($body !== null) {
            $bodyString = is_string($body) ? $body : json_encode($body, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        // Construir contexto exacto
        $contextArray = [
            'company_id' => $companyId,
            'user_id' => $userId,
            'scopes' => array_values($scopes),
        ];
        $contextString = json_encode($contextArray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // Generar timestamp y nonce
        $timestamp = (string) time();
        $nonce = bin2hex(random_bytes(16)); // 32 caracteres alfanuméricos
        $bodyHash = hash('sha256', $bodyString);

        // Canonical request de 7 líneas exactas sin salto final
        $canonicalLines = [
            $method,
            $path,
            $normalizedQuery,
            $timestamp,
            $nonce,
            $contextString,
            $bodyHash,
        ];
        $canonicalRequest = implode("\n", $canonicalLines);

        // Firma HMAC-SHA256
        $signature = hash_hmac('sha256', $canonicalRequest, $this->secret);

        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
            'X-Buzzo-Client-Id: ' . $this->clientId,
            'X-Buzzo-Key-Id: ' . $this->keyId,
            'X-Buzzo-Timestamp: ' . $timestamp,
            'X-Buzzo-Nonce: ' . $nonce,
            'X-Buzzo-Context: ' . $contextString,
            'X-Buzzo-Signature: ' . $signature,
        ];
        foreach ($additionalHeaders as $header) {
            $headers[] = $header;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($bodyString !== '') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyString);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $responseBody = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            throw new Exception("Error cURL: " . $curlError);
        }

        $decoded = json_decode($responseBody, true);

        return [
            'http_code' => $httpCode,
            'success' => ($httpCode >= 200 && $httpCode < 300),
            'data' => $decoded['data'] ?? $decoded,
            'meta' => $decoded['meta'] ?? null,
            'raw' => $responseBody,
        ];
    }

    // ==========================================
    // MÉTODOS DE APROVISIONAMIENTO (PROVISIONING)
    // ==========================================

    public function provisionCompany(string $companyId, array $data): array
    {
        return $this->request(
            'PUT',
            "/api/v1/buzzo/provisioning/companies/{$companyId}",
            $companyId,
            'system',
            ['buzzo.provisioning.companies.write'],
            $data
        );
    }

    public function provisionWorker(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'PUT',
            "/api/v1/buzzo/provisioning/companies/{$companyId}/workers/{$userId}",
            $companyId,
            $userId,
            ['buzzo.provisioning.workers.write'],
            $data
        );
    }

    public function provisionService(string $companyId, string $serviceCode, array $data = ['status' => 'active']): array
    {
        return $this->request(
            'PUT',
            "/api/v1/buzzo/provisioning/companies/{$companyId}/services/{$serviceCode}",
            $companyId,
            'system',
            ['buzzo.provisioning.services.write'],
            $data
        );
    }

    /**
     * Provisiona una empresa y activa el servicio Transport Compliance.
     *
     * El endpoint de provisioning es idempotente: se puede volver a ejecutar
     * para reconciliar una empresa existente.
     */
    public function provisionTransportComplianceCompany(
        string $companyId,
        array $companyData,
        array $serviceData = ['status' => 'active']
    ): array {
        $company = $this->provisionCompany($companyId, $companyData);
        if (!$company['success']) {
            throw new RuntimeException(
                "No se pudo provisionar la empresa {$companyId}: {$company['raw']}"
            );
        }

        $service = $this->provisionService(
            $companyId,
            'transport-compliance',
            $serviceData
        );
        if (!$service['success']) {
            throw new RuntimeException(
                "No se pudo activar Transport Compliance para la empresa {$companyId}: {$service['raw']}"
            );
        }

        return [
            'company' => $company,
            'service' => $service,
        ];
    }

    public function provisionWorkerInService(string $companyId, string $userId, string $serviceCode = 'project-management', array $data = ['status' => 'active']): array
    {
        return $this->request(
            'PUT',
            "/api/v1/buzzo/provisioning/companies/{$companyId}/services/{$serviceCode}/workers/{$userId}",
            $companyId,
            $userId,
            ['buzzo.provisioning.service-workers.write'],
            $data
        );
    }

    // ==========================================
    // TRANSPORT COMPLIANCE (DECA)
    // ==========================================

    public function getServiceStatus(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/service-status',
            $companyId,
            $userId,
            ['tc.settings.read'],
            null,
            $queryParams
        );
    }

    public function listOperations(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/operations',
            $companyId,
            $userId,
            ['tc.operations.read'],
            null,
            $queryParams
        );
    }

    public function createOperation(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/operations',
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function getOperation(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/operations/{$publicId}",
            $companyId,
            $userId,
            ['tc.operations.read']
        );
    }

    public function updateOperation(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/operations/{$publicId}",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function createOperationParty(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/parties",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function assignOperationVehicle(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PUT',
            "/api/v1/transport-compliance/operations/{$publicId}/vehicle",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function assignOperationDriver(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PUT',
            "/api/v1/transport-compliance/operations/{$publicId}/driver",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function markOperationReady(string $companyId, string $userId, string $publicId, array $data = []): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/ready",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function issueOperation(string $companyId, string $userId, string $publicId, array $data = []): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/issue",
            $companyId,
            $userId,
            ['tc.documents.issue'],
            $data
        );
    }

    public function listOperationVersions(string $companyId, string $userId, string $publicId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/operations/{$publicId}/versions",
            $companyId,
            $userId,
            ['tc.documents.read'],
            null,
            $queryParams
        );
    }

    public function issueReplacementVersion(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/versions",
            $companyId,
            $userId,
            ['tc.documents.issue'],
            $data
        );
    }

    public function getOperationVersionPdf(string $companyId, string $userId, string $publicId, string $versionPublicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/operations/{$publicId}/versions/{$versionPublicId}/pdf",
            $companyId,
            $userId,
            ['tc.documents.read']
        );
    }

    public function startOperation(string $companyId, string $userId, string $publicId, array $data = []): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/start",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function completeOperation(string $companyId, string $userId, string $publicId, array $data = []): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/complete",
            $companyId,
            $userId,
            ['tc.operations.manage'],
            $data
        );
    }

    public function createDriverGrant(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/driver-grants",
            $companyId,
            $userId,
            ['tc.grants.manage'],
            $data
        );
    }

    public function revokeDriverGrant(string $companyId, string $userId, string $publicId, string $grantPublicId, array $data = []): array
    {
        return $this->request(
            'POST',
            "/api/v1/transport-compliance/operations/{$publicId}/driver-grants/{$grantPublicId}/revoke",
            $companyId,
            $userId,
            ['tc.grants.manage'],
            $data
        );
    }

    public function listPartyDocuments(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/party-documents',
            $companyId,
            $userId,
            ['tc.documents.party_read'],
            null,
            $queryParams
        );
    }

    public function getPartyDocument(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/party-documents/{$publicId}",
            $companyId,
            $userId,
            ['tc.documents.party_read']
        );
    }

    public function listPartyDocumentVersions(string $companyId, string $userId, string $publicId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/party-documents/{$publicId}/versions",
            $companyId,
            $userId,
            ['tc.documents.party_read'],
            null,
            $queryParams
        );
    }

    public function getPartyDocumentVersionPdf(string $companyId, string $userId, string $publicId, string $versionPublicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/party-documents/{$publicId}/versions/{$versionPublicId}/pdf",
            $companyId,
            $userId,
            ['tc.documents.party_read']
        );
    }

    public function getAgendaSummary(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function listAgendaCounterparts(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda/counterparts',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function createAgendaCounterpart(string $companyId, string $userId, array $data, ?string $idempotencyKey = null): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/agenda/counterparts',
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data,
            [],
            ['Idempotency-Key: ' . ($idempotencyKey ?? bin2hex(random_bytes(16)))]
        );
    }

    public function getAgendaCounterpart(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/agenda/counterparts/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.read']
        );
    }

    public function updateAgendaCounterpart(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/agenda/counterparts/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data
        );
    }

    public function archiveAgendaCounterpart(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'DELETE',
            "/api/v1/transport-compliance/agenda/counterparts/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage']
        );
    }

    public function listAgendaAddresses(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda/addresses',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function createAgendaAddress(string $companyId, string $userId, array $data, ?string $idempotencyKey = null): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/agenda/addresses',
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data,
            [],
            ['Idempotency-Key: ' . ($idempotencyKey ?? bin2hex(random_bytes(16)))]
        );
    }

    public function getAgendaAddress(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/agenda/addresses/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.read']
        );
    }

    public function updateAgendaAddress(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/agenda/addresses/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data
        );
    }

    public function archiveAgendaAddress(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'DELETE',
            "/api/v1/transport-compliance/agenda/addresses/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage']
        );
    }

    public function listAgendaVehicles(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda/vehicles',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function createAgendaVehicle(string $companyId, string $userId, array $data, ?string $idempotencyKey = null): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/agenda/vehicles',
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data,
            [],
            ['Idempotency-Key: ' . ($idempotencyKey ?? bin2hex(random_bytes(16)))]
        );
    }

    public function getAgendaVehicle(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/agenda/vehicles/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.read']
        );
    }

    public function updateAgendaVehicle(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/agenda/vehicles/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data
        );
    }

    public function archiveAgendaVehicle(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'DELETE',
            "/api/v1/transport-compliance/agenda/vehicles/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage']
        );
    }

    public function listAgendaDrivers(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda/drivers',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function createAgendaDriver(string $companyId, string $userId, array $data, ?string $idempotencyKey = null): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/agenda/drivers',
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data,
            [],
            ['Idempotency-Key: ' . ($idempotencyKey ?? bin2hex(random_bytes(16)))]
        );
    }

    public function getAgendaDriver(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/agenda/drivers/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.read']
        );
    }

    public function updateAgendaDriver(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/agenda/drivers/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data
        );
    }

    public function archiveAgendaDriver(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'DELETE',
            "/api/v1/transport-compliance/agenda/drivers/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage']
        );
    }

    public function listAgendaAuthorizations(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/transport-compliance/agenda/authorizations',
            $companyId,
            $userId,
            ['tc.agenda.read'],
            null,
            $queryParams
        );
    }

    public function createAgendaAuthorization(string $companyId, string $userId, array $data, ?string $idempotencyKey = null): array
    {
        return $this->request(
            'POST',
            '/api/v1/transport-compliance/agenda/authorizations',
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data,
            [],
            ['Idempotency-Key: ' . ($idempotencyKey ?? bin2hex(random_bytes(16)))]
        );
    }

    public function getAgendaAuthorization(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/transport-compliance/agenda/authorizations/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.read']
        );
    }

    public function updateAgendaAuthorization(string $companyId, string $userId, string $publicId, array $data): array
    {
        return $this->request(
            'PATCH',
            "/api/v1/transport-compliance/agenda/authorizations/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage'],
            $data
        );
    }

    public function archiveAgendaAuthorization(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'DELETE',
            "/api/v1/transport-compliance/agenda/authorizations/{$publicId}",
            $companyId,
            $userId,
            ['tc.agenda.manage']
        );
    }

    
}
