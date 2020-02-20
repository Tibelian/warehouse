<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // create the new shelve
    $shelve = new Shelf(
        $_POST['code'],
        $_POST['material'],
        $_POST['numRack'],
        $_POST['corridor'],
        $_POST['position']
    );
    $shelve->setId(SHELF_ID);
    $shelve->setDate($_POST['date']);

    // update the database
    QueryShelf::update($shelve);

    // create the alert
    $_SESSION['alert'][] = new Alert('success', 'Estantería modificada con éxito');

}catch(WareHouseException $e){

    // all the errors
    switch($e->getCode()){
        default:
            $_SESSION['alert'][] = new Alert('danger', '<code> '.$e->getCode().'</code> ' . $e->getMessage());
            break;
        case 1062:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe una estantería con ese mismo <code>Código</code>');
            break;
    }
    
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code> ' . $e->getCode() . '</code>' . $e->getMessage());
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/shelf/edit/' . SHELF_ID);
