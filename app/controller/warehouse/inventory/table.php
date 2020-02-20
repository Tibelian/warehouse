<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    $_SESSION['inventory'] = QueryShelf::getInventory();

}catch(WareHouseException $e){

    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() . '</code> ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;

}


// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/inventory');
