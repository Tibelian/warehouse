<?php

include_once __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // return the object
    $_SESSION['corridor'] = QueryShelf::getAllCorridors();

    // falta cargar los pasillos

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}

// redirect to the view
if(strpos($_SERVER['REQUEST_URI'], 'add') !== false){
    header('Location: ' . BASE_URL . '/dashboard/shelf/add');
    exit;
}else{
    header('Location: ' . BASE_URL . '/dashboard/shelf/edit/' . SHELF_ID);
    exit;
}

 