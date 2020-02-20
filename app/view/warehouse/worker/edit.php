<?php
View::setTitle('Editar Trabajador');
View::loadHeader();
$worker = $_SESSION['worker'];
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
                        <input type="text" class="form-control" name="firstName" id="firstName" required value="<?= $worker->getFirstName(); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName"><i class="fas fa-user"></i> Apellidos:</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" required value="<?= $worker->getLastName(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dni"><i class="fas fa-id-card"></i> DNI:</label>
                    <input type="text" class="form-control" name="dni" id="dni" required value="<?= $worker->getDni(); ?>">
                </div>
                <div class="form-group">
                    <label for="charge"><i class="fas fa-pencil-ruler"></i> Cargo:</label>
                    <input type="text" class="form-control" name="charge" id="charge" required value="<?= $worker->getCharge(); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="bornDate"><i class="far fa-calendar"></i> Fecha nacimiento:</label>
                        <input type="date" class="form-control" name="bornDate" id="bornDate" required value="<?= $worker->getBornDate(); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="joinDate"><i class="fas fa-calendar"></i> Fecha ingreso:</label>
                        <input type="date" class="form-control" name="joinDate" id="joinDate" required value="<?= $worker->getJoinDate(); ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary col-9"><i class="fas fa-edit"></i> Modificar</button>
                    <button type="submit" name="delete" form="delete" class="btn btn-outline-danger col-2"><i class="fas fa-trash"></i></button>
                </div>

            </form>

            <form id="delete" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>" onsubmit="return confirm('Estas a punto de elimnar al empleado. ¿Quieres seguir?');"></form>

        </div>
    </div>

</div>

<?php
View::loadFooter();
?>