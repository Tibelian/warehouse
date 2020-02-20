<?php

include __DIR__ . '/../../data_access_object/QueryUser.php';
include __DIR__ . '/../../data_access_object/QueryLog.php';

try{

    // check if valid credentials
    $user = QueryUser::login($_POST['username'], $_POST['password']);

    // create the session
    $_SESSION['user'] = $user;
    Session::reload();

    // create the welcome message
    $_SESSION['alert'][] = new Alert('success', 'Bienvenido <strong>' . $user->getUserName() . '</strong>.');

    $result = 'OK';
    
}catch(WareHouseException $e){
    
    $result = 'ERROR';

    // all error messages
    switch($e->getCode()){
        case 404:
            $_SESSION['alert'][] = new Alert('warning', '¡Datos incorrectos!');
            break;
        default:
            $_SESSION['alert'][] = new Alert('warning', 'Error inesperado. Contacte con un administrador si el error persiste ');
            break;
    }

}

if($result != 'OK'){
    // redirect to the login view again
    header('Location: ' . BASE_URL . '/login');
    exit;
}else{
    // redirect to the dashboard
    header('Location: ' . BASE_URL . '/dashboard');
    exit;
}
