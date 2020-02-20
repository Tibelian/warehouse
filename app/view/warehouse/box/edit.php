<?php
View::setTitle('Editar Caja');
View::loadHeader();
$box = $_SESSION['box'];
$association = $_SESSION['association'];
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
                    <div class="form-group col-sm-6">
                        <label for="code"><i class="fas fa-hashtag"></i> Código:</label>
                        <input type="text" class="form-control" pattern="^CA.+" maxlength="5" name="code" id="code" required value="<?= $box->getCode(); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="date"><i class="fas fa-calendar"></i> Fecha:</label>
                        <input type="datetime-local" class="form-control" name="date" id="date" required value="<?= date("Y-m-d", strtotime($box->getDate())); ?>T<?= date("H:i", strtotime($box->getDate())); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="material"><i class="fas fa-adjust"></i> Material:</label>
                        <input type="text" class="form-control" name="material" id="material" required value="<?= $box->getMaterial(); ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="color"><i class="fas fa-palette"></i> Color:</label>
                        <input type="color" class="form-control" name="color" id="color" required value="<?= $box->getColor(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content"><i class="fas fa-truck-loading"></i> Contenido:</label>
                    <input type="text" class="form-control" name="content" id="content" required value="<?= $box->getContent(); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="height"><i class="fas fa-arrows-alt-v"></i> Altura:</label>
                        <input type="number" step="any" class="form-control" name="height" id="posiheighttion" required value="<?= $box->getHeight(); ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="width"><i class="fas fa-arrows-alt-h"></i> Anchura:</label>
                        <input type="number" step="any" class="form-control" name="width" id="width" required value="<?= $box->getWidth(); ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="depth"><i class="fas fa-compress-arrows-alt"></i> Profundidad:</label>
                        <input type="number" step="any" class="form-control" name="depth" id="depth" required value="<?= $box->getDepth(); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="shelve"><i class="fas fa-columns"></i> Estantería:</label>
                        <select class="form-control" name="shelve" id="shelve" required onchange="loadRacks('<?= BASE_URL; ?>', this.value);">
                        <?php
                        foreach($_SESSION['shelfList'] as $shelf){
                        ?>
                            <option value="<?= $shelf->getId(); ?>" <?php if($association->shelf_id == $shelf->getId()){echo 'selected';} ?> ><?= $shelf->getCode(); ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="rack"><i class="fas fa-ruler-vertical"></i> Leja:</label>
                        <select class="form-control" name="rack" id="rack" required>
                            <option selected value="<?= $association->rack_pos; ?>"><?= $association->rack_pos; ?></option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary col-9"><i class="fas fa-edit"></i> Modificar</button>
                    <button type="submit" form="delete" name="delete" class="btn btn-outline-danger col-2"><i class="fas fa-trash"></i></button>
                </div>

            </form>
            
            <form id="delete" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>" onsubmit="return confirm('Estas apunto de eliminar la caja ¿De verdad quieres seguir?');"></form>
        </div>
    </div>

</div>

<?php
View::addJs('
<script>
    var shelve = document.getElementById("shelve");
    loadRacks("'.BASE_URL.'", shelve.value, false);
</script>
');
View::loadFooter();
?>