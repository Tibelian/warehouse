<?php

include __DIR__ . '/../../data_access_object/QueryWareHouse.php';

try {

    $_SESSION['warehouse'] = QueryWareHouse::getData();
    header('Location: ' . BASE_URL . '/dashboard/profile/settings');
    exit;
    
} catch (WareHouseException $e) {

    $_SESSION['alert'][] = new Alert('warning', 'Error inesperado. Contacte con un administrador si el error persiste. ERROR: <code>' . $e->getCode() . '</code> - ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
    
}
