<?php
require_once("../modelo/servicios.php");

if (isset($_POST['seriales']) && !empty($_POST['seriales'])) {

    $serial = $_POST['seriales'];
    $inicia = new Servicios();
    $inicia->consultaSerial($serial);
}
?>