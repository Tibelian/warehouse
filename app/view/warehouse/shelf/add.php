<?php
View::setTitle('Añadir Estantería');
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

                <div class="form-group">
                    <label for="code"><i class="fas fa-hashtag"></i> Código:</label>
                    <input type="text" class="form-control" pattern="^ES.+" maxlength="5" title="El código debe empezar por ES" name="code" value="ES" id="code" required>
                </div>
                <div class="form-group">
                    <label for="material"><i class="fas fa-adjust"></i> Material:</label>
                    <input type="text" class="form-control" name="material" id="material" required>
                </div>
                <div class="form-group">
                    <label for="numRack"><i class="fas fa-ruler-vertical"></i> Nº lejas:</label>
                    <input type="text" class="form-control" name="numRack" id="numRack" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="corridor"><i class="fas fa-columns"></i> Pasillo:</label>
                        <select class="form-control" name="corridor" id="corridor" required onchange="loadCorridor('<?= BASE_URL; ?>', this.value);">
                            <?php
                            foreach($_SESSION['corridor'] as $corridor){
                            ?>
                            <option value="<?= $corridor['id'] ?>"><?= $corridor['letter'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="position"><i class="fas fa-align-justify"></i> Posición:</label>
                        <select class="form-control" name="position" id="position" required></select>
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
View::addJs('
<script>
    var corridor = document.getElementById("corridor");
    loadCorridor("'.BASE_URL.'", corridor.value);
</script>
');
View::loadFooter();
?>