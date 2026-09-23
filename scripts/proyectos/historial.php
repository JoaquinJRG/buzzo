<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/ApiProyectos.php';

try {
    $api = new ApiProyectos();
    $companyId = $_GET['company_id'] ?? 'empresa_prueba_01';
    $userId = $_GET['user_id'] ?? 'usuario_buzzo_01';

    $from = $_GET['from'] ?? date('Y-m-01\T00:00:00\Z');
    $to = $_GET['to'] ?? date('Y-m-t\T23:59:59\Z');

    $params = [];
    if (!empty($_GET['page'])) {
        $params['page'] = (int)$_GET['page'];
    }
    if (!empty($_GET['per_page'])) {
        $params['per_page'] = (int)$_GET['per_page'];
    }

    $resProjects = $api->getReportHoursByProject($companyId, $userId, $from, $to, $params);
    $resWorkers = $api->getReportHoursByWorker($companyId, $userId, $from, $to, $params);

    echo json_encode([
        'success' => $resProjects['success'] && $resWorkers['success'],
        'data' => [
            'hours_by_project' => $resProjects['data'],
            'hours_by_worker' => $resWorkers['data'],
            'from' => $from,
            'to' => $to,
        ],
        'meta' => [
            'project_report_meta' => $resProjects['meta'] ?? null,
            'worker_report_meta' => $resWorkers['meta'] ?? null,
        ],
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
}