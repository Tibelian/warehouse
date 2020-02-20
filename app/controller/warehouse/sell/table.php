<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    // get the full list of logs
    $_SESSION['boxList'] = QueryBox::getFullListOut();

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('warning', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', '<code>'.$e->getCode().'</code> ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/sell');
