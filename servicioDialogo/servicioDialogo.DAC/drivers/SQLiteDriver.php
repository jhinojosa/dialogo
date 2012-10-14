<?php

/**
 * Implementa el acceso a datos para la base de datos SQLite. 
 */
class SQLiteDriver {

    //SQLite3
    private $conexion;
    //SQLiteCommand
    private $comando;

    public function __construct() {
        
    }

    //string
    private $BaseDatos = "config.sqlite";

    public function NombreBD($value) {
        if ($value == null) {
            return $this->BaseDatos;
        } else {
            $this->BaseDatos = $value;
        }
    }

    /**
     * Crea un archivo de base de datos dejando la conexion abierta.
     * @param bool $crear Indica si debe crear el archivo o solo abrir la conexion.
     */
    public function crearBD($crear) {
        if ($crear) {

            if (!file_exists($this->BaseDatos)) {
                $arch = fopen($this->BaseDatos, "w");
                fclose($arch);
            }
        } else {
           // $this->SetConnection();
        }
    }

    private function SetConnection() {
        //echo $this->BaseDatos."--";
        try {
           // $this->conexion = new SQLite3($this->BaseDatos);
            
        } catch (Exception $e) {
        }
    }

    /**
     * Cierra la conexion con la base de datos. 
     */
    public function cerrarConexion() {
        try {
            $this->conexion->close();
        } catch (Exception $e) {
            
        }
    }

    public function seleccionar($sql) {
        $_ret = null;
        try {
            //$this->SetConnection();
            $this->conexion = new SQLite3($this->BaseDatos);
            
            $_val = $this->conexion->query($sql);
            $valor = array();
//            //sqlite_close($this->conexion);
            while($row = $_val->fetchArray()){
                //echo json_encode($row);
                array_push($valor, $row);
            }
            $_ret = $valor;
            $this->conexion->close();
        } catch (Exception $e) {
        }
        return $_ret;
    }

    /**
     * Ejecuta la consulta de modificacion
     * @param string $txtQuery Consulta SQL de modificacion a ejecutar
     * @param bool $mantenerConexion Indica si debe mantener la conexion abierta, o abrir/cerrarla.
     */
    public function ExecuteQuery($txtQuery, $mantenerConexion) {
        try { 
            if (!$mantenerConexion) {
                //$this->SetConnection();
            }

            $this->conexion = new SQLite3($this->BaseDatos);
            $this->conexion->query($txtQuery);


            if (!$mantenerConexion) {
                $this->conexion->close();
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtiene un valor tipo blob para la consulta indicada
     * @param string $sql  Consulta SQL de obtencion del valor Blob
     * @return byte[] Arreglo de bytes con el resultado.
     */
    public function seleccionarArchivo($sql) {
        //echo $sql;
        //$this->SetConnection();
        $this->conexion = new SQLite3($this->BaseDatos);
        $valor = $this->conexion->query($sql);
        $val = array();
        while ($row = $valor->fetchArray()) {
            array_push($val, $row);
        }
        //echo $val[0]["archivo"];
        $this->conexion->close();
        if (count($val) != 0)
            return $val[0]["archivo"];
        else
            return $GLOBALS["from_page_location"] . $GLOBALS["default_user_image"];
    }

    /**
     * Ejecuta una consulta de agregado o actualización de datos que requiere guardar un valor tipo string (original BLOB).
     * @param type $sql
     * @param type $nombreParamArchivo
     * @param type $archivo 
     */
    public function insertarArchivo($sql, $nombreParamArchivo, $archivo) {
        $_ret = false;
        try {
            //$this->SetConnection();
            $this->conexion = new SQLite3($this->BaseDatos);
            //$handle = new SQLite3($this->BaseDatos);

            $this->conexion->query($sql);

            //$handle->query($sql);
            //$handle->close();
            $this->conexion->close();
            $_ret = true;
        } catch (Exception $e) {
            
        }

        return $_ret;
    }

}

?>
