<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{


    $id = QueryBox::getIdByCode($_POST['code']);

    // after delete the box
    QueryBox::delete($id);

    // create the alert
    $_SESSION['alert'][] = new Alert('success', 'Caja <code>'.$_POST['code'].'</code> vendida con éxito');

}catch(WareHouseException $e){
    // log result
    $result = $e->getMessage();
    $_SESSION['alert'][] = new Alert('danger', '<code> '.$e->getCode().'</code>' . $e->getMessage());
}catch(Exception $e){
    // log result
    $result = $e->getMessage();
    $_SESSION['alert'][] = new Alert('danger', '<code> ' . $e->getCode() . '</code>' . $e->getMessage());
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/sell');
