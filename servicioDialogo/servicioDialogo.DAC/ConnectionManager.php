<?php

include_once("drivers/PostreSQLDriver.php");
include_once("drivers/SQLiteDriver.php");

/**
 * GEstiona la conexión a la base de datos, creando un objeto para el driver configurado. 
 */
class ConnectionManager {

    //Configuración por defecto.
    public $driver = "postgresql";
    public $ServerURL = "127.0.0.1";
    public $Port = "5432";
    public $UserID = "dialogo";
    public $Password = "dialogo123";
    public $DatabaseName = "dialogo";

    public function __construct() {
        //SQLiteDriver
        $_conexion = new SQLiteDriver();
        //String recupera la ubicación del archivo sqLite.

        $_dir = "./sqlite_files";
        $_conexion->NombreBD($_dir . "/dialogo_configbd.sqlite");

        if (file_exists($_conexion->NombreBD(null))) {
            
            $_dt = $_conexion->seleccionar("select * from tconfig");
            
        } else {
            $_dir = "../sqlite_files";
            $_conexion->NombreBD($_dir . "/dialogo_configbd.sqlite");

            $_dt = $_conexion->seleccionar("select * from tconfig");
        }

        
        if (count($_dt) > 0) {
            $dr = $_dt[0];
            
            $this->driver = $dr["driver"];
            $this->ServerURL = $dr["host"];
            $this->Port = $dr["port"];
            $this->UserID = $dr["usuario"];
            $this->Password = $dr["password"];
            $this->DatabaseName = $dr["dbname"];
        }
    }

    /**
     * Realiza la conexion acorde a la configuración de base de datos del sistema. 
     * @return DBDriver Objeto que corresponde  a la conexion actual con la base de datos.
     */
    static function ObtenerConexion() {
        //DBDriver
        $_retorno = null;
        $cm = new ConnectionManager();

        if ($cm->driver == "postgresql") {

            $_retorno = new PostreSQLDriver($cm->ServerURL, $cm->Port, $cm->UserID, $cm->Password, $cm->DatabaseName);
        }

        return $_retorno;
    }

    static function configurarBaseDatos($driver, $host, $puerto, $bdname, $usuario, $password) {
        $_conexion = new SQLiteDriver();
        $_dir = $GLOBALS["dir_archivos_sqlite"] . $GLOBALS["dialogo_configbd_sqlite"];

        $_conexion->NombreBD($_dir);


        if (!file_exists($_dir)) {

            ConnectionManager::crearBaseDatosConfigBD($_conexion);

            $_q = "insert into tconfig(driver, host, port, dbname,usuario,password)";
            $_q .=" values ('" . $driver . "','" . $host . "','" . $puerto . "','" . $bdname . "','" . $usuario . "','" . $password . "')";
            $exito = $_conexion->ExecuteQuery($_q, false);
            return $exito;
        } else {

            $_q = "update tconfig set host='" . $host . "', port='" . $puerto . "', dbname='" . $bdname . "', usuario='" . $usuario . "', password='" . $password . "',driver='" . $driver . "';";

            $exito = $_conexion->ExecuteQuery($_q, false);

            return $exito;
        }
    }

    /**
     *
     * @param SQliteDriver $_driver 
     */
    private static function crearBaseDatosConfigBD($_driver) {
        // $archivo = $_driver->NombreBD(null);

        $_sql = "create table tconfig(driver varchar, host varchar, port varchar, dbname varchar, usuario varchar, password varchar)";
        //crea el archivo sqlite.
        $_driver->crearBD(true);
//        $sqlite = new SQLite3($_driver->NombreBD(null));
//        $sqlite->query($_sql);
//        $sqlite->close();


        $_driver->ExecuteQuery($_sql, true);
        $_driver->cerrarConexion();
    }

}

?>