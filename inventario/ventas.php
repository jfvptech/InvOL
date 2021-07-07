<?php

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Ventas</title>
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
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body class="body-login">

    <div class="position-sticky">
        <div class="row m-1">
            <div class="col-3 col-md-2 col-lg-1 bg-white p-1">
                <img src="../css/images/invol.png" alt="" width="100%">
            </div>

            <div class="col-9  col-md-10 col-lg-11 my-auto">
                <h5 class="my-auto text-right text-primary">Bienvenid@ Julian</h5>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark color-fondo">
            <div class="col-3 col-md-1 col-lg-1">

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>

        </nav>
    </div>

    <div id="demo" class="carousel slide m-2 " data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../css/images/morpho.png" alt="Los Angeles" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="../css/images/camara.png" alt="Chicago" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="../css/images/escaner.png" alt="New York" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="../css/images/wacom.png" alt="New York" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="../css/images/wacom.png" alt="New York" width="1100" height="500">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next " href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <footer class="footer color-fondo p-2">
        <h6 class="text-center text-white my-auto">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>