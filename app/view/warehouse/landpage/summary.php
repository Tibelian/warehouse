<?php
View::setTitle('Resumen');
View::addCss('<link rel="stylesheet" href="' . BASE_URL . '/assets/css/Chart.min.css">');
View::addJs('<script src="' . BASE_URL . '/assets/js/Chart.min.js"></script>');
View::loadHeader();
?>

<div class="container-fluid">

    <?php
    if (isset($_SESSION['alert'])) {
        foreach ($_SESSION['alert'] as $alert) {
            echo $alert;
        }
        unset($_SESSION['alert']);
    }
    ?>

    <div class="row m-2">
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-users text-primary"></i> Ventas</p>
            <span class="h2 text-primary"><?= $_SESSION['summary']['boxOut']; ?></span>
        </div>
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-columns text-secondary"></i> Estanterías</p>
            <span class="h2 text-secondary"><?= $_SESSION['summary']['shelve']; ?></span>
        </div>
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-boxes text-brown"></i> Cajas</p>
            <span class="h2 text-brown"><?= $_SESSION['summary']['box']; ?></span>
        </div>
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-bars text-info"></i> Lejas totales</p>
            <span class="h2 text-info"><?= $_SESSION['summary']['totalRack']; ?></span>
        </div>
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-times text-danger"></i> Lejas ocupadas</p>
            <span class="h2 text-danger"><?= $_SESSION['summary']['busyRack']; ?></span>
        </div>
        <div class="col-lg-2 col-md-6 text-center mb-3 bg-opacity p-3">
            <p class="border-bottom"><i class="fas fa-check text-success"></i> Lejas libres</p>
            <span class="h2 text-success"><?= $_SESSION['summary']['freeRack']; ?></span>
        </div>
    </div>

    <div class="row m-2">
        <div class="col-md-9">
            <div class="row charts">
                <div class="col-md-6 p-3 bg-opacity mb-3">
                    <canvas id="chart1" width="100%"></canvas>
                </div>
                <div class="col-md-6 p-3 bg-opacity mb-3">
                    <h4>Empresa: </h4> <?= $_SESSION['summary']['warehouse']['business_name'] ?> <br><br>
                    <h4>Almacén: </h4> <?= $_SESSION['summary']['warehouse']['warehouse_name'] ?> <br><br>
                    <h4>Código: </h4> <?= $_SESSION['summary']['warehouse']['warehouse_code'] ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-3 mb-3 bg-opacity">
            <p class="border-bottom"><i class="fas fa-circle text-primary"></i> Huecos pasillos</p>
            <span class="h2 text-primary"><?= $_SESSION['summary']['corridorPos']; ?></span>
            <p class="border-bottom mt-4"><i class="fas fa-circle text-danger"></i> Pasillos</p>
            <span class="h2 text-danger">
                <?php
                $i = 0;
                foreach($_SESSION['summary']['corridors'] as $letter){
                    echo $letter;
                    if($i != sizeof($_SESSION['summary']['corridors'])-1){
                        echo ", ";
                    }
                    $i++;
                }
                ?>
            </span>
        </div>
    </div>



</div>

<?php
View::addJs("
<script>
var chart1 = document.getElementById('chart1');
chart1.height = 75;
var myChart1 = new Chart(chart1, {
    type: 'pie',
    data: {
        labels: ['Lejas ocupadas', 'Lejas libres'],
        datasets: [{
            label: '# of Votes',
            data: [" . $_SESSION['summary']['busyRack'] . ", " . $_SESSION['summary']['freeRack'] . "],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
");
View::loadFooter();
?>