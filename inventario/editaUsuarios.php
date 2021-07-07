<?php
include_once("../modelo/servicios.php");
error_reporting(0);
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

    $inicia = new Servicios();

    $array = $inicia->obtieneUsuarios();
    $i = 0;
    while ($fila = mysqli_fetch_array($array)) {
        $usuarios[$i] = $fila['nombre'];
        $rol[$i] = $fila['rol'];
        $i++;
    }
} else {
    echo "<script>window.location.href = '../inventario/login';</script>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Usuarios InvOL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/select2.css" rel="stylesheet" />
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/block.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/all.js"></script>
    <link rel="shortcut icon" href="../css/images/caja.png" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>
        img:hover {
            opacity: 0.5 !important;
            filter: alpha(opacity=70) !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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
                <div class="btn-group col-12 col-md-5 col-lg-5 text-center">
                    <button class="btn" onclick="cerrar()">
                        <h5 class="my-auto menu">Cerrar Sesión</h5>
                    </button>
                </div>
                <div class="btn-group col-12 col-md-3 col-lg-3 text-center">
                    <button class="btn" onclick="regresar()">
                        <h5 class="my-auto menu">Regresar</h5>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-4 mt-2">
                <h5 class="my-auto text-center text-white">Bienvenid@ <?php echo $usuario ?></h5>
            </div>
        </nav>
    </div>

    <div class="mt-lg-2 mt-3">

        <div class="row text-center justify-content-around m-1">

            <div class="col-12 col-md-6 col-lg-6 transparencia rounded-lg shadow m-1" style="overflow-y: scroll; height:400px">
                <h5 class="font-weight-bold my-auto p-2"><?php echo count($usuarios)?> Usuarios</h5>

                <table class="table table-hover table-bordered">
                    <thead class="color-fondo text-white shadow">
                        <tr class="shadow">
                            <th scope="col">Usuario</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($usuarios); $i++) {
                            echo '<tr><td>' . $usuarios[$i] . '</td>
                                <td>' . $rol[$i] . '</td>
                                <td>
                                    <div class="btn-group">
                                        <h2 class="btnEditar text-success my-auto mr-1 mensaje" data-toggle="tooltip" data-placement="bottom" title="Editar – Actualizar"><i class="far fa-edit" style="background-color: #ffffff00;"></i></h2>
                                        <h2 class="btnEliminar text-danger my-auto ml-1 mensaje" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="far fa-trash-alt" style="background-color: #ffffff00;"></i></h2>
                                    </div>
                                </td></tr>';
                        }

                        ?>
                    </tbody>
                </table>

            </div>

            <div class="col-12 col-md-5 col-lg-5 transparencia rounded-lg shadow m-1">
                <h5 class="font-weight-bold my-auto p-2">Nuevo Usuario</h5>


            </div>

        </div>
    </div>
    <footer class="footer fixed-bottom my-auto color-fondo d-none d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>