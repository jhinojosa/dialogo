<?php

require_once './servicioDialogo.DAC/ArchivoDAC.php';

/**
 * gestiona la obtención de archivos en el sistema. 
 */
class BCArchivo {

    function __construct() {
        
    }

    public function obtenerArchivo($sesion, $nombreArchivo) {
        $_dac = new ArchivoDAC();
        $_retorno = $_dac->obtenerArchivo($nombreArchivo);
        //echo $_retorno;

        if ($_retorno != $GLOBALS["from_page_location"] . $GLOBALS["default_user_image"]) {
            return $_retorno;
        } else {



            $cant = 1;
            $nombreUsuario = str_replace("avatar_", "", $nombreArchivo, $cant);
            //echo $nombreUsuario;
//Verificar si existe imagen para este usuario

            $filename = str_replace($GLOBALS["from_page_location"] . $GLOBALS["default_user_image"], $GLOBALS["uploads"] . $nombreUsuario, $_retorno, $cant);



            if (file_exists(utf8_encode($filename) . ".jpg")) {
                $archivo = $GLOBALS["from_page_location"] . $filename . ".jpg";
                //echo $archivo;
                $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
            }elseif (file_exists(utf8_encode ($filename) . ".jpeg")) {
                $archivo = $GLOBALS["from_page_location"] . $filename . ".jpeg";
                //echo $archivo;
                $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
            }elseif (file_exists(utf8_encode($filename . ".png"))) {
                $archivo = $GLOBALS["from_page_location"] . $filename . ".png";
                $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
            }elseif (file_exists(utf8_encode($filename . ".gif"))) {
                $archivo = $GLOBALS["from_page_location"] . $filename . ".gif";
                $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
            }else {
                //echo $filename;
                foreach (glob($GLOBALS["uploads"] . "*.jpg") as $name) {
                    //$name = str_replace($GLOBALS["uploads"], "", $name, $cant);
                    //echo utf8_encode($name);
                    if (utf8_encode($name) == ($filename . ".jpg")) {
                        $archivo = $GLOBALS["from_page_location"] . $filename . ".jpg";
                        //echo $archivo;
                        $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
                        break;
                    }
                }
                foreach (glob($GLOBALS["uploads"] . "*.jpeg") as $name) {
                    //$name = str_replace($GLOBALS["uploads"], "", $name, $cant);
                   //echo utf8_encode($name);
                    if (utf8_encode($name) == ($filename . ".jpeg")) {
                        $archivo = $GLOBALS["from_page_location"] . $filename . ".jpeg";
                        //echo $archivo;
                        $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
                        break;
                    }
                }
                foreach (glob($GLOBALS["uploads"] . "*.png") as $name) {
                    //$name = str_replace($GLOBALS["uploads"], "", $name, $cant);
                    if (utf8_encode($name) == ($filename . ".png")) {
                        $archivo = $GLOBALS["from_page_location"] . $filename . ".png";
                        $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
                        break;
                    }
                }
                foreach (glob($GLOBALS["uploads"] . "*.gif") as $name) {
                    //$name = str_replace($GLOBALS["uploads"], "", $name, $cant);
                    if (utf8_encode($name) == ($filename . ".gif")) {
                        $archivo = $GLOBALS["from_page_location"] . $filename . ".gif";
                        $this->modificarArchivo("avatar_" . $nombreUsuario, $archivo);
                        break;
                    }
                }
            }

            $_retorno = $_dac->obtenerArchivo($nombreArchivo);
        }
        return $_retorno;
    }

    private function modificarArchivo($nombre, $archivo) {
        $_dac = new ArchivoDAC();
        $_dac->actualizarArchivo($nombre, $archivo);
    }

}

?>
