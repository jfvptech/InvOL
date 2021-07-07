<?php
require_once("../modelo/servicios.php");

if (isset($_POST['uname']) && !empty($_POST['uname']) && isset($_POST['pswd']) && !empty($_POST['pswd'])) {

    $usuario = $_POST['uname'];
    $psw = $_POST['pswd'];

    $inicia = new Servicios();
    $inicia->ValidaLogin($usuario, $psw);
}
