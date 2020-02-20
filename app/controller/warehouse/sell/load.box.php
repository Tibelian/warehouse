<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';
include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // return the object
    $_SESSION['box'] = QueryBox::getWhereCode($_POST['code']);

    // return the association
    $_SESSION['association'] = QueryBox::getAssociationWhereBoxId($_SESSION['box']->getId());

    // return the shelf
    $_SESSION['shelf'] = QueryShelf::getWhereId($_SESSION['association']->shelf_id);

}catch(WareHouseException $e){
    if($e->getCode() == 404){
        $_SESSION['alert'][] = new Alert('warning', 'No existe ninguna caja con ese código');
    }else{
        $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
    }
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}

header('Location: ' . BASE_URL . '/dashboard/action/confirm/?option=sell');
exit;