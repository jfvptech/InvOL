<?php
require_once("../modelo/servicios.php");
$centro = "";
$serialCentro = false;
$NOserialCentro = false;
$centroAsignado = '';
$validaInfo = false;
if (isset($_SESSION['sesion'])) {
    if ($_SESSION['sesion'] != 1 && $_SESSION['sesion'] != 2) {
        echo "<script>window.location.href = '../inventario/login';</script>";
    } else {
        $sesion=$_SESSION['sesion'];
        if (isset($_SESSION['serialCentro'])) {
            if ($_SESSION['serialCentro'] != "NO") {
                $serialCentro = true;
                $centroAsignado = $_SESSION['serialCentro'];
                $serialBusqueda = $_SESSION['serialBusqueda'];
                $modelo = $_SESSION['modelo'];
                $tipo = $_SESSION['tipo'];
            } else {
                $NOserialCentro = true;
                $serialBusqueda = $_SESSION['serialBusqueda'];
            }
            unset($_SESSION['serialCentro']);
            unset($_SESSION['serialBusqueda']);
            unset($_SESSION['tipo']);
            unset($_SESSION['modelo']);
        }

        $tipo_actividad = '';
        $usuario = $_SESSION['nombre'];
        if (isset($_SESSION['centro'])) {
            $centro = $_SESSION['centro'];
            unset($_SESSION['centro']);
        }

        if (isset($_SESSION['longitud'])) {
            $validaInfo = true;
            unset($_SESSION['longitud']);
            if (isset($_SESSION['biometrico'])) {
                $num1 = count($_SESSION['biometrico']);
                for ($i = 0; $i < $num1; $i++) {
                    $biometrico[$i] = $_SESSION['biometrico'][$i];
                    $marca[$i] = $_SESSION['marca'][$i];
                }
                unset($_SESSION['biometrico']);
            }

            if (isset($_SESSION['escaner'])) {
                $num2 = count($_SESSION['escaner']);
                for ($i = 0; $i < $num2; $i++) {
                    $escaner[$i] = $_SESSION['escaner'][$i];
                    $marca1[$i] = $_SESSION['marca1'][$i];
                }
                unset($_SESSION['escaner']);
            }

            if (isset($_SESSION['pad'])) {
                $num3 = count($_SESSION['pad']);
                for ($i = 0; $i < $num3; $i++) {
                    $pad[$i] = $_SESSION['pad'][$i];
                    $marca2[$i] = $_SESSION['marca2'][$i];
                }
                unset($_SESSION['pad']);
            }

            if (isset($_SESSION['camara'])) {
                $num4 = count($_SESSION['camara']);
                for ($i = 0; $i < $num4; $i++) {
                    $camara[$i] = $_SESSION['camara'][$i];
                    $marca3[$i] = $_SESSION['marca3'][$i];
                }
                unset($_SESSION['camara']);
            }

            if (isset($_SESSION['celular'])) {
                $num4 = count($_SESSION['celular']);
                for ($i = 0; $i < $num4; $i++) {
                    $celular[$i] = $_SESSION['celular'][$i];
                    $marca4[$i] = $_SESSION['marca4'][$i];
                }
                unset($_SESSION['celular']);
            }
        }

        $inicia = new Servicios();

        $array = $inicia->obtieneCentros();
        $x = 0;
        while ($fila = mysqli_fetch_array($array)) {
            $datosCentros[$x] = $fila['USUARIO_A_CARGO'];
            $x++;
        }
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

    <?php if ($validaInfo === true) : ?>
        <script>
            document.getElementById("consultas").style.display = 'block';
        </script>
    <?php endif; ?>

    <?php if ($validaInfo === false) : ?>
        <script>
            $(document).ready(function() {
                document.getElementById("consultas").style.display = 'none';
            });
        </script>
    <?php endif; ?>

    <?php if ($serialCentro === true) : ?>
        <script>
            $(document).ready(function() {
                $('#serialCentro').modal('toggle')
            });
        </script>
    <?php endif; ?>

    <?php if ($NOserialCentro === true) : ?>
        <script>
            $(document).ready(function() {
                $('#NOserialCentro').modal('toggle')
            });
        </script>
    <?php endif; ?>
</head>

<body class="body">

    <div class="modal fade shadow" id="serialCentro">
        <div class="modal-dialog modal-lg rounded-lg modal-dialog-centered">
            <div class="modal-content transparencia">

                <div class="modal-header">
                    <img class="my-auto pr-2" src="../css/images/invol.png" alt="" width="20%">
                    <h2 class="container-fluid my-auto text-white pl-2 rounded-lg p-2" id="color-modal">Consulta Seriales</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body text-center bg-white">
                    <h5 class="p-3">El serial o placa <?php echo $serialBusqueda ?> se encuentra asignado a <br><strong><?php echo $centroAsignado ?></strong><br><?php echo $tipo . " " . $modelo ?></h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn float-right text-white" data-dismiss="modal" id="color-boton">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade shadow" id="NOserialCentro">
        <div class="modal-dialog modal-lg rounded-lg modal-dialog-centered">
            <div class="modal-content transparencia">

                <div class="modal-header">
                    <img class="my-auto pr-2" src="../css/images/invol.png" alt="" width="20%">
                    <h2 class="container-fluid my-auto text-white pl-2 rounded-lg p-2 bg-warning">Consulta Seriales</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body text-center bg-white">
                    <h5 class="p-3">El serial o placa <?php echo $serialBusqueda ?> no se encuentra en el inventario de los centros, por favor verifica el serial.</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn float-right" data-dismiss="modal" id="color-boton">Aceptar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid position-sticky color-fondo">
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-white p-3 text-center shadow">
                <h6 class="text-dark my-auto">En esta área podrás consultar los dispositivos que se encuentran asignados actualmente a los diferentes centros.</h6>
            </div>
            <form method="POST" action="../controlador/obtieneDatosCentros" class="col-12 col-lg-7 needs-validation" name="formulario" id="myform" novalidate>
                <div class="row">
                    <div class="col-12 mt-4">
                        <h5 class="text-dark">Consulta por centro</h5>
                    </div>
                    <div class="col-lg-9 mt-2 ">
                        <select class="form-control shadow-lg" id="centros" name="centros" style="width: 100%" required>
                            <option value=""></option>
                            <?php
                            for ($i = 0; $i < count($datosCentros); $i++) {
                                echo '<option value="' . $datosCentros[$i] . '">' . $datosCentros[$i] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Por favor complete los campos.</div>
                    </div>
                    <div class="col-lg-3 mt-2">
                        <input class="btn text-white shadow" type="submit" value="Consultar" id="color-boton">
                    </div>
                </div>
            </form>

            <form method="POST" action="../controlador/busquedaSerial" class="col-12 col-lg-5 needs-validation" name="formulario2" id="myform2" autocomplete="off" novalidate>
                <div class="row">
                    <div class="col-12 mt-4">
                        <h5 class="text-dark">Consulta por serial o placa</h5>
                    </div>
                    <div class="col-lg-9 mt-2 ">
                        <input class="form-control border border-secondary" type="text" id="seriales" name="seriales" required>
                        <div class="invalid-feedback">Por favor complete los campos.</div>
                    </div>
                    <div class="col-lg-3 mt-2">
                        <input class="btn text-white" type="submit" value="Consultar" id="color-boton">
                    </div>
                </div>
            </form>
        </div>

        <div class="row mt-4 ml-2 mr-2 mb-5 justify-content-center border border-primary rounded-lg bg-white transparencia pb-2" id="consultas">
            <div class="col-12 m-3 text-center">
                <h5 class="font-weight-bold"><?php echo $centro ?> </h5>
                <hr>
            </div>
            <div class="col-12 col-md-6 col-lg-2 shadow">
                <?php
                if (isset($biometrico)) {
                    $cantidad = count($biometrico);
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Biometrico $cantidad unds</h5><hr>";
                    for ($i = 0; $i < $cantidad; $i++) {
                        echo "<h5 class='text-dark text-center'>" . $marca[$i] . " " . $biometrico[$i] . "</h5><br>";
                    }
                } else {
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Biometrico</h5><hr>";
                }
                ?>
            </div>

            <div class="col-12 col-md-6 col-lg-2 shadow">
                <?php
                if (isset($escaner)) {
                    $cantidad = count($escaner);
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Escaner $cantidad unds</h5><hr>";
                    for ($i = 0; $i < $cantidad; $i++) {
                        echo "<h5 class='text-dark text-center'>" . $marca1[$i] . " " . $escaner[$i] . "</h5><br>";
                    }
                } else {
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Escaner</h5><hr>";
                }
                ?>
            </div>

            <div class="col-12 col-md-6 col-lg-2 shadow">
                <?php
                if (isset($pad)) {
                    $cantidad = count($pad);
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Pad $cantidad unds</h5><hr>";
                    for ($i = 0; $i < $cantidad; $i++) {
                        echo "<h5 class='text-dark text-center'>" . $marca2[$i] . " " . $pad[$i] . "</h5><br>";
                    }
                } else {
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Pad</h5><hr>";
                }
                ?>
            </div>

            <div class="col-12 col-md-6 col-lg-2 shadow">
                <?php
                if (isset($camara)) {
                    $cantidad = count($camara);
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Camara $cantidad unds</h5><hr>";
                    for ($i = 0; $i < $cantidad; $i++) {
                        echo "<h5 class='text-dark text-center'>" . $marca3[$i] . " " . $camara[$i] . "</h5><br>";
                    }
                } else {
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Camara</h5><hr>";
                }
                ?>
            </div>

            <div class="col-12 col-md-6 col-lg-3 shadow">
                <?php
                if (isset($celular)) {
                    $cantidad = count($celular);
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Celular $cantidad unds</h5><hr>";
                    for ($i = 0; $i < $cantidad; $i++) {
                        echo "<h5 class='text-dark text-center'>" . $marca4[$i] . " " .  $celular[$i] . "</h5><br>";
                    }
                } else {
                    echo "<h5 class='text-dark text-center font-weight-bold rounded-lg shadow' id='color-unds'>Celular</h5><hr>";
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="footer fixed-bottom my-auto color-fondo  d-none d-lg-block ">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>