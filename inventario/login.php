<?php
session_start();
$validaLogin = false;
$isesion = false;

if (isset($_COOKIE["sesionIniciada"])) {
    $isesion = true;
} else if (isset($_COOKIE["nologin"])) {
    $validaLogin = true;
} else {
    unset($_SESSION['nombre']);
}
?>

<!DOCTYPE HTML>
<html lang="es">

<head>
    <title>InvOL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/block.js"></script>
    <script src="../js/all.js"></script>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="shortcut icon" href="../css/images/caja.png" />
    <noscript>
        <link rel="stylesheet" href="../css/noscript.css" />
    </noscript>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <?php if ($validaLogin === true) : ?>
        <script>
            $(document).ready(function() {
                $('#Modalvalida').modal('toggle')
            });
        </script>
    <?php endif; ?>

    <?php if ($isesion === true) : ?>
        <script>
            $(document).ready(function() {
                $('#iniSesion').modal('toggle')
            });
        </script>
    <?php endif; ?>
</head>

<body class="fuente">

    <div class="modal fade shadow" id="iniSesion">
        <div class="modal-dialog modal-lg rounded-lg modal-dialog-centered">
            <div class="modal-content transparencia">

                <div class="modal-header">
                    <img class="my-auto pr-1" src="../css/images/invol.png" alt="" width="20%">
                    <h2 class="container-fluid my-auto text-white pl-2 rounded-lg p-2 bg-warning">Sesíon Iniciada</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body text-center bg-white transparencia">
                    <h5 class="p-3">Tiene una sesión iniciada en otra pestaña, por favor cierre esa sesión y vuelva a intentarlo.</h5>
                </div>

                <div class="modal-footer">
                    <button id="color-boton" type="button" class="btn float-right text-white" data-dismiss="modal">Aceptar</button>
                    <button id="color-boton" type="button" class="btn float-right text-white" onclick="cerrar()">Cerrar Sesion</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade shadow" id="Modalvalida">
        <div class="modal-dialog modal-lg rounded-lg modal-dialog-centered">
            <div class="modal-content transparencia">
                <div class="modal-header">
                    <img class="my-auto pr-1" src="../css/images/invol.png" alt="" width="20%">
                    <h2 class="container-fluid my-auto text-white ml-2 pl-2 rounded-lg p-2 bg-danger">Falla Ingreso</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center ">
                    <h5 class="p-3 text-dark font-weight-bold">Usuario o contraseña incorrectos, verifica la información y vuelve a intentarlo.</h5>
                </div>
                <div class="modal-footer">
                    <button id="color-boton" type="button" class="btn float-right text-white" data-dismiss="modal">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <div id="bg"></div>
        <div id="main">
            <header id="header">
                <img src="../css/images/invol.png" alt="" width="300"><br>
                <form id="signup-form" method="post" action="../controlador/validaLogin" class="row needs-validation pt-4" novalidate>
                    <div class="col-12 col-lg-4"></div>
                    <div class="input-group form-group col-12 col-lg-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white mx-auto"></i></span>
                        </div>
                        <input type="text" class="form-control rounded-right border-0 bg-white" placeholder="Usuario" name="uname" required>
                        <div class="invalid-feedback bg-danger text-white text-center rounded-lg">Por favor, ingrese un usuario.</div>
                    </div>
                    <div class="col-12 col-lg-4"></div>
                    <div class="col-12 col-lg-4"></div>
                    <div class="input-group form-group col-12 col-lg-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white mx-auto"></i></span>
                        </div>
                        <input type="password" class="form-control rounded-right-0 border-0 bg-white" placeholder="Contraseña" name="pswd" id="pswd" required>
                        <div class="input-group-append border-left-0">
                            <spam class="input-group-text bg-white border-0 rounded-right"><i class="far fa-eye-slash" onclick="ver(); setTimeout(nover, 1000)"></i></spam>
                        </div>
                        <div class="invalid-feedback bg-danger text-white text-center rounded-lg">Por favor, ingrese una contraseña.</div>
                    </div>
                    <div class="col-12 col-lg-4"></div>
                    <div class="col-12 col-lg-4"></div>
                    <div class="col-12 col-lg-4 mt-3">
                        <input type="submit" style="font-size:20px" value="Ingresar" class="btn text-white my-auto rounded" id="color-boton">
                    </div>
                    <div class="col-12 col-lg-4"></div>
                </form>
            </header>
        </div>
    </div>
</body>

</html>