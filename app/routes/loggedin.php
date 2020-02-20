<?php

///////////
// INDEX //
///////////
$router->get('/', function() {
    header('Location: ' . BASE_URL . '/dashboard');
});
$router->get('/dashboard', function() {
    // comprueba si existen los datos del resumen
    // si no existe se carga el controlador
    if (isset($_SESSION['summary'])) {
        // muestra la vista
        View::setFile('warehouse/landpage/summary');
        View::load();
        unset($_SESSION['summary']);
    } else {
        // carga el controlador
        Controller::load('warehouse/summary');
    }
});


////////////
// SHELVE //
////////////
$router->get('/dashboard/shelf', function() {
    // if exists the shelf list load the table
    // else load the controller
    if (isset($_SESSION['shelfList'])) {
        // show the view
        View::setFile('warehouse/shelf/table');
        View::load();
        // delete the list
        unset($_SESSION['shelfList']);
    } else {
        Controller::load('warehouse/shelf/table');
    }
});
$router->post('/dashboard/shelf/add', function() {
    Controller::load('warehouse/shelf/add');
});
$router->get('/dashboard/shelf/add', function() {
    if (isset($_SESSION['corridor'])) {
        // show the view
        View::setFile('warehouse/shelf/add');
        View::load();
        unset($_SESSION['corridor']);
    } else {
        Controller::load('warehouse/corridor/load');
    }
});
$router->get('/dashboard/shelf/edit/(\d+)', function($id) {
    define('SHELF_ID', $id);
    if (isset($_SESSION['shelf']) && isset($_SESSION['corridor'])) {
        // show the view
        View::setFile('warehouse/shelf/edit');
        View::load();
        // delete the shelve to reload the controller next time
        unset($_SESSION['shelf']);
        unset($_SESSION['corridor']);
    } else {
        // load the controller
        Controller::load('warehouse/shelf/edit');
        Controller::load('warehouse/corridor/load');
    }
});
$router->post('/dashboard/shelf/edit/(\d+)', function($id) {
    define('SHELF_ID', $id);
    if (isset($_POST['delete'])) {
        // controller that delete the shelve
        Controller::load('warehouse/shelf/delete');
    } else {
        // controller that save the changes
        Controller::load('warehouse/shelf/save');
    }
});
$router->get('/dashboard/shelf/backup', function() {
    // if exists the shelf list load the table
    // else load the controller
    if (isset($_SESSION['shelfList'])) {
        // show the view
        View::setFile('warehouse/shelf/table.backup');
        View::load();
        // delete the list
        unset($_SESSION['shelfList']);
    } else {
        Controller::load('warehouse/shelf/table.backup');
    }
});


///////////
// BOXES //
///////////
$router->get('/dashboard/box', function() {
    // if data exists load view
    // else load the controller
    if (isset($_SESSION['boxList'])) {
        // show the view
        View::setFile('warehouse/box/table');
        View::load();
        // delete data
        unset($_SESSION['boxList']);
    } else {
        Controller::load('warehouse/box/table');
    }
});
$router->post('/dashboard/box/add', function() {
    // controller post, this save the object to database
    Controller::load('warehouse/box/add');
});
$router->get('/dashboard/box/add', function() {
    // check all the current shelves
    // else load the shelves from controller
    if (isset($_SESSION['shelfList'])) {
        // load the view
        View::setFile('warehouse/box/add');
        View::load();
        // delete the data to reload it always
        unset($_SESSION['shelfList']);
    } else {
        Controller::load('warehouse/shelf/load.box');
    }
});
$router->get('/dashboard/box/edit/(\d+)', function($id) {
    define('BOX_ID', $id);
    // view to edit a box
    if (
            isset($_SESSION['box']) &&
            isset($_SESSION['association']) &&
            isset($_SESSION['shelfList'])
    ) {
        View::setFile('warehouse/box/edit');
        View::load();
        // delete data to reload the controller next time
        unset($_SESSION['box']);
        unset($_SESSION['association']);
        unset($_SESSION['shelfList']);
    } else {
        // controller to load the boxes and associations
        Controller::load('warehouse/box/edit');
        // contorller to load all the available associations
        Controller::load('warehouse/shelf/load.box');
    }
});
$router->post('/dashboard/box/edit/(\d+)', function($id) {
    define('BOX_ID', $id);
    if (isset($_POST['delete'])) {
        // controller that delete the box and association
        Controller::load('warehouse/box/delete');
    } else {
        // controller that save the changes
        Controller::load('warehouse/box/save');
    }
});


///////////////
// INVENTORY //
///////////////
$router->get('/dashboard/inventory', function() {
    // if exists the data show the view
    // else load the controller 
    if (isset($_SESSION['inventory'])) {
        // create and show the view
        View::setFile('warehouse/inventory/table');
        View::load();
        // delete the data to reload always the content
        unset($_SESSION['inventory']);
    } else {
        Controller::load('warehouse/inventory/table');
    }
});


//////////////////
// OUT DELIVERY //
//////////////////
$router->get('/dashboard/sell', function() {
    // if exists the data show the view
    // else load the controller 
    if (isset($_SESSION['boxList'])) {
        // create and show the view
        View::setFile('warehouse/sell/table');
        View::load();
        // delete the data to reload always the content
        unset($_SESSION['boxList']);
    } else {
        Controller::load('warehouse/sell/table');
    }
});
$router->get('/dashboard/sell/new', function() {
    if (isset($_SESSION['boxes'])) {
        View::setFile('warehouse/sell/new');
        View::load();
        unset($_SESSION['boxes']);
    } else {
        Controller::load('warehouse/sell/new');
    }
});
$router->post('/dashboard/sell/new', function() {
    Controller::load('warehouse/sell/load.box');
});
$router->get('/dashboard/refund/new', function() {
    if (isset($_SESSION['boxes'])) {
        View::setFile('warehouse/refund/new');
        View::load();
        unset($_SESSION['boxes']);
    } else {
        Controller::load('warehouse/refund/new');
    }
});
$router->post('/dashboard/refund/new', function() {
    Controller::load('warehouse/refund/load.box');
});
$router->get('/dashboard/action/confirm', function() {

    if (isset($_GET['option'])) {

        if ($_GET['option'] == 'sell') {

            if (isset($_SESSION['box']) && isset($_SESSION['association']) && isset($_SESSION['shelf'])) {
                View::setFile('warehouse/action/confirm');
                View::load();
                unset($_SESSION['box']);
                unset($_SESSION['association']);
                unset($_SESSION['shelf']);
            } else {
                $_SESSION['alert'][] = new Alert('danger', 'La operación ha caducado');
                header('Location: ' . BASE_URL . '/dashboard/error');
            }
        } else if ($_GET['option'] == 'refund') {

            if (isset($_SESSION['shelfList'])) {
                if (isset($_SESSION['box'])) {
                    View::setFile('warehouse/action/confirm');
                    View::load();
                    unset($_SESSION['box']);
                    unset($_SESSION['shelfList']);
                } else {
                    unset($_SESSION['shelfList']);
                    $_SESSION['alert'][] = new Alert('danger', 'La operación ha caducado');
                    header('Location: ' . BASE_URL . '/dashboard/error');
                }
            } else {
                Controller::load('warehouse/shelf/load.box');
            }
        } else {
            $_SESSION['alert'][] = new Alert('danger', 'La operación no es válida');
            header('Location: ' . BASE_URL . '/dashboard/error');
        }
    } else {
        $_SESSION['alert'][] = new Alert('danger', 'Falta especificar la operación');
        header('Location: ' . BASE_URL . '/dashboard/error');
    }
});
$router->post('/dashboard/action/confirm', function() {
    define('BOX_ID', $_POST['id']);
    if ($_GET['option'] == 'sell') {
        Controller::load('warehouse/box/delete');
    } else if ($_GET['option'] == 'refund') {
        Controller::load('warehouse/refund/do-it');
    } else {
        $_SESSION['alert'][] = new Alert('danger', 'Operación no válida');
        header('Location: ' . BASE_URL . '/dashboard/error');
        exit;
    }
});

///////////////////
// USER SETTINGS //
///////////////////
$router->get('/dashboard/profile/settings', function() {
    // create and show the view
    if(isset($_SESSION['warehouse'])){
        View::setFile('user/settings');
        View::load();
        unset($_SESSION['warehouse']);
    }else{
        Controller::load('user/loadDataConfig');
    }
});
$router->post('/dashboard/profile/settings', function() {
    if (isset($_POST['changePassword'])) {
        Controller::load('user/change.password');
    } else if (isset($_POST['changeEmail'])) {
        Controller::load('user/change.email');
    } else if (isset($_POST['changeProfile'])) {
        Controller::load('user/change.profile');
    } else if (isset($_POST['changeCompany'])) {
        Controller::load('user/change.company');
    } else {
        header('Location: ' . BASE_URL . '/dashboard/profile/settings');
    }
});


////////////
// LOGOUT //
////////////
$router->get('/logout', function() {
    Controller::load('user/logout');
});
