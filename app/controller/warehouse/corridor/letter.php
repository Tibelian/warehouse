<?php

include __DIR__ . '/../../../data_access_object/QueryShelf.php';

try{

    echo QueryShelf::obtainCorridorLetter(SHELF_ID);

}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() .'</code>' . $e->getMessage());
}catch(Exception $e){
    $_SESSION['alert'][] = new Alert('warning', 'ERROR: <code>' . $e->getCode() .'</code>' . $e->getMessage());
}
