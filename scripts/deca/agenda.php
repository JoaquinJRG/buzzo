<?php

declare(strict_types=1);

require_once __DIR__ . '/ApiDeca.php';

header('Content-Type: application/json; charset=utf-8');

$companyId = 'cmp_test_0lm2nbnczyz6dhdsrrtnghbn9r';
$userId = '01M3BS69B0AC90H82KS50WEH12';

try {
    $api = new ApiDeca();
    $input = json_decode(file_get_contents('php://input'), true);
    $input = is_array($input) ? $input : [];
    $action = $input['action'] ?? 'summary';

    $listMethods = [
        'counterparts' => 'listAgendaCounterparts',
        'addresses' => 'listAgendaAddresses',
        'vehicles' => 'listAgendaVehicles',
        'drivers' => 'listAgendaDrivers',
        'authorizations' => 'listAgendaAuthorizations',
    ];
    $createMethods = [
        'counterpart' => 'createAgendaCounterpart',
        'address' => 'createAgendaAddress',
        'vehicle' => 'createAgendaVehicle',
        'driver' => 'createAgendaDriver',
        'authorization' => 'createAgendaAuthorization',
    ];

    if ($action === 'summary') {
        $result = $api->getAgendaSummary($companyId, $userId);
    } elseif (isset($listMethods[$action])) {
        $result = $api->{$listMethods[$action]}($companyId, $userId);
    } elseif (isset($createMethods[$action])) {
        $result = $api->{$createMethods[$action]}(
            $companyId,
            $userId,
            is_array($input['data'] ?? null) ? $input['data'] : []
        );
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Acción de agenda no válida']);
        exit;
    }

    http_response_code($result['http_code']);
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo procesar la agenda', 'detail' => $exception->getMessage()]);
}