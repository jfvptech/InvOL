<?php
require_once('../modelo/servicios.php');
if(isset($_POST['dispositivo']) && isset($_POST['marca']) && isset($_POST['modelo'])){
    $_SESSION['dispositivo']=$_POST['dispositivo'];
    $_SESSION['marca']=$_POST['marca'];
    $_SESSION['modelo']=$_POST['modelo'];
    $_SESSION['estadoBoton']="Cambiar";
}else{
    $_SESSION['nodatos']='NO';
    $_SESSION['estadoBoton']="Establecer";
}
echo "<script>window.location.href = '../inventario/entradas';</script>";
?>