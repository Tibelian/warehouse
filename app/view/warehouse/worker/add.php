<?php
View::setTitle('Añadir Trabajador');
View::loadHeader();
?>


<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-md-6 my-3">

            <?php
            if(isset($_SESSION['alert'])){
                foreach($_SESSION['alert'] as $alert){
                    echo $alert;
                }
                unset($_SESSION['alert']);
            }
            ?>

            <form id="workerForm" action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-3 rounded">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName"><i class="fas fa-user"></i> Nombre:</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName"><i class="fas fa-user"></i> Apellidos:</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dni"><i class="fas fa-id-card"></i> DNI:</label>
                    <input type="text" class="form-control" name="dni" id="dni" required>
                </div>
                <div class="form-group">
                    <label for="charge"><i class="fas fa-pencil-ruler"></i> Cargo:</label>
                    <input type="text" class="form-control" name="charge" id="charge" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="bornDate"><i class="far fa-calendar"></i> Fecha nacimiento:</label>
                        <input type="date" class="form-control" name="bornDate" id="bornDate" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="joinDate"><i class="fas fa-calendar"></i> Fecha ingreso:</label>
                        <input type="date" class="form-control" name="joinDate" id="joinDate" value="<?= date("Y-m-d"); ?>" required>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-50"><i class="fas fa-plus"></i> Añadir</button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php
View::loadFooter();
?>