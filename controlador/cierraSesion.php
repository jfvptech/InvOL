<?php
session_start();
unset($_SESSION['nombre']);
unset($_SESSION['sesion']);
unset($_SESSION['conteoIndividual']);
unset($_SESSION['conteoNO']);
session_destroy();
echo "<script>window.location.href = '../index';</script>>";
?>