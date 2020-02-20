<?php

include __DIR__ . '/../../data_access_object/QueryUser.php';

try{

    // check if image exists
    $img = __DIR__ . '/../../../assets/img/avatar/' . $_POST['profile'];
    if(file_exists($img)){

        // try to change the image
        QueryUser::changeImage(Session::getUser()->getId(), $_POST['profile']);

        // update the current session
        Session::getUser()->setImage($_POST['profile']);

        // notify that image changed successfully
        $_SESSION['alert'][] = new Alert('success', 'Foto perfil cambiada con éxito');

    }else{
        $_SESSION['alert'][] = new Alert('warning', 'La foto de perfil que has elegido no existe');
    }

}catch(WareHouseException $e){

    $_SESSION['alert'][] = new Alert('warning', 'Error inesperado. Contacte con un administrador si el error persiste');

}

// redirect to the settings view again
header('Location: ' . BASE_URL . '/dashboard/profile/settings');
