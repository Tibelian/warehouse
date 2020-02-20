<?php
View::setTitle('Inventario en tabla');
View::loadHeader();
?>
    
    <div class="container-fluid">

        <div class="row m-2 table-responsive">

            <table class="table table-sm table-borderless border text-white w-100 inventory" style="font-size: 13px;">
            <?php
                foreach($_SESSION['inventory'] as $data){
                    if($data instanceof Shelf){
                    ?>
                    <tr class="bg-opacity">
                        <th class="align-middle">ESTANTERÍA</th>
                        <!-- <td><strong>ID: </strong><?= $data->getId(); ?></td> -->
                        <td><strong>CÓDIGO: </strong><?= $data->getCode(); ?></td>
                        <td><strong>MATERIAL: </strong><?= $data->getMaterial(); ?></td>
                        <td><strong>Nº LEJAS: </strong><?= $data->getNumRack(); ?></td>
                        <td><strong>PASILLO: </strong><?= $data->getCorridor(); ?></td>
                        <td><strong>POSICIÓN: </strong><?= $data->getPosition(); ?></td>
                        <td colspan="4"><strong>FECHA: </strong><?= date("d-m-Y H:i", strtotime($data->getDate())); ?></td>
                    </tr>
                    <?php
                    }
                    if($data instanceof Box){
                    ?>
                    <tr style="color: rgba(255,255,255,.5);">
                        <th class="align-middle">CAJA</th>
                        <!-- <td><strong>ID: </strong><?= $data->getId(); ?></td> -->
                        <td><strong>CÓDIGO: </strong><?= $data->getCode(); ?></td>
                        <td><strong>MATERIAL: </strong><?= $data->getMaterial(); ?></td>
                        <td><strong>CONTENIDO: </strong><?= $data->getContent(); ?></td>
                        <td><strong>LEJA: </strong><?= $data->getRack(); ?></td>
                        <td><strong>COLOR: </strong> <div style="background-color:<?= $data->getColor(); ?>; width: 100%; height: 13px;"></div></td>
                        <td><strong>ALTURA: </strong><?= $data->getHeight(); ?></td>
                        <td><strong>ANCHURA: </strong><?= $data->getWidth(); ?></td>
                        <td><strong>PROFUNDIDAD: </strong><?= $data->getDepth(); ?></td>
                        <td><strong>FECHA: </strong><?= date("d-m-Y H:i", strtotime($data->getDate())); ?></td>
                    </tr>
                    <?php
                    }
                ?>
                <?php
                }
                ?>
            </table>

        </div>
    </div>

<?php
View::loadFooter();
?>