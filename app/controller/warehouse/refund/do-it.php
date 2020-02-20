<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';


try{

    $box = QueryBox::getWhereCodeOut($_POST['code']);
    $box->setShelfId($_POST['shelf']);
    $box->setRackPos($_POST['rack']);

    QueryBox::refund($box);

    $_SESSION['alert'][] = new Alert('success', 'Caja devuelta con éxito');

}catch(WareHouseException $e){

    if($e->getCode() == 20202){
        $_SESSION['alert'][] = new Alert('warning', 'No se ha podido devolver la caja <code>' . $box->getCode() . '</code> porque ya existe una caja con ese mismo código');
    }else{
        $_SESSION['alert'][] = new Alert('danger', 'ERROR <code>' . $e->getCode() . '</code> ' . $e->getMessage());
    }

}


if($result == 'OK'){
    header('Location: ' . BASE_URL . '/dashboard/box');
    exit;
}else{
    header('Location: ' . BASE_URL . '/dashboard/refund/new');
    exit;
}
