<?php

include __DIR__ . '/../../data_access_object/QueryUser.php';

try{

    // check if the new passwords are equal
    if($_POST['newpassword'] === $_POST['newpassword2']){

        // check if valid password
        QueryUser::login(Session::getUser()->getUserName(), $_POST['password']);
        
        // try to change the password
        QueryUser::changePassword(Session::getUser()->getId(), $_POST['newpassword']);

        // alert success
        $_SESSION['alert'][] = new Alert('success', 'Contraseña cambiada con éxito');

    }else{
        $_SESSION['alert'][] = new Alert('warning', 'Las contraseñas no coinciden');
    }

}catch(WareHouseException $e){

    // all error messages
    switch($e->getCode()){
        case 404:
            $_SESSION['alert'][] = new Alert('warning', '¡Contraseña actual incorrecta!');
            break;
        default:
            $_SESSION['alert'][] = new Alert('danger', 'ERROR <code>'.$e->getCode().'</code> ' . $e->getMessage());
            break;
    }

}

// redirect to the settings view again
header('Location: ' . BASE_URL . '/dashboard/profile/settings');