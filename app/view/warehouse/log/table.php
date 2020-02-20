<?php
View::setTitle('Registros de actividad');
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

            <div class="row table-responsive">

                <table id="logList" class="table table-sm table-hover table-striped table-dark table-borderless bg-opacity">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Resultado</th>
                            <th scope="col">Dirección IP</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $logList = $_SESSION['logList'];
                        foreach($logList as $log){
                        ?>
                        <tr>
                            <th scope="row"><a href="<?= BASE_URL . '/dashboard/log/delete/' . $log->getId(); ?>"><i class="fas fa-trash"></i></a></th>
                            <td><?= $log->getUser(); ?></td>
                            <td><?= $log->getAction(); ?></td>
                            <td><?= $log->getResult(); ?></td>
                            <td><?= $log->getIp(); ?></td>
                            <td><?= date("d-m-Y H:i", strtotime($log->getDate())); ?></td>
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