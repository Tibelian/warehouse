<?php
View::setTitle('Listado Estanterías');
View::addCss('<link rel="stylesheet" href="' . BASE_URL . '/assets/css/datatables.min.css">');
View::addJs('<script src="' . BASE_URL . '/assets/js/datatables.min.js"></script>');
View::loadHeader();
?>


<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-12 my-3">

            <div class="d-flex justify-content-center">
                <a class="btn btn-sm btn-primary mb-3" href="<?= BASE_URL . '/dashboard/shelf/add';?>"><i class="fas fa-plus-circle"></i> Añadir nueva</a>
                <a class="btn btn-sm btn-success ml-3 mb-3" href="<?= BASE_URL . '/dashboard/shelf/backup';?>"><i class="fas fa-database"></i> Listado backup</a>
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

                <table id="shelfList" class="table table-sm table-hover table-striped table-dark table-borderless bg-opacity">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Material</th>
                            <th scope="col">Total lejas</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    $shelfList = $_SESSION['shelfList'];
                    foreach($shelfList as $shelf){
                    ?>
                    <tr>
                        <th scope="row"><a href="<?= BASE_URL . '/dashboard/shelf/edit/' . $shelf->getId(); ?>"><i class="fas fa-edit"></i></a></th>
                        <td><?= $shelf->getCode(); ?></td>
                        <td><?= $shelf->getMaterial(); ?></td>
                        <td><?= $shelf->getNumRack(); ?></td>
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
        $('#shelfList').DataTable({
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