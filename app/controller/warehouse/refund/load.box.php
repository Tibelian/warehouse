<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';
include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // return the object
    $_SESSION['box'] = QueryBox::getWhereCodeOut($_POST['code']);

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code>' . $e->getCode() . '</code> ' . $e->getMessage());
}

header('Location: ' . BASE_URL . '/dashboard/action/confirm/?option=refund');
exit;
