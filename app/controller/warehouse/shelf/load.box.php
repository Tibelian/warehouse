<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // get the full list of shelves
    $_SESSION['shelfList'] = QueryShelf::getFullList();

}catch(WareHouseException $e){

    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>'.$e->getCode().'</code> ' . $e->getMessage());

}


// redirect to the view
if(strpos($_SERVER['REQUEST_URI'], 'add') !== false){
    header('Location: ' . BASE_URL . '/dashboard/box/add');
    exit;
}else if(strpos($_SERVER['REQUEST_URI'], 'edit') !== false){
    header('Location: ' . BASE_URL . '/dashboard/box/edit/' . BOX_ID);
    exit;
}else{
    header('Location: ' . BASE_URL . '/dashboard/action/confirm/?option=refund');
    exit;
}
