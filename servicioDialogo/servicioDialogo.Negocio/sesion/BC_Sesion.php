<?php
include_once '././servicioDialogo.DAC/UsuarioDAC.php';
include_once '././servicioDialogo.Datos/sesion/Sesion.php';
//include_once '././servicioDialogo.Datos/Usuario.php';
/**
 * Gestion las sesiones del sistema 
 */
class BC_Sesion {

    /**
     * inicia una sesion en el sistema,
     * si ya existe una existente para el usuario
     * expira la anterior.
     * @param type $usuario
     * @param type $password 
     */
    public function iniciarSesion($usuario, $password) {
        
        try {
            
            $_dac = new UsuarioDAC();
            //Usuario
            
            $_login = $_dac->obtenerUsuario($usuario, true);
            
            //Sesion
            $_retorno = new Sesion();
            
                
            if($_login != null && $_login->PassWordValido($password)){
                
                $_retorno->creacion = date("d-m-Y H:i");
                $_retorno->idSesion = $this->crearIdSesion($_retorno);
                $_retorno->usuario = $_login;
                
                /**
                 * Grupo 4 - Danilo Aburto
                 * Para implementar sesiones se hace a nivel de variables en 
                 * el servidor, ahora para utilizar la sesión creada es neces-
                 * ario utilizar session_start en los lugares donde se requiere
                 * que la sesión esté iniciada
                 */
                session_start();           
                $_SESSION['user_fullname'] = $_login->nombreCompleto;
                $_SESSION['user_username'] = $_login->nombreUsuario;
                $_SESSION['user_email'] = $_login->email;
                
                
                //$_retorno->expiracion = sumar 1 hora.
                
                //$_retorno->idSesion = $this->
            }else{
                $_retorno->MensajeError="El usuario o la contraseña no son válidos";
            }
            return $_retorno;
        } catch (Exception $e) {
            $error = new Sesion();
            $error->MensajeError = "No se pudo crear la sesión. Error " . $e;
            return $error;
        }
    }
    
    /**
     *
     * @param Sesion $sesion 
     */
    private function crearIdSesion($sesion){
        //random
        $r = rand();
        if($sesion->creacion == null){
            $sesion->creacion = date("d-m-Y_H:i");
        }
        $idSes = $r . "ses" . $sesion->creacion;
        return $idSes;
    }
    
    /**
     *Verifica que la sesión está registrada en el sistema.
     * @param string $usuario Nombre de usuario para la sesión
     * @param string $idSesion Identificador asignado para la sesión
     * @param bool $actualizarExpiracion Indica si debe actualizar la fecha de expiración de la sesión.
     * @return Sesion Objeto de sesión válido para uso en el sistema.
     */
    public function verificarSesion($usuario, $idSesion, $actualizarExpiracion){
        $_retorno = new Sesion();
        $_dac = new UsuarioDAC();
        
        $_login = $_dac->obtenerUsuario($usuario, true);
        
        $_retorno->usuario = $_login;
        $_retorno->idSesion = $idSesion;
        $_retorno->MensajeError = "";
        
        if($actualizarExpiracion){
            // $_retorno->expiracion = //agregar 45 minutos.
        }
        
        return $_retorno;
        
    }
    
    /**
     *Verifica si la sesión indicada es válida
     * @param Sesion $sesion sesión a validar.
     * @return boolean Verdadero si es válido.
     */
    public static function sesionValida($sesion){
        return true;
    }
    
    /**
     *Cierra la sesión en el sistema.
     * @param type $sesionPorCerrar 
     */
    public function cerrarSesion($sesionPorCerrar){
        
    }

}

?>
