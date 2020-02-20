<?php

include __DIR__ . '/../../data_access_object/QueryUser.php';

try{
    
    if($_POST['password'] === $_POST['password2']){
        
        // check if valid credentials
        $user = QueryUser::register($_POST['username'], $_POST['email'], $_POST['password']);
    
        // create the welcome message
        $_SESSION['alert'][] = new Alert('success', 'Registro completado con éxito. Ya puede iniciar sesión:');
        header('Location: ' . BASE_URL . '/login');

    }else{
        $_SESSION['alert'][] = new Alert('warning', 'Las contraseñas no coinciden!');
        header('Location: ' . BASE_URL . '/register');
    }

}catch(WareHouseException $e){

    // error messages
    switch($e->getCode()){
        default:
            $_SESSION['alert'][] = new Alert('danger', 'Error inesperado. Contacte con un administrador si el error persiste ' . $e->getCode() . ' - ' . $e->getMessage());
        break;
        case 1062:
            $_SESSION['alert'][] = new Alert('warning', 'Ya existe un usuario con ese nombre de usuario o correo electrónico');
        break;
    }
    header('Location: ' . BASE_URL . '/register');
    
}

