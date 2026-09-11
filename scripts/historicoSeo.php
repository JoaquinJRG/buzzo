<?php

abstract class ApiSeranking
{
    protected $apiUrl;
    protected $apiKey;
    protected $domain;

    public function __construct(string $apiKey, string $domain = "")
    {
        $this->apiUrl = "https://api.seranking.com/v1/";
        $this->apiKey = $apiKey;
        $this->domain = $domain;
    }

    // Método para crear el recurso cURL configurado
    public function createCurlHandle(string $method, string $endpoint, $data = null)
    {
        $url = "{$this->apiUrl}{$endpoint}";

        $ch = curl_init($url);
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "Authorization: Token {$this->apiKey}",
                "Content-Type: application/json"
            ],
            CURLOPT_CUSTOMREQUEST => $method,
        ];

        if ($data) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        curl_setopt_array($ch, $options);
        return $ch;
    }

    // Método para realizar solicitudes individuales
    protected function request($method, $endpoint, $data = null)
    {
        $maxAttempts = 3;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $ch = $this->createCurlHandle($method, $endpoint, $data);
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                throw new Exception("Error CURL: $error");
            }

            if ($statusCode === 429 && $attempt < $maxAttempts) {
                usleep((2 ** ($attempt - 1)) * 1000000);
                continue;
            }

            if ($statusCode >= 400) {
                throw new Exception("Error API (HTTP $statusCode): $response");
            }

            return json_decode($response, true);
        }

        throw new Exception("Error API (HTTP 429): demasiadas solicitudes");
    }

    public static function multiRequest(array $handles): array
    {
        $mh = curl_multi_init();
        foreach ($handles as $key => $ch) {
            curl_multi_add_handle($mh, $ch);
        }

        $running = null;
        do {
            $status = curl_multi_exec($mh, $running);
            if ($running > 0) {
                if (curl_multi_select($mh) === -1) {
                    usleep(10000);
                }
            }
        } while ($running > 0 && $status === CURLM_OK);

        $results = [];
        foreach ($handles as $key => $ch) {
            $response = curl_multi_getcontent($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);

            if ($error) {
                $results[$key] = ['success' => false, 'error' => "Error CURL: $error", 'data' => []];
            } elseif ($statusCode >= 400) {
                $results[$key] = ['success' => false, 'error' => "Error API (HTTP $statusCode): $response", 'data' => []];
            } else {
                $decoded = json_decode($response, true);
                $results[$key] = ['success' => true, 'data' => is_array($decoded) ? $decoded : []];
            }
        }

        curl_multi_close($mh);
        return $results;
    }
}

class HistoricoPago extends ApiSeranking
{
    protected function extraerDatosHistoricoPago(array $datos): array
    {
        return [
            "keywords_count" => $datos['keywords_count'] ?? 0,
            "traffic_sum" => $datos['traffic_sum'] ?? 0,
            "price_sum" => $datos['price_sum'] ?? 0,
            "year" => $datos['year'] ?? 0,
            "month" => $datos['month'] ?? 0,
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/overview/history?source=es&domain={$this->domain}&limit={$limit}&type=adv&with_subdomains=true";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $historico = $datos['history'] ?? $datos;

        if (!is_array($historico)) {
            return [];
        }

        $resultado = array_map(
            fn(array $item): array => $this->extraerDatosHistoricoPago($item),
            $historico
        );
        return array_slice($resultado, 0, $limit);
    }

    public function obtenerHistoricoPago(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($res) ? $res : [], $limit);
    }
}

class HistoricoOrganico extends ApiSeranking
{

    protected function extraerDatosHistoricoOrganico(array $datos): array
    {
        return [
            "keywords_count" => $datos['keywords_count'] ?? 0,
            "traffic_sum" => $datos['traffic_sum'] ?? 0,
            "price_sum" => $datos['price_sum'] ?? 0,
            "year" => $datos['year'] ?? 0,
            "month" => $datos['month'] ?? 0,
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/overview/history?source=es&domain={$this->domain}&limit={$limit}&type=organic&with_subdomains=true";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $historico = $datos['history'] ?? $datos;

        if (!is_array($historico)) {
            return [];
        }

        $resultado = array_map(
            fn(array $item): array => $this->extraerDatosHistoricoOrganico($item),
            $historico
        );
        return array_slice($resultado, 0, $limit);
    }

    public function obtenerHistoricoOrganico(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($res) ? $res : [], $limit);
    }
}

class BackLinkSummary extends ApiSeranking
{
    public function getEndpoint(): string
    {
        return "backlinks/summary?source=es&target={$this->domain}&mode=domain";
    }

    public function obtenerBackLinkSummary(): array
    {
        $res = $this->request("GET", $this->getEndpoint());
        return is_array($res) ? $res : [];
    }
}

class BackLinkAuthority extends ApiSeranking
{
    public function getEndpoint(): string
    {
        return "backlinks/authority?source=es&target={$this->domain}&mode=domain";
    }

    public function obtenerBackLinkAuthority(): array
    {
        $res = $this->request("GET", $this->getEndpoint());
        return is_array($res) ? $res : [];
    }
}

class Overview extends ApiSeranking
{
    public function getEndpoint(): string
    {
        return "domain/overview/db?source=es&domain={$this->domain}&with_subdomains=true";
    }

    public function obtenerOverview(): array
    {
        $res = $this->request("GET", $this->getEndpoint());
        return is_array($res) ? $res : [];
    }
}

try {
    $apiKey = "f8f1935c-2ff4-84a6-471a-af8f241f8e8c";
    $domain = $_REQUEST['domain'];

    $historicoPago = new HistoricoPago($apiKey, $domain);
    $historicoOrganico = new HistoricoOrganico($apiKey, $domain);
    $backLinkSummary = new BackLinkSummary($apiKey, $domain);
    $backLinkAuthority = new BackLinkAuthority($apiKey, $domain);
    $overview = new Overview($apiKey, $domain);

    $datosHistoricoPago = $historicoPago->obtenerHistoricoPago(100);
    $datosHistoricoOrganico = $historicoOrganico->obtenerHistoricoOrganico(100);
    $datosBackLinkSummary = $backLinkSummary->obtenerBackLinkSummary();
    $datosBackLinkAuthority = $backLinkAuthority->obtenerBackLinkAuthority();
    $datosOverview = $overview->obtenerOverview();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => true,
        'historicoPago' => $datosHistoricoPago,
        'historicoOrganico' => $datosHistoricoOrganico,
        'backLinkSummary' => $datosBackLinkSummary,
        'backLinkAuthority' => $datosBackLinkAuthority,
        'datosOverview' => $datosOverview,
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'HTTP 429') !== false) {
        http_response_code(429);
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}
