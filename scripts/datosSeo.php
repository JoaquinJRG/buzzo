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

    // Método para realizar solicitudes a la API
    protected function request($method, $endpoint, $data = null)
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

    public function obtenerCompetencia(): array
    {
        $competencia = $this->request("GET", "domain/competitors?source=es&domain={$this->domain}&limit=10&type=organic&stats=1");
        $competidores = $competencia['competitors'] ?? $competencia;

        if (!is_array($competidores)) {
            return [];
        }

        return array_map(
            fn(array $competidor): array => $this->extraerDatosCompetencia($competidor),
            $competidores
        );
    }
}

class MejorPosicion extends ApiSeranking
{
    protected function extraerDatosMejorPosicion(array $datos): array
    {
        return [

        ];
    }
}

class VolumenBusqueda extends ApiSeranking
{
    protected function extraerDatosVolumenBusqueda(array $datos): array
    {
        return [

        ];
    }
}

class MasTrafico extends ApiSeranking
{
    protected function extraerDatosMasTrafico(array $datos): array
    {
        return [
            "domain" => $datos['domain'] ?? '',
            "traffic" => $datos['traffic'] ?? 0,
        ];
    }

}


$competencia = new Competencia(
    "f8f1935c-2ff4-84a6-471a-af8f241f8e8c",
    "https://grabadosel13.com"
);

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'success' => true,
    'data' => $competencia->obtenerCompetencia(),
], JSON_UNESCAPED_UNICODE);

