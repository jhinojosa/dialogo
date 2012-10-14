<?php

require_once("./servicioDialogo.DAC/UsuarioDAC.php");

/**
 * Gestiona el acceso y escritura de datos vinvulados a un Usuario. 
 */
class BCUsuario {

    /**
     * Cambia la contraseña del usuario indicado y la envía al correo.
     * @param string $usuario
     * @return boolean 
     */
    public function recuperarContrasena($usuario) {
        try {
            $_ret = false;
            try {
                $_usuarioCoincidente = null;
                //Verificar si existe el correo electrónico.
                //Retorna el/los correos que coincidan para esa persona.
                $_dac = new UsuarioDAC();
                $_usuarioCoincidente = $_dac->obtenerUsuario($usuario, false);
//                print_r($_usuarioCoincidente);
            } catch (Exception $e) {
                $_usuarioCoincidente = null;
            }

            if (!is_null($_usuarioCoincidente)) {
                //Generar nuevas contraseñas almacenándolas en los arreglos.
                $user = $_usuarioCoincidente;

                $code = md5(uniqid(rand(), true));
                $user->nuevaPassword = substr($code, 0, 10);
                $user->Password = md5($user->nuevaPassword);

                //Reemplazar en la base de datos.
                //update en función del ID.
//                    print_r($user);
                $_ok = $_dac->actualizarContrasenasUsuario($user);
//                    echo json_encode($_ok);
                if ($_ok) {

                    //Enviar Correo
                    $cuerpo = $user->nombreCompleto . " (" . $user->nombreUsuario . "):\n\n";
                    $cuerpo .= "Sus datos de ingreso al Sistema para el Diálogo Remoto se muestran a continuación:\n\n\n";
                    $cuerpo .= "Nombre de usuario (login): " . $user->nombreUsuario . "\n";
                    $cuerpo .= "Contraseña: " . $user->nuevaPassword . "\n\n\n";
                    $cuerpo .= "Esta contraseña se ha generado automáticamente. Recomendamos que la cambies a la brevedad.\n\n";
                    $cuerpo .= "Atentamente,\nEl equipo de Sistema para el Diálogo Remoto";
                    $cuerpo .= "\n\n\nMensaje generado automáticamente, no responda a esta dirección de correo electrónico.";

                    $subject = "Obtención de contraseña (" . $user->nombreUsuario . ")";
                    $subject = utf8_decode($subject);

                    $headers = 'From: Sistema para el Diálogo Remoto<dialogoremoto@dialogo.usach.cl>' . "\r\n" .
                            'Reply-To: dialogoremoto@dialogo.usach.cl' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

//                        echo $user->email;
                    $_ret = mail($user->email, $subject, $cuerpo, $headers);
//                        echo json_encode($_ret);
                }


//                print_r($_correoCoincidente);
            } else {
                $_ret = false;
            }
        } catch (Exception $e) {
            $_ret = false;
        }

        return $_ret;
    }

    /**
     * Modifica los datos del usuario por los nuevos ingresados.
     * @param Usuario $usuario 
     * @return bool Verdadero si modifica OK.
     * 
     */
    public function modificarUsuario($usuario) {
        try {

            $_ret = false;
            $_dac = new UsuarioDAC();
            $usu = $_dac->obtenerUsuario($usuario->nombreUsuario, false);
            
            
            if (!is_null($usu)) {

                if (strlen($usuario->oldPassword) == 0) {
                    $usuario->Password = $usu->Password;
                    $_ret = $_dac->actualizarUsuario($usuario);
                
                    
                } else {
                    
                    if (strtolower(md5($usuario->oldPassword)) == strtolower($usu->Password)) {
                        //Asigno la nueva contraseña.
                        $usuario->Password = md5($usuario->Password);
                       
                        $_ret = $_dac->actualizarUsuario($usuario);
                    }else{
                        return false;
                    }
                }
            }else{
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        
        return $_ret;
    }

    /**
     * Registra un usuario en el sistema
     * @param Usuario $usuario Objeto de usuario completo
     * @param string $mensajeError utilizado para retornar errores
     * @return boolean  Verdadero si se pudo registrar el usuario exitosamente.
     */
    public function registrarUsuario($usuario, $mensajeError) {
        try {
            //Nuevo objeto de tipo usuario.
            //$user = new Usuario();

            $_ret = false;
            $_dac = new UsuarioDAC();
            $usu = $_dac->obtenerUsuario(strtolower($usuario->nombreUsuario), false);

            /**
             * Busca el archivo del usuario en el servidor,
             * en la carpeta definida por $GLOBALS["uploads"]. 
             */
            if (file_exists($usuario->imagen . ".jpg")) {
                $usuario->imagen .= ".jpg";
            } elseif (file_exists($usuario->imagen . ".jpeg")) {
                $usuario->imagen .= ".jpeg";
            } elseif (file_exists($usuario->imagen . ".gif")) {
                $usuario->imagen .= ".gif";
            } elseif (file_exists($usuario->imagen . ".png")) {
                $usuario->imagen .= ".png";
            }else
                $usuario->imagen = $GLOBALS["default_user_image"];



            if ($usu == null) {
                $usuario->nuevaPassword = $usuario->Password;
                $usuario->Password = $usuario->hashPassword();
                $usuario->nombreUsuario = strtolower($usuario->nombreUsuario);

                $_ret[0] = $_dac->insertarUsuario($usuario);

                //Enviar Correo
                $cuerpo = $usuario->nombreCompleto . ":\n\n";
                $cuerpo .= "Le damos la bienvenida al Sistema para el Diálogo Remoto,\n\n";
                $cuerpo .= "sus datos de ingreso se muestran a continuación.\n\n\n";
                $cuerpo .= "Nombre de usuario (login): " . $usuario->nombreUsuario . "\n";
                $cuerpo .= "Contraseña: " . $usuario->nuevaPassword . "\n\n\n";
                $cuerpo .= "Le recordamos que puede acceder desde " . $GLOBALS["pagina_login"] . "\n\n\n";
                $cuerpo .= "Atentamente,\nEl equipo de Sistema para el Diálogo Remoto";
                $cuerpo .= "\n\n\nMensaje generado automáticamente, no responda a esta dirección de correo electrónico.";

                $subject = $usuario->nombreCompleto . ": Bienvenid@ al Sistema para el Diálogo Remoto.";
                $subject = utf8_decode($subject);

                $headers = 'From: Sistema para el Diálogo Remoto<dialogoremoto@dialogo.usach.cl>' . "\r\n" .
                        'Reply-To: dialogoremoto@dialogo.usach.cl' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

//                        echo $user->email;
                mail($usuario->email, $subject, $cuerpo, $headers);
            } else {
                $_ret[1] = $mensajeError = "El usuario ya existe";
                $_ret[0] = false;
            }

            return $_ret;
        } catch (Exception $e) {
            $_ret[1] = $mensajeError = "Error al intentar insertar usuario";
        }
        $_ret[0] = false;
        return $_ret;
        //return false;
    }

}

?>