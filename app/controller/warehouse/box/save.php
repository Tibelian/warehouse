<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';

try{

    // create the new box
    $box = new Box(
        $_POST['code'],
        $_POST['material'],
        $_POST['content'],
        $_POST['color'],
        $_POST['height'],
        $_POST['width'],
        $_POST['depth']
    );
    $box->setId(BOX_ID);
    $box->setDate($_POST['date']);

    // update the database
    QueryBox::update($box);
    
    // update the association
    QueryBox::updateAssociation(BOX_ID, $_POST['shelve'], $_POST['rack']);

    // create the alert
    $_SESSION['alert'][] = new Alert('success', 'Caja modificada con éxito');


}catch(WareHouseException $e){
    
    // all the errors
    switch($e->getCode()){
        default:
            $_SESSION['alert'][] = new Alert('danger', '<code> '.$e->getCode().'</code> ' . $e->getMessage());
            break;
        case 1062:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe una caja con ese mismo <code>Código</code>');
            break;
    }
    
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('danger', '<code> ' . $e->getCode() . '</code>' . $e->getMessage());
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/box/edit/' . BOX_ID);
exit;