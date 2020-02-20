<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    $shelve = new Shelf(
        $_POST['code'],
        $_POST['material'],
        $_POST['numRack'],
        $_POST['corridor'],
        $_POST['position']
    );
    $result = QueryShelf::insert($shelve, true);
    $link = '<a href="' . BASE_URL . '/dashboard/shelf/edit/' . $result . '"><i class="fas fa-eye"></i> Ver Estantería</a>';
    $_SESSION['alert'][] = new Alert('success', 'Estantería agregada con éxito: ' . $link);

}catch(WareHouseException $e){
    switch($e->getCode()){
        default:
            $_SESSION['alert'][] = new Alert('danger', 'ERROR: <code>' . $e->getCode() . '</code> ' . $e->getMessage());
            break;
        case 1062:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe una estantería con ese mismo <code>Código</code>');
            break;
        case 2222:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe una estantería con ese mismo <code>Código</code> en la <code>tabla backup</code>');
            break;
    }
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code> ' . $e->getCode() . '</code> ' . $e->getMessage());
}

// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/shelf/add');
