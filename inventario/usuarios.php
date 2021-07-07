<?php
session_start();
if (isset($_SESSION['sesion'])) {
    if ($_SESSION['sesion'] != 2) {
        echo "<script>window.location.href = '../inventario/login';</script>";
    } else {
        $usuario = $_SESSION['nombre'];
    }
} else {
    echo "<script>window.location.href = '../inventario/login';</script>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Usuario InvOL</title>
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

        #fondoUsuarios {
            background-image: url('../css/images/fondoUsuario.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
        }

        @media screen and (max-width: 1000px) {
            #fondoUsuarios {
                background-image: none;
            }
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

                <div class="btn-group col-12 col-md-4 col-lg-4 text-center ">
                    <button class="btn " onclick="">
                        <h5 class="my-auto menu">Configuración</h5>
                    </button>
                </div>

                <div class="btn-group col-12 col-md-4 col-lg-4 text-center">
                    <button class="btn" onclick="cerrar()">
                        <h5 class="my-auto menu">Cerrar Sesión</h5>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-4 mt-2">
                <h5 class="my-auto text-center text-white">Bienvenid@ <?php echo $usuario ?></h5>
            </div>
        </nav>
    </div>

    <div id="fondoUsuarios"  class="container-fluid">

        <div class="row text-center justify-content-end">
            <div class="col-12 col-lg-8 col-lg-6 mb-2 mt-2 rounded-lg text-center pb-4">
                
                <div class="col-12 col-lg-7 p-3 m-2 border rounded shadow-lg mx-auto">
                    <button class="btn" onclick="consultas()"><img src="../css/images/consultas.png" width="90%"></button>
                </div>
                <div class="col-12 col-lg-7 p-3 m-2 border rounded shadow-lg mx-auto">
                    <button class="btn" onclick="inventarios()"><img src="../css/images/inventario.png" width="90%"></button>
                </div>
                <div class="col-12 col-lg-7 p-3 m-2 border rounded shadow-lg mx-auto">
                    <button class="btn" onclick=""><img src="../css/images/descargas.png" width="90%"></button>
                </div>
            </div>



        </div>
    </div>
    <footer class="footer fixed-bottom my-auto color-fondo d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>