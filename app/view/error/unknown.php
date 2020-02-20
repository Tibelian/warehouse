<?php
View::setTitle('Error inesperado');
View::loadHeader();
?>

    <div class="container-fluid">

        <div class="row justify-content-center m-2">
            <div class="col-md-6 bg-opacity text-center p-5">
                <i class="fas fa-exclamation-triangle display-1 mb-3"></i>
                <h2>Ha ocurrido un error inesperado</h2>
                
                <?php
                if(isset($_SESSION['alert'])){
                    foreach($_SESSION['alert'] as $alert){
                        echo $alert;
                    }
                    unset($_SESSION['alert']);
                }
                ?>

            </div>
        </div>

    </div>

<?php
View::loadFooter();
?>