<?php

require_once("ConnectionManager.php");

if (file_exists("./servicioDialogo.Datos/Usuario.php"))
    require_once("./servicioDialogo.Datos/Usuario.php");
else {
    require_once("../servicioDialogo.Datos/Usuario.php");
}
require_once("utils/Query.php");
require_once 'ArchivoDAC.php';

/// <summary>
/// Genera y ejecuta consultas vinculadas a la tabla Usuario
/// </summary>
class UsuarioDAC {

    public function comprobarCorreo($correo) {

        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            $usuarioCorreos = null;
            $_tablaUsuario = null;
            if ($_exito) {
                $_consulta = "select * from usuario where x_email_usuario='" . $correo . "'";

                $_tablaUsuario = $conexion->consultar($_consulta);
                $conexion->cerrarConexion();

//            print_r($_tablaUsuario);
                $usuarioCorreos = array();
                foreach ($_tablaUsuario as $usu) {
                    $usuario = new Usuario();
                    $usuario->nombreCompleto = $usu["x_nombre_completo"];
                    $usuario->nombreUsuario = $usu["x_id_usuario"];
                    $usuario->email = $usu["x_email_usuario"];

                    array_push($usuarioCorreos, $usuario);
                }
            }
        } catch (Exception $e) {
            return null;
        }

        return $usuarioCorreos;
    }

    /**
     * Actualiza todas las contraseñas registradas para el correo electrónico.
     * @param type $userPasswords 
     */
    public function actualizarContrasenasUsuario($user) {
        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();
        
        $_ret = false;
        if ($_exito) {
            
            $_consulta = new Query($conexion, "usuario");
            $_consulta->addValorString("x_password", $user->Password);
            $_consulta->addCondicion("x_id_usuario='" . $user->nombreUsuario . "'");
//            echo $_consulta->QueryUpdate();
            $_ret = $conexion->modificar($_consulta->QueryUpdate());
        }
        
        return $_ret;
    }
    
    /**
     *Actualiza los datos del usuario.
     * @param Usuario $usuario 
     * @return bool Verdadero si se actualiza.
     */
    public function actualizarUsuario($usuario){
       $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();
        
        if($_exito){
            $_consulta = new Query($conexion, "usuario");
            $_consulta->addValorString("x_email_usuario", $usuario->email);
            $_consulta->addValorString("x_password", $usuario->Password);
            $_consulta->addValorString("x_nombre_completo", $usuario->nombreCompleto);
            $_consulta->addCondicion("x_id_usuario='". $usuario->nombreUsuario . "'");
            
            $_ret = $conexion->modificar($_consulta->QueryUpdate());
            $conexion->cerrarConexion();
            
            return $_ret;
        }
        
        return false;
        
    }

    /// <summary>
    /// Inserta un usuario en la base de datos
    /// </summary>
    /// <param name="datosUsuario">Objeto lleno con los datos del usuario</param>
    /// <returns>Verdadero si la inserci�n fue exitosa</returns>
    //$datosUsuario del tipo Usuario.
    ///retorna booleano.
    public function insertarUsuario($datosUsuario) {

        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();

        if ($_exito) {
            $_fileDac = new ArchivoDAC();

            $_consulta = new Query($conexion, "usuario");
            $_consulta->addValorString("x_id_usuario", $datosUsuario->nombreUsuario);
            $_consulta->addValorString("x_email_usuario", $datosUsuario->email);
            $_consulta->addValorString("x_password", $datosUsuario->Password);
            $_consulta->addValorString("x_nombre_completo", $datosUsuario->nombreCompleto);
            $_consulta->addValorString("n_codigo_rol", $datosUsuario->Rol);

            //print_r($_consulta->QueryInsert());
            $_queryInsert = $_consulta->QueryInsert();

            $_exito = $conexion->modificar($_queryInsert);

            $conexion->cerrarConexion();
            if ($_exito) {
                $_nombreArchivo = "avatar_" . $datosUsuario->nombreUsuario;
                try {
                    $_fileDac->insertarArchivo($_nombreArchivo, $GLOBALS["from_page_location"] . $datosUsuario->imagen);
                } catch (Exception $e) {
                    //$_fileDac->insertarArchivo($_nombreArchivo, $GLOBALS["from_page_location"] . $datosUsuario->imagen);
                }
            }

            return $_exito;
        }
        return false;
    }

    /**
     * Obtiene los datos de usuario especificado
     * rescatando los datos de la tabla usuario.
     * @param string $nombreUsuario (pk)
     * @param bool $cargarImagen Indica si debe buscar el archivo de imagen asociado al usuario
     * @return Objeto DAO de usuario. o nulo si no lo encontró.
     */
    public function obtenerUsuario($nombreUsuario, $cargarImagen) {
        try {
            //$conn=new ConnectionManager();
            //DBDriver
            $conexion = ConnectionManager::ObtenerConexion();
            //bool

            $_exito = $conexion->abrirConexion();
            $_tablaUsuario = null;
            if ($_exito) {
                $query = "select * from usuario where x_id_usuario='" . $nombreUsuario . "'";

                $_tablaUsuario = $conexion->consultar($query);
                $conexion->cerrarConexion();
            }
            if ($_tablaUsuario == null || count($_tablaUsuario) == 0) {
                return null;
            }

            $fila1 = $_tablaUsuario[0];
            $nuevo = new Usuario();
            $nuevo->nombreCompleto = $fila1["x_nombre_completo"];
            $nuevo->nombreUsuario = $fila1["x_id_usuario"];
            $nuevo->Password = $fila1["x_password"];
            $nuevo->email = $fila1["x_email_usuario"];

            $codigoRol = $nuevo->ROL_PARTICIPANTE; //ROl por defecto.
            try {
                $codigoRol = $fila1["n_codigo_rol"];
            } catch (Exception $e) {
                
            }

            $nuevo->Rol = $codigoRol;

            if ($cargarImagen) {
                $_dac = new ArchivoDAC();
                $nuevo->imagen = $_dac->obtenerArchivo("avatar_" . $nuevo->nombreUsuario);
                //echo $nuevo->imagen;
            }

            return $nuevo;
        } catch (Exception $e) {
            //Ocurrio un problema en el acceso a datos.
        }
    }

}

?>