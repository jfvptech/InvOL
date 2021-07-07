<?php
require_once("../modelo/servicios.php");

if (isset($_POST['centros']) && !empty($_POST['centros'])) {

    $centros = $_POST['centros'];
    $inicia = new Servicios();
    $inicia->obtieneDatosCentros($centros);
}
?>