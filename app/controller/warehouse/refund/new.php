<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    $_SESSION['boxes'] = QueryBox::getFullListOut();
    header('Location: ' . BASE_URL . '/dashboard/refund/new');
    exit;

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('warning', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
}


header('Location: ' . BASE_URL . '/dashboard/error');
exit;