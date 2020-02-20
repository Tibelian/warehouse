<?php

// funciones básicas
require __DIR__ . '/functions.php';

// clases para controlar de una forma más eficiente 
// las alertas, las sesiones y las plantillas / vistas
require __DIR__ . '/vendor/tibelian/Alert.php';
require __DIR__ . '/vendor/tibelian/Session.php';
require __DIR__ . '/vendor/tibelian/View.php';
require __DIR__ . '/vendor/tibelian/Controller.php';

// modelos a usar
require __DIR__ . '/model/Box.php';
require __DIR__ . '/model/BoxOut.php';
require __DIR__ . '/model/Shelf.php';
require __DIR__ . '/model/ShelfBackup.php';
require __DIR__ . '/model/User.php';

// para controlar las rutas
require __DIR__ . '/vendor/bramus/Router.php';

// conexión a la base de datos
require __DIR__ . '/data_access_object/DataBase.php';

// recoge información básica web
$dataBase = getJson('database');
$webSite = getJson('website');

// constantes que usaremos muy seguido
define('BASE_URL', $webSite['url']);
define('WEB_NAME', $webSite['title']);
define('REAL_IP', $_SERVER[$webSite['user-ip']]);

// se conecta a la db
$mysqli = DataBase::connect($dataBase);

// elimina variables ya que no nos harán falta
unset($dataBase, $webSite);

// ruta base de las vistas y controladores
View::setPath('app/view/');
Controller::setPath('app/controller/');
