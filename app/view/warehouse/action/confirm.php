<?php
if($_GET['option'] == 'sell'){

    View::setTitle('Confirmar venta');
    View::loadHeader();
    $box = $_SESSION['box'];
    $association = $_SESSION['association'];
    $shelf = $_SESSION['shelf'];
    ?>

    <div class="row justify-content-center m-0 my-4">
        <div class="col-md-8">

            <table class="table text-white table-borderless rounded mb-0 bg-opacity">
                <thead>
                    <tr>
                        <th colspan="3" class="bg-opacity text-center text-warning">¿Seguro que quieres vender esta caja?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Código: </strong> <?= $box->getCode(); ?>
                        </td>
                        <td>
                            <strong>Fecha alta: </strong> <?= date("d/m/Y H:i", strtotime($box->getDate())); ?>
                        </td>
                        <td>
                            <strong>Material: </strong> <?= $box->getMaterial(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Altura: </strong> <?= $box->getHeight(); ?>
                        </td>
                        <td>
                            <strong>Anchura: </strong> <?= $box->getWidth(); ?>
                        </td>
                        <td>
                            <strong>Profundidad: </strong> <?= $box->getDepth(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Estantería: </strong> <?= $shelf->getCode(); ?>
                        </td>
                        <td>
                            <strong>Leja: </strong> <?= $association->rack_pos; ?>
                        </td>
                        <td>
                            <strong>Pasillo: </strong> <?= $shelf->getCorridor(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <strong>Contenido: </strong> <?= $box->getContent(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
                                <input type="hidden" name="id" value="<?= $box->getId(); ?>">
                                <button class="btn btn-primary mt-5" type="submit">Vender caja</button>
                            </form>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-danger mt-5" href="<?= BASE_URL; ?>/dashboard/sell">Mejor no</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <?php
    View::loadFooter();

}else if($_GET['option'] == 'refund'){

    View::setTitle('Confirmar devolución');
    View::loadHeader();
    $box = $_SESSION['box'];
    ?>

    <div class="row justify-content-center m-0 my-4">
        <div class="col-md-8">

            <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
                <table class="table text-white table-borderless rounded mb-0 bg-opacity">
                    <thead>
                        <tr>
                            <th colspan="3" class="bg-opacity text-center text-warning">¿Seguro que quieres devolver esta caja?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Código: </strong> <?= $box->getCode(); ?>
                            </td>
                            <td>
                                <strong>Fecha alta: </strong> <?= date("d/m/Y H:i", strtotime($box->getDate())); ?>
                            </td>
                            <td>
                                <strong>Material: </strong> <?= $box->getMaterial(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Altura: </strong> <?= $box->getHeight(); ?>
                            </td>
                            <td>
                                <strong>Anchura: </strong> <?= $box->getWidth(); ?>
                            </td>
                            <td>
                                <strong>Profundidad: </strong> <?= $box->getDepth(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Estantería: </strong> 
                                <select name="shelf" class="form-control form-control-sm" onchange="loadRacks('<?= BASE_URL; ?>', this.value); loadCorridorLetter('<?= BASE_URL; ?>', this.value)">
                                <?php
                                    foreach($_SESSION['shelfList'] as $shelf){
                                    ?>
                                    <option value="<?= $shelf->getId(); ?>" <?php if($shelf->getId() == $box->getShelfId()){echo 'selected';} ?>><?= $shelf->getCode(); ?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                            </td>
                            <td>
                                <strong>Leja: </strong>
                                <select name="rack" class="form-control form-control-sm" id="rack">
                                </selected>
                            </td>
                            <td>
                                <strong>Pasillo: </strong> <span class="badge badge-success" id="corridor_letter"><?= $box->getCorridor(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Fecha venta: </strong> <?= date("d/m/Y H:i", strtotime($box->getDateOut())); ?>
                            </td>
                            <td colspan="2">
                                <strong>Contenido: </strong> <?= $box->getContent(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                    <input type="hidden" name="code" value="<?= $box->getCode(); ?>">
                                    <button class="btn btn-primary mt-5" type="submit"> Devolver caja</button>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-danger mt-5" href="<?= BASE_URL; ?>/dashboard/sell">Mejor no</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>
    </div>

    <?php
    View::addJs('<script>loadRacks("'.BASE_URL.'", '.$box->getShelfId().', false);</script>');
    View::loadFooter();

}else{
    $_SESSION['alert'][] = new Alert('danger', 'Operación no válida. Falta especificar la opción');
    header('Location: ' . BASE_URL . '/dashboard/error');
    exit;
}
?>