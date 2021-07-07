<?php
session_start();
error_reporting(0);
class Servicios
{
    //=========================================================================================================================

    //Conexion a base de datos
    private function conectarBD()
    {
        $server = 'localhost';
        $usuario = 'root';
        $pass = '';
        $BD = 'invol';
        $conexion = mysqli_connect($server, $usuario, $pass, $BD);

        return $conexion;
    }

    //=========================================================================================================================

    //Termina conexion a base de datos
    private function desconectarBD($conexion)
    {
        $close = mysqli_close($conexion);
        return $close;
    }

    //=========================================================================================================================

    //Valida datos de ingreso
    function ValidaLogin($usuario, $psw)
    {
        $usuario = str_replace("'", "", "$usuario");
        $usuario = str_replace("/", "", "$usuario");
        $usuario = str_replace("\\", "", "$usuario");
        $usuario = str_replace("´", "", "$usuario");
        $usuario = str_replace("%", "", "$usuario");
        $usuario = str_replace("$", "", "$usuario");
        $usuario = str_replace("--", "", "$usuario");
        $usuario = str_replace("+", "", "$usuario");
        $usuario = str_replace("=", "", "$usuario");

        $psw = str_replace("'", "", "$psw");
        $psw = str_replace("/", "", "$psw");
        $psw = str_replace("\\", "", "$psw");
        $psw = str_replace("´", "", "$psw");
        $psw = str_replace("%", "", "$psw");
        $psw = str_replace("$", "", "$psw");
        $psw = str_replace("--", "", "$psw");
        $psw = str_replace("+", "", "$psw");
        $psw = str_replace("=", "", "$psw");

        $verificaIni = $this->SesionAbierta();
        if ($verificaIni) {

            $conexion = $this->conectarBD();
            $sql = "SELECT * FROM registro WHERE usuario='{$usuario}' AND contrasena = '{$psw}' LIMIT 1";
            $consulta = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($consulta) > 0) {
                while ($dato = mysqli_fetch_array($consulta)) {
                    $_SESSION['nombre'] = $dato['nombre'];
                    $rol = $dato['rol'];
                }
                if ($rol == "Administrador") {
                    $_SESSION['sesion'] = 1;
                    echo "<script>window.location.href = '../inventario/admin';</script>";
                } else {
                    $_SESSION['sesion'] = 2;
                    echo "<script>window.location.href = '../inventario/usuarios';</script>";
                }
            } else {
                if (!isset($_COOKIE["nologin"])) {
                    setcookie("nologin", "SI", time() + 2, "/");
                }
                echo "<script>window.location.href = '../inventario/login';</script>";
            }
        } else {
            echo "<script>window.location.href = '../inventario/login';</script>";
        }
        $this->desconectarBD($conexion);
    }

    //=========================================================================================================================
    //Aviso de sesion abierta

    function SesionAbierta()
    {
        if (isset($_SESSION['sesion'])) {
            if ($_SESSION['sesion'] == 1 || $_SESSION['sesion'] == 2) {
                if (!isset($_COOKIE["sesionIniciada"])) {
                    setcookie('sesionIniciada', 'SI', time() + 3, "/");
                }
                $verifica = false;
            } else {
                $verifica = true;
            }
        } else {
            $verifica = true;
        }

        return $verifica;
    }

    //=========================================================================================================================

    //Obtiene informacion de centros (Dispositivos)
    function obtieneDatosCentros($centro)
    {
        $conexion = $this->conectarBD();
        $sql = "SELECT * FROM dispositivos WHERE USUARIO_A_CARGO='{$centro}'";
        $consulta = mysqli_query($conexion, $sql);
        $x = 0;
        $y = 0;
        $z = 0;
        $u = 0;
        $v = 0;
        $t = 0;

        if ($consulta) {
            while ($fila = mysqli_fetch_array($consulta)) {
                if ($fila['NOMBRE_CI'] == "Biométrico") {
                    $_SESSION['biometrico'][$x] = $fila['SERIAL'];
                    $_SESSION['marca'][$x] = $fila['MARCA'];
                    $x++;
                } else if ($fila['NOMBRE_CI'] == "Escaner") {
                    $_SESSION['escaner'][$y] = $fila['SERIAL'];
                    $_SESSION['marca1'][$y] = $fila['MARCA'];
                    $y++;
                } else if ($fila['NOMBRE_CI'] == "Pad de firmas") {
                    $_SESSION['pad'][$z] = $fila['SERIAL'];
                    $_SESSION['marca2'][$z] = $fila['MARCA'];
                    $z++;
                } else if ($fila['NOMBRE_CI'] == "Cámara") {
                    $_SESSION['camara'][$u] = $fila['SERIAL'];
                    $_SESSION['marca3'][$u] = $fila['MARCA'];
                    $u++;
                } else if ($fila['NOMBRE_CI'] == "Celular") {
                    $_SESSION['celular'][$v] = $fila['SERIAL'];
                    $_SESSION['marca4'][$v] = $fila['MARCA'];
                    $v++;
                }
                $t++;
            }
            $_SESSION['longitud'] = $t;
            $_SESSION['centro'] = $centro;
        }

        $this->desconectarBD($conexion);
        echo "<script>window.location.href = '../inventario/consultas';</script>";
    }

    //========================================================================================================================= 

    //Obtiene nombres de centros para lista desplegable
    function obtieneCentros()
    {
        $conexion = $this->conectarBD();
        $sql = "SELECT DISTINCT USUARIO_A_CARGO FROM dispositivos ORDER BY USUARIO_A_CARGO ASC";
        $consulta = mysqli_query($conexion, $sql);
        $this->desconectarBD($conexion);
        return $consulta;
    }

    //========================================================================================================================= 

    //Obtiene informacion de dispositivos (con serial)
    function consultaSerial($serial)
    {
        $conexion = $this->conectarBD();
        $sql = "SELECT USUARIO_A_CARGO, MARCA, NOMBRE_CI FROM dispositivos WHERE SERIAL='{$serial}'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($fila = mysqli_fetch_array($consulta)) {
                $_SESSION['serialCentro'] = $fila['USUARIO_A_CARGO'];
                $_SESSION['serialBusqueda'] = $serial;
                $_SESSION['modelo'] = $fila['MARCA'];
                $_SESSION['tipo'] = $fila['NOMBRE_CI'];
            }
        } else {
            $_SESSION['serialCentro'] = "NO";
            $_SESSION['serialBusqueda'] = $serial;
        }
        $this->desconectarBD($conexion);
        echo "<script>window.location.href = '../inventario/consultas';</script>";
    }

    //========================================================================================================================= 

    //Carga masivo con excel
    function cargaExcel($excel)
    {
        $conexion = $this->conectarBD();
        $sheetCount = count($excel->sheets());
        for ($i = 0; $i < $sheetCount; $i++) {

            $excel->ChangeSheet($i);
            $cont = 0;
            $numCargue = 0;
            foreach ($excel as $Row) {
                if ($cont != 0) {
                    $dispositivo = "";
                    if (isset($Row[0])) {
                        $dispositivo = mysqli_real_escape_string($conexion, $Row[0]);
                    }

                    $marca = "";
                    if (isset($Row[1])) {
                        $marca = mysqli_real_escape_string($conexion, $Row[1]);
                    }

                    $modelo = "";
                    if (isset($Row[2])) {
                        $modelo = mysqli_real_escape_string($conexion, $Row[2]);
                    }

                    $serial = "";
                    if (isset($Row[3])) {
                        $serial = mysqli_real_escape_string($conexion, $Row[3]);
                    }

                    if (!empty($dispositivo) || !empty($marca) || !empty($modelo) || !empty($serial)) {
                        $sql = "INSERT INTO inventario_disponibles(dispositivo,marca,modelo,seriales) VALUES('" . $dispositivo . "','" . $marca . "','" . $modelo . "','" . $serial . "')";
                        $resultados = mysqli_query($conexion, $sql);

                        if (!empty($resultados)) {
                            $numCargue++;
                        }
                    }
                } else {
                    $cont++;
                }
            }
        }

        if ($numCargue > 0) {
            $_SESSION['numCargue'] = $numCargue;
        } else {
            $_SESSION['numCargue'] = 'NO';
        }

        $this->desconectarBD($conexion);
        echo "<script>window.location.href = '../inventario/entradas';</script>";
    }

    //=========================================================================================================================

    //Cargue individual manual
    function cargaIndividual($serial)
    {
        $conexion = $this->conectarBD();
        $dispositivo = $_SESSION['dispositivo'];
        $marca = $_SESSION['marca'];
        $modelo = $_SESSION['modelo'];
        $conteo = intval($_SESSION['conteoIndividual']);
        $sql = "INSERT INTO inventario_disponibles(dispositivo,marca,modelo,seriales) VALUES('$dispositivo','$marca','$modelo','$serial')";
        $consulta = mysqli_query($conexion, $sql);
        if ($consulta) {
            $conteo++;
            $_SESSION['conteoIndividual'] = $conteo;
            $_SESSION['conteoNO'] = "SI";
        } else {
            $_SESSION['conteoNO'] = "NO";
        }
        $this->desconectarBD($conexion);
        echo "<script>window.location.href = '../inventario/entradas';</script>";
    }

    //=========================================================================================================================

    //Obtiene usuarios
    function obtieneUsuarios()
    {
        $conexion = $this->conectarBD();
        $sql = "SELECT * FROM registro";
        $consulta = mysqli_query($conexion, $sql);
        return $consulta;
    }
}
