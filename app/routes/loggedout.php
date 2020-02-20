<?php

///////////
// LOGIN //
///////////
$router->get('/', function() {
    header('Location: ' . BASE_URL . '/login');
});
$router->get('/login', function() {
    // I create 3 view because the login and register
    // use different header and footer than the dashboard
    View::setHeader('user/header');
    View::setFile('user/login');
    View::setFooter('user/footer');

    View::loadHeader();
    View::load();
    View::loadFooter();
});
$router->post('/login', function() {
    Controller::load('user/login');
});

//////////////
// REGISTER //
//////////////
$router->get('/register', function() {
    // I create 3 view because the login and register
    // use different header and footer than the dashboard
    View::setHeader('user/header');
    View::setFile('user/register');
    View::setFooter('user/footer');

    View::loadHeader();
    View::load();
    View::loadFooter();
});
$router->post('/register', function() {
    Controller::load('user/register');
});


