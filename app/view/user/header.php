<!doctype html>
<html lang="es">
<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- css -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/fa-all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/assets/css/login.css">
    <title>Iniciar sesión - <?= WEB_NAME; ?></title>

</head>
<body>

    <main class="container">
        
        <div class="row justify-content-center">
            <div class="col-xs-9 col-sm-8 col-md-7 col-lg-5 col-11 p-0 position-relative">

            <div class="alert-fixed">
                    <?php
                        if(isset($_SESSION['alert'])){
                            foreach($_SESSION['alert'] as $alert){
                                echo $alert;
                            }
                            unset($_SESSION['alert']);
                        }
                    ?>
                </div>