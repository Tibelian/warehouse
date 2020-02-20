<?php

include __DIR__ . '/../../data_access_object/QueryWareHouse.php';
include __DIR__ . '/../../data_access_object/QueryShelf.php';
include __DIR__ . '/../../data_access_object/QueryBox.php';

try {

    $total = QueryShelf::getCountTotalRack();
    $busy = QueryShelf::getCountBusyRack();
    $data = array(
        'shelve' => QueryShelf::getCount(),
        'box' => QueryBox::getCount(),
        'totalRack' => $total,
        'busyRack' => $busy,
        'freeRack' => $total - $busy,
        'boxOut' => QueryBox::getCountOut(),
        'corridorPos' => QueryShelf::getCorridorPos(),
        'corridors' => QueryShelf::getCorridors(),
        'warehouse' => QueryWareHouse::getData()
    );

    $_SESSION['summary'] = $data;
    // redirect to the view
    header('Location: ' . BASE_URL . '/dashboard');
    exit;
} catch (WareHouseException $e) {

    $_SESSION['alert'][] = new Alert('warning', 'Error inesperado. Contacte con un administrador si el error persiste. ERROR: <code>' . $e->getCode() . '</code> - ' . $e->getMessage());

    // redirect to the view
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}

