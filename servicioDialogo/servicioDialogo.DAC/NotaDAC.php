<?php
require_once './servicioDialogo.Datos/Nota.php';
require_once './servicioDialogo.DAC/ConnectionManager.php';
require_once './servicioDialogo.Datos/Usuario.php';
require_once './servicioDialogo.Datos/Intervencion.php';

/**
 *Accede a los datos vinculados con las notas de una intervencion. 
 */
class NotaDAC{
    
    
    /**
     *Elimina una nota del sistema
     * @param int $idNota Identificador único de la nota.
     * @return bool Verdadero si la nota fue eliminada, falso en caso contrario.
     */
    public function eliminarNota($idNota){
        //FUNCIÓN NO IMPLEMENTADA EN APLICACIÖN ORIGINAL.
        $_ret = false;
        
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = new Query($conexion, "nota_intervencion");
                $_q->addCondicion("n_id_nota=" . $idNota);
                
                $_ret = $conexion->modificar($_q->QueryDelete());
                $conexion->cerrarConexion();
            }
    }catch(Exception $e){}
    
    return $_ret;
    }
    
    
    /**
     *Modifica el contenido de la nota, acorde a su identificador único
     * @param Nota $nota Objeto nota completo.
     * @return bool Verdadero si la modificacion de contenido de la nota fue exitoso.
     */
    public function modificarNota($nota){
        $_ret = false;
        
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                
                $_q = new Query($conexion, "nota_intervencion");
                $_q->addValorString("x_contenido_nota",  $nota->Texto);
                
                $_q->addCondicionAND("n_id_nota=" . $nota->IdNota);
                $_ret = $conexion->modificar($_q->QueryUpdate());
                $conexion->cerrarConexion();
            }
    }catch(Exception $e){}
    
    return $_ret;
    }
    /**
     *Guarda el contenido de la nota especificada.
     * @param Nota $nota Objeto nota completo, incluyendo la intervencion asociada (IMPORTA EL ID).
     * @return bool Verdadero si la modificacion del contenido de la ntoa fue exitoso.
     */
    public function insertarNota($nota){
        $_ret = false;
        
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = new Query($conexion, "nota_intervencion");
                $_q->addValorString("x_contenido_nota", $nota->Texto);
                $_q->addValorString("n_id_intervencion", $nota->intervencionPadre->idIntervencion);
                $_q->addValorString("x_id_usuario", $nota->Autor->nombreUsuario);
                
                $_ret = $conexion->modificar($_q->QueryInsert());
                $conexion->cerrarConexion();
            }
    }catch(Exception $e){}
    
    return $_ret;
    }
    /**
     *Genera un objeto Nota para el identificador único especificado.
     * @param int $idNota Identificador único de la nota
     * @reutrn Nota Objeto Nota completo.
     */
    public function obtenerNota($idNota){
        //Nota
        $_retorno = null;
        
        try{
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_query = new Query($conexion, "nota_intervencion");
                $_query->addCampo("n_id_intervencion");
                $_query->addCampo("x_id_usuario");
                $_query->addCampo("x_contenido_nota");
                $_query->addCondicionAND("n_id_nota=" . $idNota);
                //echo $_query->QuerySelect();
                $_dt = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();
                
                if($_dt != null && count($_dt) > 0){
                    $_retorno = new Nota();
                    $dr = $_dt[0];
                    $_retorno->IdNota = $idNota;
                    
                    $_retorno->Texto = $dr["x_contenido_nota"];
                    $_autor = new Usuario();
                    $_autor->nombreUsuario = $dr["x_id_usuario"];
                    $_retorno->Autor = $_autor;
                    
                    $_int = new Intervencion();
                    $_int->idIntervencion = $dr["n_id_intervencion"];
                }
            }
    }catch(Exception $e){}
    return $_retorno;
    }
    
    /**
     *Genera un objeto de Notas creadas en un diálogo por el autor especificado
     * @param int $idDialogo Identificador único del diálogo
     * @param Usuario $autor Objeto usuario, importa el nombre de usuario.
     * @return Nota[] Colección de notas creadas, en caso de no existir, regresa una colección nula.
     */
    public function obtenerNotasDialogo($idDialogo, $autor){
        //Nota
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = "select tnota.* from nota_intervencion tnota";
                $_q .= " inner join intervencion tinte";
                $_q .= " on tnota.n_id_intervencion = tinte.n_id_intervencion";
                $_q .= " inner join dialogo tdialog";
                $_q .= " on tdialog.n_id_dialogo = tinte.n_id_dialogo";
                $_q .= " where tdialog.n_id_dialogo = " . $idDialogo;
                $_q .= " and tnota.x_id_usuario = '" . $autor->nombreUsuario . "'";
                
                $_dt = $conexion->consultar($_q);
                
                if($_dt != null){
                    $_retorno = array();
                    $i = 0;
                    foreach($_dt as $dr){
                        $_nueva = new Nota();
                        
                        $_nueva->IdNota = $dr["n_id_nota"];
                        $_nueva->Texto = $dr["x_contenido_nota"];
                        
                        $_nueva->Autor = $autor;
                        
                        $_int = new Intervencion();
                        $_int->idIntervencion = $dr["n_id_intervencion"];
                        $_nueva->intervencionPadre = $_int;
                        
                        $_retorno[$i++] = $_nueva;
                    }
                }
            }
    }catch(Exception $e){}
    
    return $_retorno;
    }
}
?>
