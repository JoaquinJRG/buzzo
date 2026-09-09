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
        $ch = $this->createCurlHandle($method, $endpoint, $data);
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception("Error CURL: $error");
        }

        if ($statusCode >= 400) {
            throw new Exception("Error API (HTTP $statusCode): $response");
        }

        return json_decode($response, true);
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

class Competencia extends ApiSeranking
{
    protected function extraerDatosCompetencia(array $datos): array
    {
        return [
            "domain" => $datos['domain'] ?? '',
            "keywords" => $datos['common_keywords'] ?? 0,
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/competitors?source=es&domain={$this->domain}&limit={$limit}&type=organic&stats=1";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $competidores = $datos['competitors'] ?? $datos;

        if (!is_array($competidores)) {
            return [];
        }

        $resultado = array_map(
            fn(array $competidor): array => $this->extraerDatosCompetencia($competidor),
            $competidores
        );

        return array_slice($resultado, 0, $limit);
    }

    public function obtenerCompetencia(int $limit = 10): array
    {
        $competencia = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($competencia) ? $competencia : [], $limit);
    }
}

class MejorPosicion extends ApiSeranking
{
    protected function extraerDatosMejorPosicion(array $datos): array
    {
        return [
            "keyword" => $datos['keyword'] ?? '',
            "position" => $datos['position'] ?? 0,
            "volume" => $datos['volume'] ?? 0,
            "traffic" => $datos['traffic'] ?? 0,
            "url" => $datos['url'] ?? '',
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/keywords?source=es&domain={$this->domain}&limit={$limit}&order_field=position&order_type=asc";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $keywords = $datos['keywords'] ?? $datos;

        if (!is_array($keywords)) {
            return [];
        }

        $resultado = array_map(
            fn(array $item): array => $this->extraerDatosMejorPosicion($item),
            $keywords
        );

        return array_slice($resultado, 0, $limit);
    }

    public function obtenerMejorPosicion(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($res) ? $res : [], $limit);
    }
}

class VolumenBusqueda extends ApiSeranking
{
    protected function extraerDatosVolumenBusqueda(array $datos): array
    {
        return [
            "keyword" => $datos['keyword'] ?? '',
            "position" => $datos['position'] ?? 0,
            "volume" => $datos['volume'] ?? 0,
            "traffic" => $datos['traffic'] ?? 0,
            "url" => $datos['url'] ?? '',
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/keywords?source=es&domain={$this->domain}&limit={$limit}&order_field=volume&order_type=desc";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $keywords = $datos['keywords'] ?? $datos;

        if (!is_array($keywords)) {
            return [];
        }

        $resultado = array_map(
            fn(array $item): array => $this->extraerDatosVolumenBusqueda($item),
            $keywords
        );

        return array_slice($resultado, 0, $limit);
    }

    public function obtenerVolumenBusqueda(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($res) ? $res : [], $limit);
    }
}

class MasTrafico extends ApiSeranking
{
    protected function extraerDatosMasTrafico(array $datos): array
    {
        return [
            "url" => $datos['url'] ?? ($datos['domain'] ?? ''),
            "domain" => $datos['url'] ?? ($datos['domain'] ?? ''),
            "traffic" => $datos['traffic_sum'] ?? ($datos['traffic'] ?? 0),
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/pages?source=es&target={$this->domain}&limit={$limit}&type=organic&scope=domain&order_field=traffic_sum";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $paginas = $datos['pages'] ?? $datos;

        if (!is_array($paginas)) {
            return [];
        }

        $resultado = array_map(
            fn(array $pagina): array => $this->extraerDatosMasTrafico($pagina),
            $paginas
        );

        return array_slice($resultado, 0, $limit);
    }

    public function obtenerMasTrafico(int $limit = 10): array
    {
        $masTrafico = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($masTrafico) ? $masTrafico : [], $limit);
    }

}

class KeyTrafico extends ApiSeranking 
{
    protected function extraerDatosKeyTrafico(array $datos): array
    {
        return [
            "keyword" => $datos['keyword'] ?? '',
            "position" => $datos['position'] ?? 0,
            "volume" => $datos['volume'] ?? 0,
            "traffic" => $datos['traffic'] ?? 0,
            "url" => $datos['url'] ?? '',
        ];
    }

    public function getEndpoint(int $limit = 10): string
    {
        return "domain/keywords?source=es&domain={$this->domain}&limit={$limit}&type=organic&order_field=traffic&cols=keyword,position,volume,traffic,url,cpc";
    }

    public function procesarDatos(array $datos, int $limit = 10): array
    {
        $keywords = $datos['keywords'] ?? $datos;

        if (!is_array($keywords)) {
            return [];
        }

        $resultado = array_map(
            fn(array $item): array => $this->extraerDatosKeyTrafico($item),
            $keywords
        );

        return array_slice($resultado, 0, $limit);
    }

    public function obtenerKeyTrafico(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return $this->procesarDatos(is_array($res) ? $res : [], $limit);
    }
}

class Organico extends ApiSeranking
{



    public function getEndpoint(int $limit = 10): string
    {
        return "domain/overview/db?source=es&domain={$this->domain}&limit={$limit}&with_subdomains=true";
    }

    public function obtenerOrganico(int $limit = 10): array
    {
        $res = $this->request("GET", $this->getEndpoint($limit));
        return is_array($res) ? $res : [];
    }
}


try {
    $apiKey = "f8f1935c-2ff4-84a6-471a-af8f241f8e8c";
    $domain = !empty($_REQUEST['domain']) ? trim($_REQUEST['domain']) : "https://grabadosel13.com";

    $competencia = new Competencia($apiKey, $domain);
    $masTrafico = new MasTrafico($apiKey, $domain);
    $volumenBusqueda = new VolumenBusqueda($apiKey, $domain);
    $mejorPosicion = new MejorPosicion($apiKey, $domain);
    $keyTrafico = new KeyTrafico($apiKey, $domain);
    $organico = new Organico($apiKey, $domain);

    $datosCompetencia = $competencia->obtenerCompetencia(10);
    $datosMasTrafico = $masTrafico->obtenerMasTrafico(10);
    $datosVolumenBusqueda = $volumenBusqueda->obtenerVolumenBusqueda(10);
    $datosMejorPosicion = $mejorPosicion->obtenerMejorPosicion(10);
    $datosKeyTrafico = $keyTrafico->obtenerKeyTrafico(10);
    $datosOrganico = $organico->obtenerOrganico(10);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => true,
        'competencia' => $datosCompetencia,
        'masTrafico' => $datosMasTrafico,
        'volumenBusqueda' => $datosVolumenBusqueda,
        'mejorPosicion' => $datosMejorPosicion,
        'keyTrafico' => $datosKeyTrafico,
        'organico' => $datosOrganico,
        'data' => [
            'competencia' => $datosCompetencia,
            'masTrafico' => $datosMasTrafico,
            'volumenBusqueda' => $datosVolumenBusqueda,
            'mejorPosicion' => $datosMejorPosicion,
            'keyTrafico' => $datosKeyTrafico,
            'organico' => $datosOrganico,
        ],
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}

