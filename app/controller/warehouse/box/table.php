<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    // get the full list of boxes
    $_SESSION['boxList'] = QueryBox::getFullList();

}catch(WareHouseException $e){

    $_SESSION['alert'][] = new Alert('warning', 'Error inesperado. Contacte con un administrador si el error persiste. ERROR: <code>'.$e->getCode().'</code>');

}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/box');
