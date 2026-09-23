<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/ApiProyectos.php';

try {
    $api = new ApiProyectos();
    $companyId = $_GET['company_id'] ?? 'empresa_prueba_01';
    $userId = $_GET['user_id'] ?? 'usuario_buzzo_01';

    $params = [];
    if (!empty($_GET['from'])) {
        $params['from'] = $_GET['from'];
    }
    if (!empty($_GET['to'])) {
        $params['to'] = $_GET['to'];
    }
    if (!empty($_GET['project_public_id'])) {
        $params['project_public_id'] = $_GET['project_public_id'];
    }
    if (!empty($_GET['status'])) {
        $params['status'] = $_GET['status'];
    }
    if (!empty($_GET['page'])) {
        $params['page'] = (int)$_GET['page'];
    }
    if (!empty($_GET['per_page'])) {
        $params['per_page'] = (int)$_GET['per_page'];
    }

    $res = $api->getPlanning($companyId, $userId, $params);

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