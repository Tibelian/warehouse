<?php

include_once __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // return the object
    $_SESSION['shelf'] = QueryShelf::getWhereId(SHELF_ID);

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}

// if the controller failed redirect to the error messages view
if(!isset($_SESSION['shelf'])){
    // redirect to the error view
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}

// redirect to the view
//header('Location: ' . BASE_URL . '/dashboard/shelve/edit/' . $id);
 