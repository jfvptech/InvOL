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
            document.getElementById("cambio").style.display = 'none';
            $('#radio1').change(function() {
                var check = $(this).val();
                if (check == "option1") {
                    document.getElementById("radio2").checked = false;
                    document.getElementById("cambio").style.display = 'none';
                    document.getElementById("nuevo").style.display = 'block';
                }
            });

            $('#radio2').change(function() {
                var check2 = $(this).val();
                if (check2 == "option2") {
                    document.getElementById("radio1").checked = false;
                    document.getElementById("cambio").style.display = 'block';
                }
            });
        });

        $(document).ready(function() {
            document.getElementById("masivo").style.display = 'none';
            $('#radio3').change(function() {
                var check = $(this).val();
                if (check == "option3") {
                    document.getElementById("radio4").checked = false;
                    document.getElementById("selecSerial").style.display = 'block';
                    document.getElementById("masivo").style.display = 'none';
                }
            });

            $('#radio4').change(function() {
                var check2 = $(this).val();
                if (check2 == "option4") {
                    document.getElementById("radio3").checked = false;
                    document.getElementById("masivo").style.display = 'block';
                    document.getElementById("selecSerial").style.display = 'none';
                }
            });
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
                <h6 class="text-dark my-auto">En esta área podrás asignar nuevos dispositivos al los centros masivo o individual</h6>
            </div>
            <form method="POST" action="#" class="needs-validation col-12 col-lg-5 transparencia m-4 p-3 shadow rounded-lg" novalidate>
                <h4 for="cargue" class="text-center pt-1">Asignación individual</h4>
                <div class="row ">

                    <div class="col-12 mt-1 text-center">
                        <label for="centros">Selecciona el centro de destino</label>
                        <select class="form-control shadow" id="centros" name="centros" style="width: 100%" required>
                            <option value=""></option>
                            <?php
                            for ($i = 0; $i < count($datosCentros); $i++) {
                                echo '<option value="' . $datosCentros[$i] . '">' . $datosCentros[$i] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

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

                    <div class="col-12 col-lg-5 mt-3">
                        <label for="modelo">Selecciona un modelo</label>
                        <select class="form-control shadow" id="modelo1" name="modelo" required>
                            <?php
                            echo "<option value=" . $modelo . ">" . $modelo . "</option>";
                            ?>
                        </select>
                    </div>

                    <div class="col-12 col-lg-7 mt-3">
                        <label>Selecciona una opcion</label>
                        <div class="bg-white rounded shadow p-1 text-center">
                            <div class="form-check-inline pt-1">
                                <label class="form-check-label" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="optradio1" value="option1" checked>Solo Envío
                                </label>
                            </div>
                            <div class="form-check-inline pt-1">
                                <label class="form-check-label" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="optradio2" value="option2">Con Retorno
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="nuevo" class="col-12 col-lg-6 mt-3">
                        <label for="seriales">Selecciona un serial nuevo</label>
                        <select class="form-control" id="seriales" name="seriales" style="width: 100%" required>
                            <?php
                            echo "<option value=" . $modelo . ">" . $modelo . "</option>";
                            ?>
                        </select>
                    </div>

                    <div id="cambio" class="col-12 col-lg-6 mt-3">
                        <label for="seriales">Digita el serial antiguo</label>
                        <?php
                        if ($modelo == "Morpho E3") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[0-9]{4}[A-Z][0-9]{6}' autocomplete='off' required>";
                        } else if ($modelo == "Futronic") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[F]{1}[P]{1}[0-9]{6}' autocomplete='off' required>";
                        } else if ($modelo == "DS-640") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[U]{1}[0-9]{5}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{6}' autocomplete='off' required>";
                        } else if ($modelo == "C920s") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[0-9]{4}[A-Z]{2}[0-9]{6}' autocomplete='off' required>";
                        } else if ($modelo == "STU-530") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[0-9]{1}[A-Z]{2}[0-9]{10}' autocomplete='off' required>";
                        } else if ($modelo == "EpadLink") {
                            echo "<input class='form-control type='text' id='seriales' name='serial' pattern='[0-9]{13}[A0-Z9]{3}' autocomplete='off' required>";
                        } else {
                            echo "<input class='form-control type='text'>";
                        }
                        ?>
                    </div>

                    <div class="col-12 col-lg-4 mt-3 align-self-end mx-auto">
                        <button type="submit" class="btn btn-block text-white bg-success shadow rounded-lg" id="color-boton">
                            <h5 class="my-auto">Asignar</h5>
                        </button>
                    </div>
                </div>
            </form>
            <form method="POST" action="../modelo/cargaExcel" class="needs-validation col-12 col-lg-5 transparencia m-4 p-3 shadow rounded-lg" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" novalidate>
                <h4 class="text-center ">Asignación masiva</h4>
                <h6 class="text-center pt-2">Selecciona la operación que deseas realizar</h6>
                <div class="text-center m-1 p-2 bg-white rounded-lg shadow row justify-content-around">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio3">
                            <input type="radio" class="form-check-input" id="radio3" name="optradio3" value="option3" checked>Asignar seriales
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio4">
                            <input type="radio" class="form-check-input" id="radio4" name="optradio4" value="option4">Asignar Masivo
                        </label>
                    </div>
                </div>

                <div id="masivo">
                    <h6 class="text-center pt-4 pb-2">Descarga <a href="javascript:cargue();"><strong class='text-danger'>aquí</strong></a> el formato de asignación masiva</h6>
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
                </div>

                <div id="selecSerial">
                    <div class="row">

                        <div class="col-12 mt-1 text-center">
                            <label for="centros2">Selecciona el centro de destino</label>
                            <select class="form-control shadow" id="centros2" name="centros2" style="width: 100%" required>
                                <option value=""></option>
                                <?php
                                for ($i = 0; $i < count($datosCentros); $i++) {
                                    echo '<option value="' . $datosCentros[$i] . '">' . $datosCentros[$i] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

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

                        <div class="col-12 col-lg-6 mt-3">
                            <label for="modelo">Selecciona un modelo</label>
                            <select class="form-control shadow" id="modelo1" name="modelo" required>
                                <?php
                                echo "<option value=" . $modelo . ">" . $modelo . "</option>";
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mt-3">
                            <label for="cantidad">Selecciona la cantidad</label>
                            <input class="form-control" type="text" id="cantidad" name="cantidad" autocomplete='off' required>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5 col-12 col-lg-4 mx-auto ">
                    <button type="submit" class="btn btn-block text-white bg-success shadow rounded-lg" name="import" id="color-boton">
                        <h5 class="my-auto">Asignar</h5>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer fixed-bottom my-auto color-fondo d-none d-md-block">
        <h6 class="text-center text-white pt-2">Copyright © <?php echo date('Y') ?> - Olimpia IT Logistics & Maintenance</h6>
    </footer>
</body>

</html>