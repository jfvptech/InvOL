<?php
require_once("../modelo/servicios.php");
if (isset($_POST["serial"])) {
        $serial=$_POST["serial"];
        if(!isset($_SESSION['conteoIndividual'])){
            $_SESSION['conteoIndividual'] = 0;
        }
        $inicia=new Servicios();
        $inicia->cargaIndividual($serial);
}else {
    echo "<script>window.location.href = '../inventario/entradas';</script>";
}
