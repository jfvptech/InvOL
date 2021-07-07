<?php
require_once("../modelo/servicios.php");
error_reporting(0);
$conteoNO = "";
$numCargue = "";
$conteoIndividual = "";
if (isset($_SESSION['sesion'])) {
    if ($_SESSION['sesion'] != 1) {
        echo "<script>window.location.href = '../inventario/login';</script>";
    } else {
        $usuario = $_SESSION['nombre'];

        if (isset($_SESSION['numCargue'])) {
            $numCargue = $_SESSION['numCargue'];
        }
        unset($_SESSION['numCargue']);

        if (isset($_SESSION['dispositivo'])) {
            $dispositivo = $_SESSION['dispositivo'];
            $marca = $_SESSION['marca'];
            $modelo = $_SESSION['modelo'];
            $estadoBoton = $_SESSION['estadoBoton'];

            if (isset($_SESSION['conteoNO'])) {
                $conteoNO = $_SESSION['conteoNO'];
            }
            unset($_SESSION['conteoNO']);

            if (isset($_SESSION['conteoIndividual'])) {
                $conteoIndividual = $_SESSION['conteoIndividual'];
            }

            if ($estadoBoton == "Establecer") {
                $dispositivo = "";
                $marca = "";
                $modelo = "";
                $bloqueaBoton2 ="disabled";
                unset($_SESSION['conteoIndividual']);
                unset($_SESSION['conteoNO']);
                $conteoIndividual = '';
            }
        } else {
            $dispositivo = '';
            $marca = '';
            $modelo = '';
            $estadoBoton = "Establecer";
            $bloqueaBoton2 ="";
            unset($_SESSION['conteoNO']);
            unset($_SESSION['conteoIndividual']);
            $conteoIndividual = '';
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

        .custom-input-file {
            background-color: #faf8fa;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            margin: 0 auto 0;
            min-height: 60px;
            overflow: hidden;
            padding: 0px;
            position: relative;
            text-align: center;
            width: 100%;
        }

        .custom-input-file .input-file {
            border: 10000px solid transparent;
            cursor: pointer;
            font-size: 10000px;
            margin: 0;
            opacity: 0;
            outline: 0 none;
            padding: 0;
            position: absolute;
            right: -1000px;
            top: -1000px;
        }
    </style>

    <script>
        $(document).ready(function() {
            document.getElementById('marca1').style.display = 'block';
            document.getElementById('marca2').style.display = 'none';
            document.getElementById('marca3').style.display = 'none';
            document.getElementById('marca4').style.display = 'none';
            document.getElementById('modelo1').style.display = 'block';
            document.getElementById('modelo1-2').style.display = 'none';
            document.getElementById('modelo2').style.display = 'none';
            document.getElementById('modelo3').style.display = 'none';
            document.getElementById('modelo4').style.display = 'none';
        });

        $(document).ready(function() {
            $('#dispositivo').change(function() {
                var seleccion = $(this).val();
                if (seleccion == "Escaner") {
                    document.getElementById('marca2').style.display = 'block';
                    document.getElementById('modelo4').style.display = 'block';
                    document.getElementById('marca1').style.display = 'none';
                    document.getElementById('modelo1').style.display = 'none';
                    document.getElementById('modelo1-2').style.display = 'none';
                    document.getElementById('marca3').style.display = 'none';
                    document.getElementById('modelo2').style.display = 'none';
                    document.getElementById('marca4').style.display = 'none';
                    document.getElementById('modelo3').style.display = 'none';
                } else if (seleccion == "Camara") {
                    document.getElementById('marca2').style.display = 'none';
                    document.getElementById('modelo4').style.display = 'none';
                    document.getElementById('marca1').style.display = 'none';
                    document.getElementById('modelo1').style.display = 'none';
                    document.getElementById('modelo1-2').style.display = 'none';
                    document.getElementById('marca3').style.display = 'block';
                    document.getElementById('modelo2').style.display = 'block';
                    document.getElementById('marca4').style.display = 'none';
                    document.getElementById('modelo3').style.display = 'none';
                } else if (seleccion == "Pad de firmas") {
                    document.getElementById('marca2').style.display = 'none';
                    document.getElementById('modelo4').style.display = 'none';
                    document.getElementById('marca1').style.display = 'none';
                    document.getElementById('modelo1').style.display = 'none';
                    document.getElementById('modelo1-2').style.display = 'none';
                    document.getElementById('marca3').style.display = 'none';
                    document.getElementById('modelo2').style.display = 'none';
                    document.getElementById('marca4').style.display = 'block';
                    document.getElementById('modelo3').style.display = 'block';
                } else if (seleccion == "Biometrico") {
                    document.getElementById('marca2').style.display = 'none';
                    document.getElementById('modelo4').style.display = 'none';
                    document.getElementById('marca1').style.display = 'block';
                    document.getElementById('modelo1').style.display = 'block';
                    document.getElementById('marca3').style.display = 'none';
                    document.getElementById('modelo2').style.display = 'none';
                    document.getElementById('marca4').style.display = 'none';
                    document.getElementById('modelo3').style.display = 'none';
                    document.getElementById("modelo1-2").value = '';
                    document.getElementById("modelo1").value = '';
                    document.getElementById("marca1").value = '';
                }
            });
        });

        $(document).ready(function() {
            $('#dispositivo').change(function() {
                var seleccion = $(this).val();
                var marcaBiometricos = ['', 'Idemia', 'Futronic'];
                var marcaCamaras = ['', 'Logitech'];
                var marcaEscaner = ['', 'Brother'];
                var marcaPad = ['', 'Wacom', 'EpadLink'];

                var selecciones = document.getElementById("marca1");

                var opciones = "";
                if (seleccion == "Biométrico") {
                    document.getElementById('marca1').innerHTML = "";
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < marcaBiometricos.length; i++) {
                        opciones = new Option(marcaBiometricos[i], marcaBiometricos[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Escáner") {
                    document.getElementById('marca1').innerHTML = "";
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < marcaEscaner.length; i++) {
                        opciones = new Option(marcaEscaner[i], marcaEscaner[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Cámara") {
                    document.getElementById('marca1').innerHTML = "";
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < marcaCamaras.length; i++) {
                        opciones = new Option(marcaCamaras[i], marcaCamaras[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Pad") {
                    document.getElementById('marca1').innerHTML = "";
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < marcaPad.length; i++) {
                        opciones = new Option(marcaPad[i], marcaPad[i]);
                        selecciones.options.add(opciones);
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#marca1').change(function() {
                var seleccion = $(this).val();

                var modeloBiometricos = ['', 'Morpho E3', 'MSO 301'];
                var modeloBiometricos2 = ['', 'Futronic'];
                var modeloCamaras = ['', 'C920s'];
                var modeloEscaner = ['', 'DS-640'];
                var modeloPad = ['', 'STU-530'];
                var modeloPad2 = ['', 'EpadLink'];

                var selecciones = document.getElementById("modelo1");

                var opciones = "";
                if (seleccion == "Idemia") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloBiometricos.length; i++) {
                        opciones = new Option(modeloBiometricos[i], modeloBiometricos[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Futronic") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloBiometricos2.length; i++) {
                        opciones = new Option(modeloBiometricos2[i], modeloBiometricos2[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Logitech") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloCamaras.length; i++) {
                        opciones = new Option(modeloCamaras[i], modeloCamaras[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Brother") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloEscaner.length; i++) {
                        opciones = new Option(modeloEscaner[i], modeloEscaner[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "Wacom") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloPad.length; i++) {
                        opciones = new Option(modeloPad[i], modeloPad[i]);
                        selecciones.options.add(opciones);
                    }
                } else if (seleccion == "EpadLink") {
                    document.getElementById('modelo1').innerHTML = "";
                    for (var i = 0; i < modeloPad2.length; i++) {
                        opciones = new Option(modeloPad2[i], modeloPad2[i]);
                        selecciones.options.add(opciones);
                    }
                }
            });
        });

        $(document).ready(function() {
            BloqueaSelecciones('<?php echo $estadoBoton ?>');
        });

        function BloqueaSelecciones(boton) {
            if (boton == "Cambiar") {
                document.getElementById("dispositivo").disabled = true;
                document.getElementById("marca1").disabled = true;
                document.getElementById("modelo1").disabled = true;
            } else {
                document.getElementById("dispositivo").disabled = false;
                document.getElementById("marca1").disabled = false;
                document.getElementById("modelo1").disabled = false;
            }
        }

        $(document).ready(function() {
            $('#info').on('input', ':input', function() {
                var value = $(this).val();
                var name = $(this).prop('name');
                if (value.length == 11) {
                    setTimeout(enter, 500);
                }
            });
        });

        function enter() {
            $('#boton').click();
        }
    </script>
</head>

<body class="body">

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
                <div class="btn-group col-12 col-md-3 col-lg-3 text-center">
                    <button class="btn" onclick="regresar()">
                        <h5 class="my-auto menu">Regresar</h5>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-2 col-lg-4 mt-2">
                <h5 class="my-auto text-center text-white">Bienvenid@ <?php echo $usuario ?></h5>
            </div>
        </nav>
    </div>

    <div class="container-fluid mb-4">
        <div class="row justify-content-center">

            <div class="col-12 bg-white p-3 text-center shadow">
                <h6 class="text-dark my-auto">En esta área podrás ingresar nuevos dispositivos al inventario con cargue masivo o individual</h6>
            </div>

            <form method="POST" action="../modelo/cargaExcel" class="needs-validation col-12 col-lg-5 transparencia m-4 p-3 shadow rounded-lg" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" novalidate>
                <h4 for="cargue" class="text-center ">Cargue masivo</h4>
                <h6 class="text-center p-2">Descarga <a href="javascript:cargue();"><strong class='text-danger'>aquí</strong></a> el formato de cargue masivo </h6>
                <div class="text-center bg-white" style="border: 2px solid #ccc;border-style: dashed;">
                    <div class="col">
                        <div class="row custom-input-file align-items-center pt-4 pb-3 bg-white">
                            <div class="col-3"></div>
                            <div id="color-boton" class="col-6 rounded-lg pt-2">
                                <input id="file" name="file" type="file" class="input-file" accept=".xls,.xlsx" required>
                                <h6 class="text-white">Arrastrar o seleccionar el archivo</h6>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div class="text-center">
                            <h5 id="nombre" name="nombre" value=""></h5>
                        </div>
                    </div>
                </div>
                <div class="text-center m-3 col-12 col-lg-4 mx-auto ">
                    <button type="submit" class="btn btn-block text-white bg-success shadow rounded-lg" name="import" id="color-boton">
                        <h5 class="my-auto">Cargar</h5>
                    </button>
                </div>
            </form>

            <div class="col-12 col-lg-5 transparencia m-4 shadow shadow rounded-lg">

                <form method="POST" action="../controlador/guardaSeleccion">
                    <h4 for="cargue" class="text-center pt-3">Cargue individual</h4>
                    <div class="row justify-content-around">
                        <div class="col-12 col-lg-6 mt-2">
                            <label for="dispositivo">Selecciona un dispositivo</label>
                            <select class="form-control shadow" id="dispositivo" name="dispositivo" required>
                                <?php
                                echo "<option value=" . $dispositivo . ">" . $dispositivo . "</option>";
                                ?>
                                <option value="Biométrico">Biométrico</option>
                                <option value="Escáner">Escáner</option>
                                <option value="Cámara">Cámara</option>
                                <option value="Pad">Pad de firmas</option>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mt-2">
                            <label for="marca">Selecciona la marca</label>
                            <select class="form-control shadow" id="marca1" name="marca" required>
                                <?php
                                echo "<option value=" . $marca . ">" . $marca . "</option>";
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-8 mt-3">
                            <label for="modelo">Selecciona un modelo</label>
                            <select class="form-control shadow" id="modelo1" name="modelo" required>
                                <?php
                                echo "<option value=" . $modelo . ">" . $modelo . "</option>";
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-4 mt-3 align-self-end text-right">
                            <button type="submit" class="btn btn-block shadow rounded-lg text-white" id="color-boton">
                                <h5 class="my-auto"><?php echo $estadoBoton; ?></h5>
                            </button>
                        </div>
                    </div>
                </form>

                <form class="row justify-content-around" method="POST" action="../controlador/cargaIndividual">
                    <div class="col-12 col-lg-8 mt-4 mb-2" id="info">
                        <label for="serial">Ingresa serial</label>
                        <?php
                        if ($modelo == "Morpho E3") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[0-9]{4}[A-Z][0-9]{6}' autofocus autocomplete='off' required>";
                        } else if ($modelo == "Futronic") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[F]{1}[P]{1}[0-9]{6}' autofocus autocomplete='off' required>";
                        } else if ($modelo == "DS-640") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[U]{1}[0-9]{5}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{6}' autofocus autocomplete='off' required>";
                        } else if ($modelo == "C920s") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[0-9]{4}[A-Z]{2}[0-9]{6}' autofocus autocomplete='off' required>";
                        } else if ($modelo == "STU-530") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[0-9]{1}[A-Z]{2}[0-9]{10}' autofocus autocomplete='off' required>";
                        } else if ($modelo == "EpadLink") {
                            echo "<input class='form-control border border-warning' type='text' id='serial' name='serial' pattern='[0-9]{13}[A0-Z9]{3}' autofocus autocomplete='off' required>";
                        } else {
                            echo "<input class='form-control border border-warning' type='text' disabled>";
                        }
                        ?>
                    </div>

                    <div class="col-12 col-lg-4 mt-3 mb-2 align-self-end text-right">
                        <button type="submit" class="btn btn-block text-white bg-success shadow rounded-lg color-boton" id="boton" <?php echo $bloqueaBoton2 ?>>
                            <h5 class="my-auto">Cargar</h5>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mb-2">
        <?php
        if ($numCargue > 0) {
            echo "<div class='alert alert-success alert-dismissible fade show text-center mb-5'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Cargue completo!</strong> Se han registrado <strong class='text-danger'>" . $numCargue . "</strong> unidades, revisar inventario <a href='#'><strong class='text-danger'>aquí</strong></a> 
            </div>";
        } else if ($numCargue == 'NO') {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center mb-5'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Fallo!</strong> No fue posible hacer el cargue, revisa si los seriales ya están cargados en el inventario e inténtalo de nuevo
            </div>";
        } else if ($conteoIndividual > 0 && $conteoNO == "SI") {
            echo "<div class='alert alert-success alert-dismissible fade show text-center mb-5'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            Se han registrado <strong class='text-danger'>" . $conteoIndividual . "</strong> unidades de " . $dispositivo . " " . $modelo . ", revisar inventario <a href='#'> <strong class='text-danger'>aquí</strong></a>
            </div>";
        } else if ($conteoNO == "NO") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center mb-5'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>Fallo!</strong> No fue posible hacer el cargue, revisa si el serial ya está cargado en el inventario e inténtalo de nuevo
            </div>";
        }
        ?>

    </div>

    <div class="modal fade shadow" id="modSpinner" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container-fluid modal-header" id="color-boton">
                    <h4 class="modal-title mx-auto text-white">Cargando, un momento por favor...</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="spinner-grow text-warning"></div>
                    <div class="spinner-grow text-warning"></div>
                    <div class="spinner-grow text-warning"></div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom my-auto color-fondo d-none d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>