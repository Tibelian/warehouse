<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

// 1. create the trigger with the reason
// 2. the controller delete the shelf and
// 3. the trigger save the shelf into the backup

try{
    
    // insert the backup and delete the shelf
    QueryShelf::saveBackup(SHELF_ID, $_POST['code'], $_POST['reason']);
    
    // verify user with an alert
    $_SESSION['alert'][] = new Alert('success', 'Estantería eliminada con éxito');

}catch(WareHouseException $e){
    switch($e->getCode()){
        case 1451:
            $_SESSION['alert'][] = new Alert('warning', 'No puedes eliminar esta estantería porque tiene cajas dentro');
            break;
        default:
            $_SESSION['alert'][] = new Alert('danger', '<code> '.$e->getCode().'</code>' . $e->getMessage());
            break;
    }
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/shelf');
