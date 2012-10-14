<?php

include 'install.config.php';

require_once '../servicioDialogo.DAC/ConnectionManager.php';
require_once '../servicioDialogo.DAC/ArchivoDAC.php';



//$dir_archivos_sqlite = "../sqlite_files/";
//
//$dialogo_archivos_sqlite = "dialogo_archivos.sqlite";
//
//$from_page_location = "../../servicioDialogo/";
//
//$default_user_image = "uploads/default/default.jpg";
//
//$dialogo_configbd_sqlite = "dialogo_configbd.sqlite";

$metodo = $_POST["metodo"];
$servidor = $_POST["servidor"];
$puerto = $_POST["puerto"];
$basededatos = $_POST["basededatos"];
$usuario = $_POST["usuario"];
$contrasegna = $_POST["contrasegna"];

$stp = new Configuration($metodo, $servidor, $puerto, $basededatos, $usuario, $contrasegna);

class Configuration {

    private $server;
    private $port;
    private $database;
    private $user;
    private $password;
    public $mensajeNotificacion;

    public function __construct($metodo, $servidor, $puerto, $basededatos, $usuario, $contrasegna) {
        $this->mensajeNotificacion = "";
        $this->server = $servidor;
        $this->port = $puerto;
        $this->database = $basededatos;
        $this->user = $usuario;
        $this->password = $contrasegna;

        if ($metodo == "onLoad")
            $this->onLoad();
        if ($metodo == "configurarBd")
            $this->configurarBd();
        if ($metodo == "configurarBdArchivo")
            $this->configurarBdArchivo();
        if ($metodo == "configurarParametros")
            $this->configurarParametros();
    }

    public function configurarParametros() {
//        $zonahoraria = $this->server;
//        $imagenes = $this->port;
//        $sqlite = $this->database;
//        $defaultavatar = $this->user;
//
//        $zonahoraria = '$default_time_zone = "' . $zonahoraria . '";';
//        $imagenes = '$uploads = "' . $imagenes . '";';
//        $sqlite = '$dir_archivos_sqlite = "' . $sqlite . '";';
//        $defaultavatar = '$default_user_image = "' . $defaultavatar . '";';
//
//        if (@file_exists("../servicio.config.php")) {
//            $file = @file("../servicio.config.php");
//
//           
//            $file[4] = $zonahoraria;
//            $file[8] = $imagenes;
//            $file[12] = $sqlite;
//            $file[20] = $defaultavatar;
//
//            $archivo = fopen("../servicio.config.php", "w+");
//
//            for ($i = 0; $i < count($file); $i++) {
//                fwrite($archivo, $file[$i]);
//            }
//
//            fclose($archivo);
//
//
//            $file = @file("../servicio.config.php");
//            print_r($file);
//            echo $file[4] . "--" . $zonahoraria;
//            if(strcmp($file[4], $zonahoraria."\r\n")==0 &&
//                    strcmp($file[8], $imagenes."\r\n")==0 &&
//                    strcmp($file[12], $sqlite."\r\n")==0 &&
//                    strcmp($file[20], $defaultavatar."\r\n")==0){
//                
//                echo "Se guardó la configuración";
//            }else{
//                echo "No se guardó la configuración";
//            }
//            
//            
//            
//        } else {
//            echo "Archivo de configuración no existe.";
//        }
    }

    public function onLoad() {
        //verificación de bd de archivos.
        $retorno = null;
        $_dir = "../sqlite_files";
        $archivo = $_dir . "/dialogo_archivos.sqlite";

        if (file_exists($archivo)) {
            //$retorno->configBdArchivo = array();
            $retorno->configBdArchivo->btnConfigurarBdArchivos = false;
            $retorno->configBdArchivo->tituloConfigBdArchivos = false;
        } else {
            $retorno->configBdArchivo->mensaje = "La base de datos para archivos no existe. Presione el botón para crearla";
        }

        //carga de configuración de la bd para mostrar en pantalla.
        $archivo = $_dir . "/dialogo_configbd.sqlite";
        if (file_exists($archivo)) {
            $conexionManager = new ConnectionManager();
            $retorno->FormConfigBd->bdName = $conexionManager->DatabaseName;
            $retorno->FormConfigBd->port = $conexionManager->Port;
            $retorno->FormConfigBd->servidor = $conexionManager->ServerURL;
            $retorno->FormConfigBd->usuario = $conexionManager->UserID;
        }

        if (@file_exists("../servicio.config.php")) {
            $archivo = file("../servicio.config.php");
            $retorno->config->timezone = str_replace("\";", "", str_replace('$default_time_zone = "', "", $archivo[4]));
            $retorno->config->uploads = str_replace("\";", "", str_replace('$uploads = "', "", $archivo[8]));
            $retorno->config->dirsqlite = str_replace("\";", "", str_replace('$dir_archivos_sqlite = "', "", $archivo[12]));
            $retorno->config->defaultavatar = str_replace("\";", "", str_replace('$default_user_image = "', "", $archivo[20]));
        }


        echo json_encode($retorno);
    }

    public function configurarBdArchivo() {

        try {
            $_dac = new ArchivoDAC();
            $_file = $_dac->obtenerArchivo("obtener_bd");
        } catch (Exception $e) {
            echo $e;
        }

        echo "Archivo creado exitosamente.";
    }

    public function configurarBd() {
        try {
            $_cadena = "host=" . $this->server . " ";
            $_cadena.= "port=" . $this->port . " ";
            $_cadena.= "user=" . $this->user . " ";
            $_cadena.= "password=" . $this->password . " ";
            $_cadena.= "dbname=" . $this->database . " ";



            $testconn = @pg_connect($_cadena);
//            echo $testconn;
            if (!$testconn) {
//                echo $_cadena . "\n";
                echo "No se puede establecer la conexión con los datos ingresados.";
                return;
            }
            @pg_close($testconn);

            ConnectionManager::configurarBaseDatos("postgresql", $this->server, $this->port, $this->database, $this->user, $this->password);
            echo "La configuración se realizó con éxito";
        } catch (Exception $e) {
            echo "No se pudo crear la configuración de la base de datos";
            return;
        }
    }

}

?>
