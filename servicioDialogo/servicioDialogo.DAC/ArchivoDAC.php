<?php

/**
 *Inserta, selecciona en la base de datos de archivos del sistema
 * También crea la base de datos. 
 */
class ArchivoDAC{
    
    
    public function actualizarArchivo($nombre, $archivo){
        $_retorno = false;
        
        $_conexion = new SQLiteDriver();
        
        $_dir = $GLOBALS["dir_archivos_sqlite"];
        $_conexion->NombreBD($_dir . $GLOBALS["dialogo_archivos_sqlite"]);
        
        $_sql = "update tarchivo set archivo='". $archivo ."'". 
                "where nombre='". $nombre ."'"; 
        
        //echo $_sql;
        $_retorno = $_conexion->insertarArchivo($_sql, null, null );
        
        return $_retorno;
        
    }
    
    
    /**
     *Inserta un archivo en el sistema, si el nombre existe actualiza el archivo.
     * 
     * @param string $nombre
     * @param string $archivo representa la ubicación del archivo previamente subido al servidor.
     */
    public function insertarArchivo($nombre, $archivo){
        $_retorno = false;
        
        $_conexion = new SQLiteDriver();
        
        $_dir = $GLOBALS["dir_archivos_sqlite"];
        $_conexion->NombreBD($_dir . $GLOBALS["dialogo_archivos_sqlite"]);
        
        if(!file_exists($_conexion->NombreBD(null))){
            $this->crearBaseDatosArchivo($_conexion);
        }
        
        $_sql = "insert into tarchivo(nombre,archivo) values" .
                "('" . $nombre . "'".
                ", '" . $archivo . "')";
        
        //echo $_sql;
        $_retorno = $_conexion->insertarArchivo($_sql, null, null );
        
        return $_retorno;
        
    }
    
    
    /**
     *Obtiene el archivo indicado
     * @param string $nombre Nombre del archivo
     * @return byte[] Archivo almacenado en el servidor.
     */
    public function obtenerArchivo($nombre){
        $_retorno = null;
        $_conexion = new SQLiteDriver();
        $_dir = $GLOBALS["dir_archivos_sqlite"];
        
//        echo json_encode(file_exists($_dir . $GLOBALS["dialogo_archivos_sqlite"]));
//        
        $_conexion->NombreBD($_dir . $GLOBALS["dialogo_archivos_sqlite"]);
        if(!file_exists($_conexion->NombreBD(null))){
            $this->crearBaseDatosArchivo($_conexion);
            
        }
        try{
            $_q = "select archivo from tarchivo where nombre='".$nombre."'";
            //echo $_q;
            $_retorno = $_conexion->seleccionarArchivo($_q);
        }catch(Exception $e){}
        
        return $_retorno;
    }
    
    /**
     *Crea la estructura de base de datos para el manejo de archivos.
     * @param SQLiteDriver $_driver 
     */
    private function crearBaseDatosArchivo($_driver){
        
        $archivo = $_driver->NombreBD(null);
        

        //original
        //$_sql = "create table tarchivo(nombre varchar, archivo blob)";
        $_sql = "create table tarchivo(nombre varchar, archivo varchar)";
        $_driver->crearBD(true);
        
        
        $_driver->ExecuteQuery($_sql, true);
        
        $_driver->cerrarConexion();
        
        
    }
}
?>
