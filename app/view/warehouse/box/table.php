<?php
View::setTitle('Listado Cajas');
View::addCss('<link rel="stylesheet" href="' . BASE_URL . '/assets/css/datatables.min.css">');
View::addJs('<script src="' . BASE_URL . '/assets/js/datatables.min.js"></script>');
View::loadHeader();
?>

<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-12 my-3">

            <div class="d-flex justify-content-center">
                <a class="btn btn-sm btn-primary mb-3" href="<?= BASE_URL . '/dashboard/box/add';?>"><i class="fas fa-plus-circle"></i> Añadir nueva</a>
            </div>

            <?php
            if(isset($_SESSION['alert'])){
                foreach($_SESSION['alert'] as $alert){
                    echo $alert;
                }
                unset($_SESSION['alert']);
            }
            ?>

            <div class="row table-responsive">

                <table id="boxList" class="table table-sm table-hover table-striped table-dark table-borderless bg-opacity">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Material</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Color</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $boxList = $_SESSION['boxList'];
                        foreach($boxList as $box){
                        ?>
                        <tr>
                            <th scope="row"><a href="<?= BASE_URL . '/dashboard/box/edit/' . $box->getId(); ?>"><i class="fas fa-edit"></i></a></th>
                            <td><?= $box->getCode(); ?></td>
                            <td><?= $box->getMaterial(); ?></td>
                            <td><?= $box->getContent(); ?></td>
                            <td><div style="width:75px; height:25px; background-color:<?= $box->getColor(); ?>;"></div></td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

<?php
View::addJs("
<script>
    $(document).ready( function () {
        $('#boxList').DataTable({
            language: {
                'decimal':        ',',
                'emptyTable':     'No hay datos en la tabla',
                'info':           'Página _START_ con _TOTAL_ entradas',
                'infoEmpty':      'Sin entradas',
                'infoFiltered':   '(filtrado de un total de _MAX_ entradas)',
                'infoPostFix':    '',
                'thousands':      ' ',
                'lengthMenu':     'Mostrar _MENU_ entradas',
                'loadingRecords': 'Cargando...',
                'processing':     'Procesando...',
                'search':         'Buscar:',
                'zeroRecords':    'No se han encontrado entradas que coincidan',
                'paginate': {
                    'first':      'Primera',
                    'last':       'Última',
                    'next':       '<i class=\"fas fa-arrow-right\"></i>',
                    'previous':   '<i class=\"fas fa-arrow-left\"></i>'
                }
            }
        });
    } );
</script>
");
View::loadFooter();
?>