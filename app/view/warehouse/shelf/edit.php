<?php
View::setTitle('Editar Estantería');
View::loadHeader();
$shelf = $_SESSION['shelf'];
?>

<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-md-6 my-3">

            <?php
            if (isset($_SESSION['alert'])) {
                foreach ($_SESSION['alert'] as $alert) {
                    echo $alert;
                }
                unset($_SESSION['alert']);
            }
            ?>

            <form id="workerForm" action="<?= $_SERVER['REQUEST_URI']; ?>" method="post" class="bg-opacity p-3 rounded">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="code"><i class="fas fa-hashtag"></i> Código:</label>
                        <input type="text" class="form-control" pattern="^ES.+" maxlength="5" name="code" id="code" required value="<?= $shelf->getCode(); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date"><i class="fas fa-calendar"></i> Fecha:</label>
                        <input type="datetime-local" class="form-control" name="date" id="date" required value="<?= date("Y-m-d", strtotime($shelf->getDate())); ?>T<?= date("H:i", strtotime($shelf->getDate())); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="material"><i class="fas fa-adjust"></i> Material:</label>
                    <input type="text" class="form-control" name="material" id="material" required value="<?= $shelf->getMaterial(); ?>">
                </div>
                <div class="form-group">
                    <label for="numRack"><i class="fas fa-ruler-vertical"></i> Nº lejas:</label>
                    <input type="text" class="form-control" name="numRack" id="numRack" required value="<?= $shelf->getNumRack(); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="corridor"><i class="fas fa-columns"></i> Pasillo:</label>
                        <select class="form-control" name="corridor" id="corridor" required>
                            <?php
                            foreach ($_SESSION['corridor'] as $corridor) {
                                ?>
                                <option value="<?= $corridor['id'] ?>" <?php if ($shelf->getCorridor() == $corridor['id']) {
                                echo 'selected';
                            } ?>><?= $corridor['letter'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="position"><i class="fas fa-align-justify"></i> Posición:</label>
                        <select class="form-control" name="position" id="position" required>
                            <option selected value="<?= $shelf->getPosition(); ?>"><?= $shelf->getPosition(); ?></option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary col-9"><i class="fas fa-edit"></i> Modificar</button>
                    <button type="button" class="btn btn-danger col-2" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

            </form>
            
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Eliminar estantería</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="delete" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>" onsubmit="return confirm('Estas apunto de eliminar la estantería. ¿Quieres seguir?');">
                                
                                <div class="form-group">
                                    <label for="reason">Introduce la razón: </label>
                                    <textarea class="form-control" name="reason" id="reason" required rows="7"></textarea>
                                </div>
                                <input type="hidden" name="code" value="<?= $shelf->getCode() ?>">
                                
                            </form>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" form="delete" name="delete" class="btn btn-primary">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
View::addJs('
<script>
    var corridor = document.getElementById("corridor");
    loadCorridor("' . BASE_URL . '", corridor.value, false);
</script>
');
View::loadFooter();
?>