<?php
require_once("../modelo/servicios.php");
error_reporting(0);
$conteoNO = "";
$numCargue = "";
$conteoIndividual = "";
if (isset($_SESSION['sesion'])) {
    if ($_SESSION['sesion'] != 1 && $_SESSION['sesion'] != 2) {
        echo "<script>window.location.href = '../inventario/login';</script>";
    } else {
        $usuario = $_SESSION['nombre'];
        $sesion=$_SESSION['sesion'];
    }
} else {
    echo "<script>window.location.href = '../inventario/login';</script>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Inventarios Olimpia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/block.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/select2.min.js"></script>
    <link href="../css/select2.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../css/images/caja.png" />
    <link rel="stylesheet" href="../css/main.css" />


</head>

<body class="body">

    <div class="container-fluid position-sticky color-fondo ">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="col-3 col-md-1 col-lg-1 mr-3 bg-white rounded p-1">
                <img src="../css/images/invol.png" alt="" width="100%">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="row collapse navbar-collapse" id="collapsibleNavbar">

                <div class="btn-group col-12 col-md-4 col-lg-3 text-center">
                    <button class="btn" onclick="cerrar()">
                        <h5 class="my-auto menu">Cerrar Sesión</h5>
                    </button>
                </div>
                <?php
                if($sesion==1){
                    echo '<div class="btn-group col-12 col-md-3 col-lg-3 text-center">
                <button class="btn" onclick="regresar()">
                    <h5 class="my-auto menu">Regresar</h5>
                </button>
            </div>';
                }else if($sesion==2){
                    echo '<div class="btn-group col-12 col-md-3 col-lg-3 text-center">
                    <button class="btn" onclick="regresar2()">
                        <h5 class="my-auto menu">Regresar</h5>
                    </button>
                </div>';
                }
               
                ?>
            </div>
            <div class="col-12 col-md-2 col-lg-4 mt-2">
                <h5 class="my-auto text-center text-white">Bienvenid@ <?php echo $usuario ?></h5>
            </div>
        </nav>
    </div>

    <div class="container-fluid mb-4">

        <div class="row text-center justify-content-around">

            <div class="col-12 text-center mb-2 bg-white p-3 shadow">
                <h6 class="my-auto ">En esta área podrás consultar el inventario de dispositivos disponible</h6>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-danger text-white rounded-lg">Biométrico</h6>
                <h3 class=" mb-2"><img src="../css/images/morpho.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-success rounded-lg shadow text-white p-2">50 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-secondary text-white rounded-lg">Biométrico</h6>
                <h3 class=" mb-2"><img src="../css/images/futronic.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-success rounded-lg shadow text-white p-2">20 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-info text-white rounded-lg">Cámara</h6>
                <h3 class=" mb-2"><img src="../css/images/camara.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-success rounded-lg shadow text-white p-2">20 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-light text-dark rounded-lg">Escáner</h6>
                <h3 class=" mb-2"><img src="../css/images/escaner.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-success rounded-lg shadow text-white p-2">40 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-secondary text-white rounded-lg">Pad de firmas</h6>
                <h3 class=" mb-2"><img src="../css/images/wacom.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-success rounded-lg shadow text-white p-2">10 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-1 m-2 rounded shadow-lg text-left">
                <h6 class="text-center bg-dark text-white rounded-lg">Pad de firmas</h6>
                <h3 class=" mb-2"><img src="../css/images/epadlink.png " width="50%">&nbsp; &nbsp; &nbsp;<strong class="bg-danger rounded-lg shadow text-white p-2">0 Unds</strong> </h3>
                <a href="">
                    <h6 class="text-center rounded-lg shadow">Consultar inventario detallado aquí</h6>
                </a>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom my-auto color-fondo d-none d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>