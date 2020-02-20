<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    $result = QueryShelf::obtainFreeRacks(SHELF_ID);
    $json = json_encode($result);
    echo $json;

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() . '</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() . '</code> ' . $e->getMessage());
}
