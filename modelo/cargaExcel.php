<?php
require_once("../modelo/servicios.php");
require_once('../vendor/php-excel-reader/excel_reader2.php');
require_once('../vendor/SpreadsheetReader.php');
error_reporting(0);
if (isset($_POST["import"])) {

    $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

         $targetPath = 'subidas/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);
        $inicia=new Servicios();
        $inicia->cargaExcel($Reader);
    }else{
        echo "<script>window.location.href = '../inventario/entradas';</script>";
    }
}else{
    echo "<script>window.location.href = '../inventario/entradas';</script>";
}
?>