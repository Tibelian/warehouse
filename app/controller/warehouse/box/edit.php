<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    // return the object
    $_SESSION['box'] = QueryBox::getWhereId(BOX_ID);

    // return the association
    $_SESSION['association'] = QueryBox::getAssociationWhereBoxId(BOX_ID);

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}

// if the controller failed redirect to the error messages view
if(!isset($_SESSION['box']) || !isset($_SESSION['association'])){
    // redirect to the error view
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}
