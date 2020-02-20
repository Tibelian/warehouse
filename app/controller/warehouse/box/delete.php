<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    global $mysqli;

    $mysqli->autocommit(false);
    
    // podría eliminar primero la ocupación
    // pero como utilizo trigger ya lo hace él
    //QueryBox::deleteAssociation(BOX_ID);

    // elimina la caja
    QueryBox::delete(BOX_ID);

    $mysqli->commit();

    // create the alert
    $_SESSION['alert'][] = new Alert('success', 'Caja vendida con éxito');

}catch(WareHouseException $e){
    $mysqli->rollback();
    // log result
    $_SESSION['alert'][] = new Alert('danger', '<code> '.$e->getCode().'</code> ' . $e->getMessage());
}catch(Exception $e){
    $mysqli->rollback();
    // log result
    $_SESSION['alert'][] = new Alert('danger', '<code> ' . $e->getCode() . '</code> ' . $e->getMessage());
}

$mysqli->autocommit(true);

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/sell');
exit;
