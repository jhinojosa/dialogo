<?php

require("DBDriver.php");

/**
 * Driver de conexión con el motor de base de datos PostgreSQL 
 */
class PostreSQLDriver implements DBDriver {

//Conexión a pgsql
//private NpgsqlConnection conn;
    private $conn;
    public $ServerURL = "127.0.0.1";
    public $Port = "5432";
    public $UserID = "dialogo";
    public $Password = "dialogo123";
    public $DatabaseName = "dialogo";

    /**
     * Instancia el driver, con los parametros de conexion indicado. 
     * @param type $serverURL Direccion del servidor
     * @param type $Port Puerto a utilizar (por defecto 5432)
     * @param type $UserID nombre de usuario (rol)
     * @param type $Password Contraseña asignada al rol
     * @param type $DatabaseName Nombre de la base de datos.
     */
    public function __construct($serverURL, $Port, $UserID, $Password, $DatabaseName) {
        $this->ServerURL = $serverURL;
        $this->Port = $Port;
        $this->UserID = $UserID;
        $this->Password = $Password;
        $this->DatabaseName = $DatabaseName;
    }

    /**
     * Abre la conexion con la base de datos.
     * @return {bool} Verdadero si se pudo abrir la conexion
     * Falso en caso de errores. 
     */
    public function abrirConexion() {
        try {
            $_cadena = "host=" . $this->ServerURL . " ";
            $_cadena.= "port=" . $this->Port . " ";
            $_cadena.= "user=" . $this->UserID . " ";
            $_cadena.= "password=" . $this->Password . " ";
            $_cadena.= "dbname=" . $this->DatabaseName . " ";

            $this->conn = pg_connect($_cadena);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Realiza una consulta de seleccion en la base de datos
     * @param type $query consulta de seleccion a ejecutar
     * @return Objeto con los resultados.
     */
    public function consultar($query) {
        try {
            //echo "---".$query."---";
            $da = pg_query($query);

            $ds = pg_fetch_all($da);
            $_ret = $ds;
//Borrar la columna 0?
            
            if ($_ret != false)
                return $_ret;
            else
                return array();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Cierra la conexion con la base de datos. 
     */
    public function cerrarConexion() {
        try {
            pg_close($this->conn);
        } catch (Exception $e) {
            
        }
    }

    /**
     * Realiza una transaccion sin esperar un retorno
     * @param string $query Consulta a ejecutar
     * @return Verdadero si la consulta afectó a filas.
     */
    public function modificar($query) {
        $filas = 0;

        try {
            //echo $query;
            $da = pg_query($query);

            try {
                $filas = pg_fetch_all($da);
            } catch (Exception $e) {
                
            }

            return (count($filas) > 0);
        } catch (Exception $e) {
            
        }
        return false;
    }

    /**
     * Realiza una transacción obteniendo el valor de retorno.
     * @param string $query consulta a ejecutar.
     * @param string $campoRetorno Nombre de la columna a rescatar tras la inserción.
     * @param ref_int $valor Entero por referencia utilizado para conocer el valor asignado.
     * @return Verdadero si la consulta afectó a filas.
     */
    public function modificar_($query, $campoRetorno, &$valor) {
        $_retorno = "";
        try {
            $query = $query .= " returning " . $campoRetorno;
            //echo $query;
            $da = pg_query($query);
            
            try {
                $_retorno = pg_fetch_all($da);
            } catch (Exception $e) {
                
            }
            
            try{
                $valor = intval($_retorno[0][$campoRetorno]);
                //echo $valor;
            }catch(Exception $e){}
            
            return ($_retorno != null);
            
            
        } catch (Exception $e) {
            
        }
    }

}

?>