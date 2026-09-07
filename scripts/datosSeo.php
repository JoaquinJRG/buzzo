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

    protected function extraerDatosCompletencia(array $datos)
    {
        
    }

    protected function obtenerFilaTabla(array $datos)
    {

    }

    public function obtenerCompetencia()
    {
    
        $competencia = $this->request("GET", "domain/competitors?source=es&domain={$this->domain}&limit=10&type=organic&stats=1");
    
        return $competencia;
    }
}

$competencia = new Competencia(
    "f8f1935c-2ff4-84a6-471a-af8f241f8e8c",
    "https://grabadosel13.com"
);

foreach ($competencia->obtenerCompetencia() as $competidor) {
    echo "Dominio: " . $competidor['domain'] . "<br>";
    echo "KW comunes: " . $competidor['common_keywords'] . "<br>";
    echo "<hr>";
}

$competidores = $competencia->obtenerCompetencia();

foreach (array_slice($competidores, 0, 10) as $competidor) {
    echo "Dominio: " . $competidor['domain'] . "<br>";
    echo "KW comunes: " . $competidor['common_keywords'] . "<br>";
    echo "<hr>";
}

