<?php

///////////////
// ERROR 404 //
///////////////
$router->set404(function() {
    // if user has logged in, prepare the view
    // else redirect to the login view
    if (Session::getLoggedIn()) {
        header('HTTP/1.1 404 Not Found');
        View::setFile('error/404');
        View::load();
    } else {
        header('Location: ' . BASE_URL . '/login');
    }
});
$router->get('/dashboard/error', function() {
    // if user has logged in, prepare the view
    // else redirect to the login view
    if (Session::getLoggedIn()) {
        View::setFile('error/unknown');
        View::load();
    } else {
        header('Location: ' . BASE_URL . '/login');
    }
});


////////////////////
// AJAX RESPONSES //
////////////////////
$router->get('/dashboard/ajax/rack/(\d+)', function($shelfId) {
    define('SHELF_ID', $shelfId);
    Controller::load('warehouse/shelf/load.position');
});
$router->get('/dashboard/ajax/corridor/(\d+)', function($corridorId) {
    define('CORRIDOR_ID', $corridorId);
    Controller::load('warehouse/corridor/position');
});
$router->get('/dashboard/ajax/cletter/(\d+)', function($shelfId) {
    define('SHELF_ID', $shelfId);
    Controller::load('warehouse/corridor/letter');
});
