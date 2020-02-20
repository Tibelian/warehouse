<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    // get the full list of shelf
    $_SESSION['shelfList'] = QueryShelf::getFullListBackup();

}catch(WareHouseException $e){


    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() . '</code> ' . $e->getMessage());
    header('Location: ' . BASE_URL . '/error');
    exit;

}


// redirect to the view
header('Location: ' . BASE_URL . '/dashboard/shelf/backup');
