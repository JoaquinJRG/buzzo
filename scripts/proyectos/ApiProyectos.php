<?php

declare(strict_types=1);

/**
 * Cliente de integración Buzzo <-> API de Servicios Cubetic
 * Basado en la especificación HMAC-SHA256 y API Project Management.
 */
class ApiProyectos
{
    private string $baseUrl;
    private string $clientId;
    private string $keyId;
    private string $secret;

    public function __construct(
        string $baseUrl = 'https://dev.api.cubetic.cloud',
        string $clientId = '01M2HY5Z0A5MK3EPEY42Z1GRSG',
        string $keyId = '01M2HY5Z1RZQNDD4JQPS8YY4FZ',
        string $secret = 'ZCbxsRYAeOujhdWNd16E6xbJrMpPXXuOs3of_CHV-Co'
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
        array $queryParams = []
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

    public function provisionService(string $companyId, string $serviceCode = 'project-management', array $data = ['status' => 'active']): array
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
    // GESTIÓN DE PROYECTOS (PROJECT MANAGEMENT)
    // ==========================================

    public function getProjects(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/projects',
            $companyId,
            $userId,
            ['pm.projects.read'],
            null,
            $queryParams
        );
    }

    public function getProject(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/project-management/projects/{$publicId}",
            $companyId,
            $userId,
            ['pm.projects.read']
        );
    }

    public function createProject(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'POST',
            '/api/v1/project-management/projects',
            $companyId,
            $userId,
            ['pm.projects.write'],
            $data
        );
    }

    public function getClients(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/clients',
            $companyId,
            $userId,
            ['pm.clients.read'],
            null,
            $queryParams
        );
    }

    public function getClient(string $companyId, string $userId, string $publicId): array
    {
        return $this->request(
            'GET',
            "/api/v1/project-management/clients/{$publicId}",
            $companyId,
            $userId,
            ['pm.clients.read']
        );
    }

    public function createClient(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'POST',
            '/api/v1/project-management/clients',
            $companyId,
            $userId,
            ['pm.clients.write'],
            $data
        );
    }

    public function getTasks(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/tasks',
            $companyId,
            $userId,
            ['pm.tasks.read'],
            null,
            $queryParams
        );
    }

    public function getWorkReports(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/work-reports',
            $companyId,
            $userId,
            ['pm.work-reports.read'],
            null,
            $queryParams
        );
    }

    public function getPlanning(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/planning',
            $companyId,
            $userId,
            ['pm.planning.read'],
            null,
            $queryParams
        );
    }

    public function getNotices(string $companyId, string $userId, array $queryParams = []): array
    {
        return $this->request(
            'GET',
            '/api/v1/project-management/notices',
            $companyId,
            $userId,
            ['pm.notices.read'],
            null,
            $queryParams
        );
    }

    public function getReportHoursByProject(string $companyId, string $userId, string $from, string $to, array $queryParams = []): array
    {
        $queryParams['from'] = $from;
        $queryParams['to'] = $to;

        return $this->request(
            'GET',
            '/api/v1/project-management/reports/hours-by-project',
            $companyId,
            $userId,
            ['pm.reports.read'],
            null,
            $queryParams
        );
    }

    public function getReportHoursByWorker(string $companyId, string $userId, string $from, string $to, array $queryParams = []): array
    {
        $queryParams['from'] = $from;
        $queryParams['to'] = $to;

        return $this->request(
            'GET',
            '/api/v1/project-management/reports/hours-by-worker',
            $companyId,
            $userId,
            ['pm.reports.read'],
            null,
            $queryParams
        );
    }

    public function createNotice(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'POST',
            '/api/v1/project-management/notices',
            $companyId,
            $userId,
            ['pm.notices.manage'],
            $data
        );
    }

    public function createPlanning(string $companyId, string $userId, array $data): array
    {
        return $this->request(
            'POST',
            '/api/v1/project-management/planning',
            $companyId,
            $userId,
            ['pm.planning.manage'],
            $data
        );
    }
}


