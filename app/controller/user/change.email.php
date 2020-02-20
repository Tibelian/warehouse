<?php

include __DIR__ . '/../../data_access_object/QueryUser.php';

try{

    // check if the new emails are equal
    if($_POST['newemail'] === $_POST['newemail2']){

        // check if valid email
        if(filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)){

            // check if valid password
            QueryUser::login(Session::getUser()->getUserName(), $_POST['password']);
            
            // try to change the email
            QueryUser::changeEmail(Session::getUser()->getId(), $_POST['newemail']);

            // update the current session
            Session::getUser()->setEmail($_POST['newemail']);
    
            // alert success
            $_SESSION['alert'][] = new Alert('success', 'Correo electrónico cambiado con éxito');
    
        }else{
            $_SESSION['alert'][] = new Alert('warning', 'Introduce un correo electrónico válido');
        }
    }else{
        $_SESSION['alert'][] = new Alert('warning', 'Los correos electrónicos no coinciden');
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