<?php
View::setTitle('Añadir Caja');
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
                    <input type="text" class="form-control" pattern="^CA.+" maxlength="5" title="El código debe empezar por CA" name="code" id="code" value="CA" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="material"><i class="fas fa-adjust"></i> Material:</label>
                        <input type="text" class="form-control" name="material" id="material" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="color"><i class="fas fa-palette"></i> Color:</label>
                        <input type="color" class="form-control" name="color" id="color" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><i class="fas fa-truck-loading"></i> Contenido:</label>
                    <input type="text" class="form-control" name="content" id="content" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="height"><i class="fas fa-arrows-alt-v"></i> Altura:</label>
                        <input type="number" step="any" class="form-control" name="height" id="posiheighttion" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="width"><i class="fas fa-arrows-alt-h"></i> Anchura:</label>
                        <input type="number" step="any" class="form-control" name="width" id="width" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="depth"><i class="fas fa-compress-arrows-alt"></i> Profundidad:</label>
                        <input type="number" step="any" class="form-control" name="depth" id="depth" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="shelve"><i class="fas fa-columns"></i> Estantería:</label>
                        <select class="form-control" name="shelve" id="shelve" required onchange="loadRacks('<?= BASE_URL; ?>', this.value);">
                        <?php
                        foreach($_SESSION['shelfList'] as $shelf){
                        ?>
                            <option value="<?= $shelf->getId(); ?>"><?= $shelf->getCode(); ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="rack"><i class="fas fa-ruler-vertical"></i> Leja:</label>
                        <select class="form-control" name="rack" id="rack" required></select>
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
    var shelve = document.getElementById("shelve");
    loadRacks("'.BASE_URL.'", shelve.value);
</script>
');
View::loadFooter();
?>