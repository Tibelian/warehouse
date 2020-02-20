<?php

include __DIR__ . '/../../../data_access_object/QueryBox.php';
include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    $box = new Box(
        $_POST['code'],
        $_POST['material'],
        $_POST['content'],
        $_POST['color'],
        $_POST['height'],
        $_POST['width'],
        $_POST['depth']
    );
    $insert_id = QueryBox::insert($box);
    $link = '<a href="' . BASE_URL . '/dashboard/box/edit/' . $insert_id . '"><i class="fas fa-eye"></i> Ver Caja</a>';
    $_SESSION['alert'][] = new Alert('success', 'Caja agregada con éxito: ' . $link);
    
    QueryBox::associate($insert_id, $_POST['shelve'], $_POST['rack']);
    $_SESSION['alert'][] = new Alert('success', 'Caja guardada en la estantería <code>' . QueryShelf::getCodeById($_POST['shelve']) . '</code> con éxito');

}catch(WareHouseException $e){
    switch($e->getCode()){
        default:
            $_SESSION['alert'][] = new Alert('danger', '<code>'.$e->getCode().'</code>' . $e->getMessage());
            break;
        case 1062:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe una caja con ese mismo <code>Código</code>');
            break;
        case 20202:
            $_SESSION['alert'][] = new Alert('warning', 'Existe una caja backup con ese mismo <code>Código</code>');
            break;
    }
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', '<code> ' . $e->getCode() . '</code>' . $e->getMessage());
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/box/add');
