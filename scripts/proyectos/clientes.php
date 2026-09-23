<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/ApiProyectos.php';

try {
    $api = new ApiProyectos();
    $companyId = $_GET['company_id'] ?? 'empresa_prueba_01';
    $userId = $_GET['user_id'] ?? 'usuario_buzzo_01';

    $res = $api->getClients($companyId, $userId);

    echo json_encode([
        'success' => $res['success'],
        'data' => $res['data'],
        'meta' => $res['meta'],
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
}
