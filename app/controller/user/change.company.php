<?php

include __DIR__ . '/../../data_access_object/QueryWareHouse.php';
$warehouse = array(
    'cif' => $_POST['cif'],
    'business_name' => $_POST['nombre-empresa'],
    'warehouse_code' => $_POST['codigo-almacen'],
    'warehouse_name' => $_POST['nombre-almacen'],
    'phone' => $_POST['telefono'],
    'email' => $_POST['email'],
    'web' => $_POST['web'],
    'residence' => $_POST['direccion'],
    'location' => $_POST['localidad'],
    'responsable' => $_POST['responsable']
);

try{
    
    QueryWareHouse::update($warehouse);
    $_SESSION['alert'][] = new Alert('success', 'Datos de empresa cambiados con éxito');
    
}catch(WareHouseException $e){
    $_SESSION['alert'][] = new Alert('warning', 'Ha ocurrido un error al guardar los datos: ' . $e->getMessage());
}

// redirect to the settings view again
header('Location: ' . BASE_URL . '/dashboard/profile/settings');
exit;
