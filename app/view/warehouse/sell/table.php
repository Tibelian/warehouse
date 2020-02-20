<?php
View::setTitle('Listado de ventas');
View::addCss('<link rel="stylesheet" href="' . BASE_URL . '/assets/css/datatables.min.css">');
View::addJs('<script src="' . BASE_URL . '/assets/js/datatables.min.js"></script>');
View::loadHeader();
?>

<div class="container-fluid">

    <div class="row m-2 justify-content-center">
        <div class="col-12 my-3">

            <?php
            if(isset($_SESSION['alert'])){
                foreach($_SESSION['alert'] as $alert){
                    echo $alert;
                }
                unset($_SESSION['alert']);
            }
            ?>

            <div class="d-flex justify-content-center mb-3">
                <a class="btn btn-danger" href="<?= BASE_URL; ?>/dashboard/sell/new"><i class="fas fa-arrow-down"></i> Vender otra caja</a>
            </div>

            <div class="row table-responsive">

                <table id="logList" class="table table-sm table-hover table-striped table-dark table-borderless bg-opacity">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Material</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Color</th>
                            <th scope="col">Fecha Alta</th>
                            <th scope="col">Fecha Baja</th>
                            <th scope="col">Código estantería</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $boxList = $_SESSION['boxList'];
                        foreach($boxList as $box){
                        ?>
                        <tr>
                            <th scope="row">    
                                <form action="<?= BASE_URL; ?>/dashboard/refund/new" method="post">
                                    <input type="hidden" value="<?= $box->getCode(); ?>" name="code">
                                    <button title="Haga click para devolver la caja" type="submit" class="btn btn-link p-0"><i class="fas fa-sync"></i></button>
                                </form>
                            </th>
                            <td><?= $box->getCode(); ?></td>
                            <td><?= $box->getMaterial(); ?></td>
                            <td><?= $box->getContent(); ?></td>
                            <td><div style="background-color:<?= $box->getColor(); ?>; width: 75%; height: 25px;"></div></td>
                            <td><?= date("d/m/Y H:i", strtotime($box->getDate())); ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($box->getDateOut())); ?></td>
                            <td><?= $box->getShelf(); ?></td>
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
        $('#logList').DataTable({
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