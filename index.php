<?php

// configuración por defecto
require __DIR__ . '/app/basic.php';

////////////////////
ob_start();       //
session_start();  //
////////////////////

// ROUTER -> usado para usar rutas sencillas
$router = new \Bramus\Router\Router();

// SESSION -> usado para gestionar al usuario
Session::reload();

// si el usuario ha iniciado sesión podrá acceder a diferentes vistas
require __DIR__ . '/app/routes/public.php';
if(Session::getLoggedIn()){
	require __DIR__ . '/app/routes/loggedin.php';
}else{
	require __DIR__ . '/app/routes/loggedout.php';
}

////////////////////
$router->run();   //
////////////////////

////////////////////
ob_end_flush();   //
////////////////////
