<?php
session_start();
if (isset($_SESSION['sesion'])) {
    if ($_SESSION['sesion'] != 1) {
        echo "<script>window.location.href = '../inventario/login';</script>";
    } else {
        $tipo_actividad = '';
        $usuario = $_SESSION['nombre'];
        unset($_SESSION['conteoNO']);
        unset($_SESSION['conteoIndividual']);
        unset($_SESSION['dispositivo']);
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
    <style>
        img:hover {
            opacity: 0.5 !important;
            filter: alpha(opacity=70) !important;
        }
    </style>
</head>

<body class="body">
    <div class="container-fluid sticky-top color-fondo">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="col-3 col-md-1 col-lg-1 mr-3 bg-white rounded p-1">
                <img src="../css/images/invol.png" alt="" width="100%">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="row collapse navbar-collapse" id="collapsibleNavbar">

                <div class="btn-group col-12 col-md-3 col-lg-3 text-center ">
                    <button class="btn" onclick="usuarios()">
                        <h5 class="my-auto menu">Usuarios</h5>
                    </button>
                </div>

                <div class="btn-group col-12 col-md-3 col-lg-3 text-center ">
                    <button class="btn " onclick="">
                        <h5 class="my-auto menu">Configuración</h5>
                    </button>
                </div>

                <div class="btn-group col-12 col-md-4 col-lg-3 text-center">
                    <button class="btn" onclick="cerrar()">
                        <h5 class="my-auto menu">Cerrar Sesión</h5>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-2 col-lg-4 mt-2">
                <h5 class="my-auto text-center text-white">Bienvenid@ <?php echo $usuario ?></h5>
            </div>
        </nav>
    </div>

    <div class="container mt-lg-2 mt-3">

        <div class="row text-center justify-content-around ">

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn" onclick="entradas()"><img src="../css/images/entradas.png" width="90%"></button>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn" onclick="salidas()"><img src="../css/images/salidas.png" width="90%"></button>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn"><img src="../css/images/retorno.png" width="90%"></button>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn" onclick="consultas()"><img src="../css/images/consultas.png" width="90%"></button>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn" onclick="inventarios()"><img src="../css/images/inventario.png" width="90%"></button>
            </div>

            <div class="col-12 col-sm-12 col-md-5 col-lg-5 p-3 m-2 border rounded shadow-lg ">
                <button class="btn" onclick=""><img src="../css/images/descargas.png" width="90%"></button>
            </div>

        </div>
    </div>
    <footer class="footer fixed-bottom my-auto color-fondo d-none d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>