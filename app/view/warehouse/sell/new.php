<?php
View::setTitle('Vender caja');
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
                    <label for="code"><i class="fas fa-hashtag"></i> Código caja:</label>
                    <input type="text" class="form-control" pattern="^CA.+" maxlength="5" title="El código debe empezar por CA" name="code" value="CA" id="code" list="boxes" autocomplete="off" required>
                    <datalist id="boxes">
                        <?php
                        foreach($_SESSION['boxes'] as $box){
                        ?>
                        <option value="<?= $box->getCode(); ?>"><?= $box->getCode(); ?></option>
                        <?php
                        }
                        ?>
                    </datalist>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger w-50"><i class="fas fa-minus"></i> Vender</button>
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