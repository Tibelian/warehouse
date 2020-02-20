<!doctype html>
<html lang="es">
<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= BASE_URL; ?>/assets/img/favicon.png">
    <!-- css -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/fa-all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/main.css">
    <?php
    // show extra css added to the view
    $cssList = View::getCss();
    foreach($cssList as $css){
        echo $css;
    }
    ?>
    <title><?= View::getTitle(); ?> - <?= WEB_NAME; ?></title>

</head>
<body>

    <main>

        <!-- navigation bar -->
        <aside id="aside">
            <div class="py-3 d-flex flex-column align-items-center justify-content-center text-white">
                <div class="profile" style="background-image:url('<?= BASE_URL . '/assets/img/avatar/' . Session::getUser()->getImage(); ?>');"></div>
                <p class="mb-0 mt-1"><?= Session::getUser()->getUserName(); ?></p>
                <p class="mb-0 text-muted"><small><?= Session::getUser()->getEmail(); ?></small></p>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard"><i class="fas fa-chart-pie"></i> Resumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard/shelf"><i class="fas fa-columns"></i> Estanterías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard/box"><i class="fas fa-boxes"></i> Cajas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard/inventory"><i class="fas fa-warehouse"></i> Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard/sell"><i class="fas fa-truck"></i> Venta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL; ?>/dashboard/refund/new"><i class="fas fa-undo"></i> Devolución</a>
                </li>
            </ul>
        </aside>
        
        <!-- main section -->
        <section class="mcontent row flex-column mx-0">

            <!-- current page title -->
            <header class="d-flex justify-content-between align-items-center px-3">
                <button class="btn btn-nav btn-dark" id="navbar"><i class="fas fa-bars"></i></button>
                <h1><?= View::getTitle(); ?></h1>
                <nav class="navbar navbar-dark p-0">
                    <ul class="navbar-nav flex-row justify-content-center">
                        <li class="nav-item mx-2"><a class="nav-link text-center" href="<?= BASE_URL; ?>/dashboard/profile/settings"><i class="fas fa-cog h5 d-block"></i> Ajustes</a></li>
                        <li class="nav-item mx-2"><a class="nav-link text-center" href="<?= BASE_URL; ?>/logout"><i class="fas fa-sign-out-alt h5 d-block"></i> Salir</a></li>
                    </ul>
                </nav>
            </header>