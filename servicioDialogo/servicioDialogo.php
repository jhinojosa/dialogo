<?php

include 'servicio.config.php';

//Configura la zona horaria del servicio web.
date_default_timezone_set($GLOBALS["default_time_zone"]);


////Ubicación donde se almacenan las imágenes de usuario en el servidor
////Corresponde con el script de subida ubicado en 
////servicioDialogo/uploads/script/valums-file-uploader/server
//$uploads = "uploads/";
///**
// * Ubicación dentro del servidor, de los archivos sqlite. 
// */
//$dir_archivos_sqlite = "sqlite_files/";
///**
// * Ubicación dentro del servidor, del archivo dialogo_archivos.sqlite 
// */
//$dialogo_archivos_sqlite = "dialogo_archivos.sqlite";
//
///**
// * Ubicación dentro del servidor de las imagenes de avatar de usuario. 
// */
//$default_user_image = "uploads/default/default.jpg";
///**
// * dirección a la que se accede desde la página web a las imágenes de avatar de usuario. 
// */
//$from_page_location = "../../servicioDialogo/";
//Carga las extensiones utilizadas por el programa.
// Pull in the NuSOAP code
require_once("lib/nusoap.php");
require_once("servicioDialogo.Negocio/BCDialogo.php");
require_once("servicioDialogo.Negocio/BCUsuario.php");
require_once("servicioDialogo.Negocio/BCMovida.php");
require_once("servicioDialogo.Negocio/BCMarcador.php");
require_once("servicioDialogo.Negocio/BCIntervencion.php");
require_once("servicioDialogo.Negocio/BCActa.php");
require_once("servicioDialogo.Negocio/BCEstadisticas.php");
require_once("servicioDialogo.Negocio/BCArchivo.php");
require_once("servicioDialogo.Negocio/sesion/BC_Sesion.php");
require_once("servicioDialogo.Datos/sesion/Sesion.php");
require_once("servicioDialogo.Datos/Usuario.php");
require_once('servicioDialogo.Datos/Nota.php');
require_once('servicioDialogo.Negocio/BCAdministracion.php');





$namespace = "http://dialogo/servicioDialogo/servicioDialogo.php";
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
//$server->configureWSDL("servicioDialogo", $namespace);
$server->configureWSDL("Class%20ServicioDialogo");

$server->soap_defencoding = 'UTF-8';

$server->wsdl->schemaTargetNamespace = $namespace;
// Register the method to expose


$server->register("ServicioDialogo.registrarUsuario", // method name
        array("usuario" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#registrarUsuario", // soapaction
        "rpc", // style
        "encoded", // use
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.iniciarSesion", // method name
        array("usuario" => "xsd:string", "password" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#iniciarSesion", // soapaction
        "rpc", // style
        "encoded", // use
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.obtenerSesion", // method name
        array("usuario" => "xsd:string", "idsesion" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#obtenerSesion", // soapaction
        "rpc", // style
        "encoded", // use
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarAlertas", // method name
        array("sesion" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style
        "encoded", // use
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarEncabezadosDialogo", // method name
        array("sesion" => "xsd:string", "pagina" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.obtenerDialogoDetallado", // method name
        array("sesion" => "xsd:string", "iddialogo" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.obtenerMovidasDialogo", // method name
        array("sesion" => "xsd:string", "iddialogo" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.guardarNota", // method name
        array("sesionactual" => "xsd:string", "nota" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.eliminarNota", // method name
        array("sesionactual" => "xsd:string", "nota" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.agregarMarcador", // method name
        array("sesion" => "xsd:string", "marcador" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.guardarCorreccion", // method name
        array("sesion" => "xsd:string", "intervencion" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.publicarIntervencion", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:string", "intervencion" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.guardarActaDialogo", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:string", "intervencion" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarTodasLasActas", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.obtenerEstadisticas", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarCategoriasMovida", // method name
        array("sesion" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.crearDialogo", // method name
        array("sesion" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarReglasDisponibles", // method name
        array("sesion" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.obtenerArchivo", // method name
        array("sesion" => "xsd:string", "archivo" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.publicarDialogo", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:string"), // input parameters
        array("return" => "xsd:string"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.eliminarDialogo", // method name
        array("iddialogo" => "xsd:int"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.listarMarcadores", // method name
        array("sesion" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.buscarIntervencion", // method name
        array("sesion" => "xsd:string", "nombreUsuario" => "xsd:string"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.guardarConfiguracionDialogo", // method name
        array("sesion" => "xsd:string", "dialogo" => "xsd:Array"), // input parameters
        array("return" => "xsd:Array"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);
$server->register("ServicioDialogo.guardarRegla", // method name
        array("sesion" => "xsd:string", "reglas" => "xsd:Array"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.guardarPerfilMovida", // method name
        array("sesion" => "xsd:string", "categoria" => "xsd:Array"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.insertarMovidaCrearDialogo", // method name
        array("idcategoria" => "xsd:string", "idmovida" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);


$server->register("ServicioDialogo.obtenerMovidaCrearDialogo", // method name
        array("idcategoria" => "xsd:string"), // input parameters
        array("return" => "xsd:int"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.recuperarContrasena", // method name
        array("usuario" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);

$server->register("ServicioDialogo.actualizarUsuario", // method name
        array("usuario" => "xsd:string"), // input parameters
        array("return" => "xsd:bool"), // output parameters
        $namespace, // namespace
        false, //"urn:servicioDialogo#listarAlertas", // soapaction
        "rpc", // style. rpc or document
        "encoded", // use. encoded or literal.
        "", // documentation
        "http://schemas.xmlsoap.org/soap/encoding/" //encoding scheme.
);



class ServicioDialogo{

    /**
     *Actualiza los datos del usuario ingresado.
     * @param Usuario $usuario 
     */
    function actualizarUsuario($usuario){
        $user = json_decode(utf8_encode($usuario));
//        $usuario = new Usuario();
//        $usuario->email = $user->email;
//        $usuario->nombreCompleto = $user->nombreCompleto;
//        $usuario->nombreUsuario = $user->nombreUsuario;
//        $usuario->Password = $user->Password;
//        print_r($user);
        $_ret = false;
        
        $bcu = new BCUsuario();
        $_ret = $bcu->modificarUsuario($user);
        
//        echo json_encode($_ret);
        
        return $_ret;
        
    }
    
    /**
     *Recupera la contraseña del usuario identificado por $correo.
     * @param string $correo Correo electrónico de quien pertenece la contraseña.
     */
    function recuperarContrasena($usr){
        $_ret = false;
        
        $usuario = new BCUsuario();
        $_ret = $usuario->recuperarContrasena($usr);
        
//        echo json_encode($_ret);
        return json_encode($_ret);
    }
    /**
     * obtiene la movida predeterminada para la creación del diálogo para la categoria señalada.
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    function obtenerMovidaCrearDialogo($idCategoria){
        $_ret = 0;
        
        $adm = new BCAdministracion();
        $_ret = $adm->obtenerMovidaCrearDialogo($idCategoria);
        
        return $_ret;
        
    }
    
    /**
     * inserta en la categoria señalada, la movida seleccionada como
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    function insertarMovidaCrearDialogo($idCategoria, $idMovida){
        $_ret = false;
        
        $adm = new BCAdministracion();
        $_ret = $adm->insertarMovidaCrearDialogo($idCategoria, $idMovida);
        
        return $_ret;
        
    }
    
    
    /**
     * Guarda un perfil de movidas, y/o las movidas asociadas a este.
     * @param Sesion $sesion Sesión de administrador asignada por el sistema.
     * @param CategoriaMovida $categoria Perfil de movidas a guardar/modificar
     * @return bool Verdadero si se guardó exitosamente, falso en caso contrario.
     */
    function guardarPerfilMovida($sesion, $categoria) {
        $sesion = json_decode($sesion);
        $usr = new Usuario();
        $usr->Rol = $sesion->usuario->Rol;
        $usr->nombreUsuario = $sesion->usuario->nombreUsuario;
        $sesion->usuario = $usr;

        $cat = new CategoriaMovida();

        $cat->idCategoria = json_decode(utf8_encode($categoria["idCategoria"]));
        $cat->descripcion = json_decode(utf8_encode($categoria["descripcion"]));
        $cat->nombre = json_decode(utf8_encode($categoria["nombre"]));


//        print_r($categoria);
//        $mov = new Movida();
//        echo count($categoria["movidas"]["Movida"]);

        if (isset($categoria["movidas"]["Movida"])) {
            if (!isset($categoria["movidas"]["Movida"][0])) {
                $cat->movidas[0]->IdMovida = json_decode(utf8_encode($categoria["movidas"]["Movida"]["IdMovida"]));
                $cat->movidas[0]->Nombre = json_decode(utf8_encode($categoria["movidas"]["Movida"]["Nombre"]));
                $cat->movidas[0]->descripcion = json_decode(utf8_encode($categoria["movidas"]["Movida"]["descripcion"]));
                $cat->movidas[0]->eje = json_decode(utf8_encode($categoria["movidas"]["Movida"]["eje"]));
            } else {
                for ($i = 0; $i < count($categoria["movidas"]["Movida"]); $i++) {
                    $cat->movidas[$i]->IdMovida = json_decode(utf8_encode($categoria["movidas"]["Movida"][$i]["IdMovida"]));
                    $cat->movidas[$i]->Nombre = json_decode(utf8_encode($categoria["movidas"]["Movida"][$i]["Nombre"]));
                    $cat->movidas[$i]->descripcion = json_decode(utf8_encode($categoria["movidas"]["Movida"][$i]["descripcion"]));
                    $cat->movidas[$i]->eje = json_decode(utf8_encode($categoria["movidas"]["Movida"][$i]["eje"]));
                }
            }
        } else {
            $cat->movidas = array();
        }
        $categoria = $cat;

//        echo $categoria->idCategoria;
//        print_r($cat);

        $_controlador = new BCAdministracion();
        $_retorno = $_controlador->guardarPerfilMovidas($sesion, $categoria);

//        print_r($_retorno);
        return $_retorno;
    }

    /**
     * Guarda o actualiza una regla determinada. Esta función solo atiende a peticiones con sesión de administrador.
     * @param Sesion $sesion Sesión de administrador asignada por el sistema.
     * @param Regla[] $regla Colección de objetos regla a guardar.
     * @return bool Verdadero su la regla fue guardada exitosamente.
     */
    function guardarRegla($sesion, $reglas) {
        $sesion = json_decode(utf8_encode($sesion));

        $_usr = new Usuario();
        $_usr->nombreUsuario = $sesion->usuario->nombreUsuario;
        $_usr->Rol = $sesion->usuario->Rol;
        $sesion->usuario = $_usr;
        
        
        $rules = array();
        if (count($reglas["string"]) > 1)
            for ($i = 0; $i < count($reglas["string"]); $i++) {
                array_push($rules, json_decode(utf8_encode($reglas["string"][$i])));
            }
        else
            array_push($rules, json_decode(utf8_encode($reglas["string"])));



        $_controlador = new BCAdministracion();
        $_retorno = $_controlador->guardarReglas($sesion, $rules);
        return $_retorno;
    }

    //NOTA: Sólo se guardan las reglas.
    /**
     * Guarda las configuraciones realizadas a la configuración del diálogo.
     * Configuraciones permitidas:
     * - Reglas
     * - Balances
     * - Restricciones
     * - Facilitador
     * @param Sesion $sesion sesión asignada por el sistema
     * @param Dialogo $dialogo Diálogo con las configuraciones modificadas.
     * @return Object Arreglo de booleanos para cada elemento de la config. a guardar.
     */
    function guardarConfiguracionDialogo($sesion, $dialogo) {
        $sesion = json_decode(utf8_encode($sesion));
        $dialogo = json_decode(utf8_encode($dialogo));

//        print_r($dialogo);
//        $_ret = false;
        try {
            $_negocio = new BCDialogo();
            $_ret = $_negocio->actualizarConfiguracionDialogo($sesion, $dialogo);
        } catch (Exception $e) {
            return false;
        }

        return $_ret;
    }

    /**
     * Busca las intervenciones realizadas por el usuario indicado.
     * @param Sesion $sesion
     * @param string $nombreUsuario 
     */
    function buscarIntervencion($sesion, $nombreUsuario) {
        $sesion = json_decode(utf8_encode($sesion));
        $nombreUsuario = json_decode(utf8_encode($nombreUsuario));

        $_retorno = array();
        $_negocio = new BCIntervencion();

        $_retorno = $_negocio->buscarIntervenciones($sesion, $nombreUsuario);

        if ($_retorno != null)
            array_push($_retorno, null);
        else
            $_retorno = array();

        //echo json_encode($_retorno);
        return $_retorno;
    }

    /**
     * Lista los marcadores ingresados en el sistema, del usuario que inición la sesión.
     * @param Sesion $sesion 
     */
    function listarMarcadores($sesion) {
        $sesion = json_decode(utf8_encode($sesion));

        $_retorno = array();
        $_negocio = new BCMarcador();
        $_retorno = $_negocio->listarMarcadores($sesion);


        if ($_retorno != null) {
            array_push($_retorno, null);
        }else
            $_retorno = array();


        return $_retorno;
    }

    /**
     * Inserta un nuevo diálogo en el sistema.
     * @param Sesion $sesion Sesión del sistema.
     * @param Dialogo $dialogo Objeto con la configuración del diálogo.
     */
    function publicarDialogo($sesion, $dialogo) {

        $dialogo = json_decode(utf8_encode($dialogo));
        $sesion = json_decode(utf8_encode($sesion));
        $_mensajeError = "";

        //echo $dialogo->intervenciones[0]->tipoMovida->IdMovida;
        $_retorno = false;
        try {
            $_negocio = new BCDialogo();

            $_retorno = $_negocio->publicarDialogo($sesion, $dialogo, $_mensajeError);
        } catch (Exception $e) {
            $_mensajeError = "Ocurrió un error inesperado. Inténtelo otra vez.";
        }

        //echo $_mensajeError;
        $_ret = array();
        $_ret[0] = $_retorno;
        $_ret[1] = $_mensajeError;
        return json_encode($_ret);
    }

    function eliminarDialogo($idDialogo){
        $idDialogo = json_decode($idDialogo);
        try {
            $_negocio = new BCDialogo();
            $_retorno = $_negocio->eliminarDialogo($idDialogo);

            return json_encode($_retorno);
        } catch (Exception $e) {
            $_mensajeError = "Ocurrió un error inesperado. Inténtelo otra vez.";
        }

        return json_encode("Volví con error =(");
    }

    /**
     * Obtiene el archivo indicado.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param string $nombreArchivo Nombre del archivo.
     * @return string String que es la ubicación de la imagen de usuario.
     */
    function obtenerArchivo($sesion, $nombreArchivo) {
        $sesion = json_decode($sesion);
        $nombreArchivo = json_decode(utf8_encode($nombreArchivo));


        try {
            $_controlador = new BCArchivo();
            $_retorno = $_controlador->obtenerArchivo($sesion, $nombreArchivo);
            //echo $_retorno;
            return json_encode($_retorno);
        } catch (Exception $e) {
            return json_encode($GLOBALS["image_from_page"] . $GLOBALS["default_user_image"]);
        }
        return json_encode($GLOBALS["image_from_page"] . $GLOBALS["default_user_image"]);
    }

    /**
     * Lista las reglas disponibles para la creación de diálogos.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @return Regla[] Arreglo con las reglas disponibles.
     */
    function listarReglasDisponibles($sesion) {
        $sesion = json_decode(utf8_encode($sesion));

        $_retorno = array();
        $_controlador = new BCRegla();
        $_retorno = $_controlador->listarReglasDisponibles($sesion);

        if ($_retorno != null)
            array_push($_retorno, null);
        else
            $_retorno = array();
        return $_retorno;
    }

    /**
     * Crea un objeto de diálogo con su configuración inicial.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @return Dialogo Objeto Dialogo con valores iniciales.
     */
    function crearDialogo($sesion) {
        $sesion = json_decode(utf8_encode($sesion));


        $_retorno = new Dialogo();
        $_nuevaIntervencion = new Intervencion();

        $_retorno->intervenciones[0] = $_nuevaIntervencion;

        $_retorno->Reglas = array();

        $_retorno->usuariosPermitidos = array();

        $_retorno->balanceDialogo = array();

        $_retorno->usuarioCreador = $sesion->usuario;



        $_retorno = json_encode($_retorno);

//        $_retorno->balanceDialogo = null;
//        $_retorno->Reglas = null;
//        $_retorno->usuariosPermitidos = null;


        return $_retorno;
    }

    /**
     * Busca las categorías disponibles en el sistema
     * @param Sesion $sesion Sesión del sistema.
     * @return CategoriaMovida[] Colección de categorías de movidas disponibles en el sistema, con su detalle.
     */
    function listarCategoriasMovida($sesion) {
        $sesion = json_decode(utf8_encode($sesion));

        $_retorno = array();
        try {
            $_controlador = new BCMovida();
            $_retorno = $_controlador->listarCategoriasMovida($sesion);
        } catch (Exception $e) {
            
        }


        for ($i = 0; $i < count($_retorno); $i++) {
            if ($_retorno[$i]->movidas != null) {
                if (count($_retorno[$i]->movidas) > 0)
                    array_push($_retorno[$i]->movidas, null);
            }
            else
                $_retorno[$i]->movidas = array();
        }

        if (count($_retorno) > 0)
            array_push($_retorno, null);
        else
            $_retorno = array();

        //echo json_encode($_retorno);
        return $_retorno;
    }

    /**
     * Obtiene estadísticas para el diálogo indicado.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Dialogo $dialogo Objeto Dialogo. Importa su identificador.
     * @return Colección de tablas con las estadísticas a mostrar.
     */
    function obtenerEstadisticas($sesion, $dialogo) {
        $sesion = json_decode(utf8_encode($sesion));
        $dialogo = json_decode(utf8_encode($dialogo));

        $_negocio = new BCEstadisticas();
        $_retorno = $_negocio->obtenerEstadisticas($sesion, $dialogo);

//        print_r($_retorno);
        $_retorno[count($_retorno)] = null;
        return $_retorno;
//        return null;
    }

    /**
     * Obtiene una colección de actas para el diálogo indicado
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Dialogo $dialogo Objeto de diálogo con ID.
     * @return Acta[]
     */
    function listarTodasLasActas($sesion, $dialogo) {
        $sesion = json_decode(utf8_encode($sesion));
        $dialogo = json_decode(utf8_encode($dialogo));

        $_retorno = array();
        $_negocio = new BCActa();
        $_retorno = $_negocio->obtenerActasDialogo($sesion, $dialogo);

        if (count($_retorno) > 0)
            $_retorno[count($_retorno)] = null;
        else
            $_retorno = array();

        return $_retorno;
    }

    /**
     * Guarda el acta indicada
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Dialogo $dialogo Objetdo diálogo con el acta como contenido.
     */
    function guardarActaDialogo($sesion, $dialogo) {
        $sesion = json_decode(utf8_encode($sesion));
        $dialogo = json_decode(utf8_encode($dialogo));

        $_retorno = false;
        $_negocio = new BCActa();
        $_retorno = $_negocio->guardarActaDialogo($sesion, $dialogo);

        return $_retorno;
    }

    /**
     * Publica una intervencion. Invoca la lógica del desbalance.
     * @param Sesion $sesion Sesión del sistema
     * @param Dialogo $dialogo Diálogo al que pertenece la intervención.
     * @param Intervencion $intervencion Objeto de intervención.
     * @return bool Verdadero si la inserción fue exitosa.
     */
    function publicarIntervencion($sesion, $dialogo, $intervencion) {

        $sesion = json_decode(utf8_encode($sesion));
        $dialogo = json_decode(utf8_encode($dialogo));
        $intervencion = json_decode(utf8_encode($intervencion));

        $_ret = false;
        $_controlador = new BCIntervencion();
        $_ret = $_controlador->publicarIntervencion($sesion, $dialogo, $intervencion);

        return $_ret;
    }

    /**
     * Guarda una sugerencia de corrección. Si es facilitador entonces cambia el tipo de movida.
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Intervencion $intervencion Intervencion con ID, y con movidaCorregida como mínimo.
     */
    function guardarCorreccion($sesion, $intervencion) {
        //echo $intervencion;

        $ses = json_decode(utf8_encode($sesion));
        $int = json_decode(utf8_encode($intervencion));

        $sesion = new Sesion();
        $sesion->creacion = $ses->creacion;
        $sesion->expiracion = $ses->expiracion;
        $sesion->idSesion = $ses->idSesion;
        $sesion->usuario = new Usuario();
        $sesion->usuario->Rol = $ses->usuario->Rol;
        $sesion->usuario->nombreUsuario = $ses->usuario->nombreUsuario;

        $intervencion = new Intervencion();
        $intervencion->idDialogo = $int->idDialogo;
        $intervencion->idIntervencion = $int->idIntervencion;
        $intervencion->correccionMovida[0] = new MovidaCorregida();
        $intervencion->correccionMovida[0] = $int->correccionMovida[0];

        $intervencion->usuarioCreador = new Usuario();
        $intervencion->usuarioCreador->Rol = $int->usuarioCreador->Rol;
        $intervencion->usuarioCreador->nombreUsuario = $int->usuarioCreador->nombreUsuario;



        $_retorno = false;
        $_negocio = new BCIntervencion();
        $_retorno = $_negocio->guardarCorreccion($sesion, $intervencion);
        return $_retorno;
    }

    /**
     * Agrega al sistema el marcador indicado. Si no existe.
     * @param Sesion $sesion
     * @param Marcador $marcador 
     * @return bool Verdadero si se guarda con éxito.
     */
    function agregarMarcador($sesion, $marcador) {
        $sesion = json_decode(utf8_encode($sesion));
        $marcador = json_decode(utf8_encode($marcador));

        $_retorno = false;
        $_negocio = new BCMarcador();
        $_retorno = $_negocio->agregarMarcador($sesion, $marcador);

        return $_retorno;
    }

    /**
     * Elimina la nota indicada
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Nota $nota Objeto Nota a eliminar.
     */
    function eliminarNota($sesion, $nota) {
        $sesion = json_decode(utf8_encode($sesion));
        $nta = json_decode(utf8_encode($nota));

        $nota = new Nota();
        $nota->IdNota = $nta->IdNota;

        $_retorno = false;
        $_negocio = new BCNota();
        $_retorno = $_negocio->eliminarNota($sesion, $nota);

        return $_retorno;
    }

    /**
     * Crea o modifica la nota indicada.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Nota $nota Objeto Nota a guardar.
     */
    function guardarNota($sesion, $nota) {
        //echo $nota;
        $ses = json_decode(utf8_encode($sesion));
        $nta = json_decode(utf8_encode($nota));

        $sesion = new Sesion();
        $sesion->idSesion = $ses->idSesion;
        $sesion->usuario->nombreUsuario = $ses->usuario->nombreUsuario;
        $sesion->usuario->Rol = $ses->usuario->Rol;


        $nota = new Nota();
        $nota->IdNota = $nta->IdNota;
        $nota->Texto = $nta->Texto;
        $nota->Autor->nombreUsuario = $nta->Autor->nombreUsuario;
        $nota->intervencionPadre->idIntervencion = $nta->intervencionPadre->idIntervencion;

        //bool
        $_retorno = false;
        $_negocio = new BCNota();
        $_retorno = $_negocio->guardarNota($sesion, $nota);

        return $_retorno;
    }

    /**
     * Obtiene una lista de las movidas poribles a realizar en un diálogo
     * @param Sesion $sesion identificador de sesión
     * @param int $idDialogo identificador del diálogo
     * @return 
     */
    function obtenerMovidasDialogo($sesion, $idDialogo) {
        $idDialogo = json_decode(utf8_encode($idDialogo));
        $ses = json_decode(utf8_encode($sesion));

        $sesion = new Sesion();
        $sesion->creacion = $ses->creacion;
        $sesion->expiracion = $ses->expiracion;
        $sesion->idSesion = $ses->idSesion;
        $sesion->usuario = new Usuario();
        $sesion->usuario->Rol = $ses->usuario->Rol;
        $sesion->usuario->nombreUsuario = $ses->usuario->nombreUsuario;

        $_controlador = new BCMovida();
        $_retorno = $_controlador->listarMovidasPosibles($sesion, $idDialogo);

        //Bug en PHP o NuSOAP que se presenta al momento de retornar/codificar en JSON un arreglo.
        if (count($_retorno) > 0)
            $_retorno[count($_retorno)] = null;
        else
            $_retorno = array();

        return $_retorno;
    }

    /**
     * Obtiene un objeto dialogo completo.
     * @param Sesion $sesion Sesion del sistema.
     * @param int $idDialogo 
     */
    function obtenerDialogoDetallado($sesion, $idDialogo) {
        $idDialogo = json_decode(utf8_encode($idDialogo));
        $ses = json_decode(utf8_encode($sesion));
        $sesion = new Sesion();
        $sesion->creacion = $ses->creacion;
        $sesion->expiracion = $ses->expiracion;
        $sesion->idSesion = $ses->idSesion;
        $sesion->usuario = new Usuario();
        $sesion->usuario->Rol = $ses->usuario->Rol;
        $sesion->usuario->email = $ses->usuario->email;
        $sesion->usuario->imagen = $ses->usuario->imagen;
        $sesion->usuario->Password = $ses->usuario->Password;
        $sesion->usuario->nombreUsuario = $ses->usuario->nombreUsuario;



        $_controlador = new BCDialogo();
        $_retorno = new Dialogo();
        $_retorno = $_controlador->obtenerDialogoDetallado($sesion, $idDialogo);



        //echo json_encode(array_pop($_retorno->categoria->movidas));
        //Por un motivo de BUG de PHP, agregando un elemento NULL al arreglo de movidas,
        //se soluciona el problema que se presenta con PHP 5, NuSOAP y/o Javascript SOAPClient.
        $_retorno->categoria->movidas[count($_retorno->categoria->movidas)] = null;
        $_retorno->intervenciones[count($_retorno->intervenciones)] = null;


        //echo count($_retorno->intervenciones);
        for ($i = 0; $i < count($_retorno->intervenciones) - 1; $i++) {
            if (count($_retorno->intervenciones[$i]->Notas) > 0)
                $_retorno->intervenciones[$i]->Notas[count($_retorno->intervenciones[$i]->Notas)] = null;
            else
                $_retorno->intervenciones[$i]->Notas = array();
        }

        for ($i = 0; $i < count($_retorno->intervenciones) - 1; $i++) {
            if (count($_retorno->intervenciones[$i]->correccionMovida) > 0)
                $_retorno->intervenciones[$i]->correccionMovida[count($_retorno->intervenciones[$i]->correccionMovida)] = null;
            else
                $_retorno->intervenciones[$i]->correccionMovida = array();
        }

        if (count($_retorno->Reglas) > 0)
            $_retorno->Reglas[count($_retorno->Reglas)] = null;
        else {
            $_retorno->Reglas = array();
            //$_retorno->Reglas[0] = null;
        }

        if (count($_retorno->balanceDialogo) > 0)
            $_retorno->balanceDialogo[count($_retorno->balanceDialogo)] = null;
        else {
            $_retorno->balanceDialogo = array();
            //$_retorno->Reglas[0] = null;
        }

        return $_retorno;
    }

    /**
     * Obtiene una lista de todos los encabezados de los dialogos.
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param int $pagina Número de página a obtener.
     * @return int Almacena los diálogos en una variable local a esta clase y retorna la cantidad de encabezados.
     * 
     */
    function listarEncabezadosDialogo($sesion, $pagina) {
        $sesion = json_decode(utf8_encode($sesion));
        $pagina = json_decode(utf8_encode($pagina));
        $_mensajeError = "";
        $_retorno;
        try {
            $_controlador = new BCDialogo();
            $_retorno = $_controlador->listarEncabezadosDialogo($sesion, $pagina, $_mensajeError);
            //echo "END TRY";
        } catch (Exception $e) {
//            $this->_mensajeError = "No se pudo realizar la conexión";
        }

        $ret = Array();
        //echo json_encode($_retorno[0]);
        for ($i = 0; $i < count($_retorno); $i++) {
            $ret[$i] = json_encode($_retorno[$i]);
        }

        $p[] = $ret;
        $p[] = $_mensajeError;
        return $p;
    }

    /**
     * Obtiene una colección de diálogos que están desbalanceados.
     * @param Sesion $sesion Sesión asignada por el sistema
     * @return Dialogo[] Colección de objetos Dialogo desbalanceados. 
     */
    function listarAlertas($sesion) {
        $ses = json_decode(utf8_encode($sesion));
        $sesion = new Sesion();
        $sesion->MensajeError = $ses->MensajeError;
        $sesion->creacion = $ses->creacion;
        $sesion->expiracion = $ses->expiracion;
        $sesion->idSesion = $ses->idSesion;
        $sesion->usuario = new Usuario();
        $sesion->usuario->Rol = $ses->usuario->Rol;
        $sesion->usuario->email = $ses->usuario->email;
        $sesion->usuario->nombreUsuario = $ses->usuario->nombreUsuario;

        //Dialogo[]
        $_retorno = Array();
        $_negocio = new BCDialogo();
        $_retorno = $_negocio->listarDialogosConAlerta($sesion);

        $ret = Array();

        for ($i = 0; $i < count($_retorno); $i++) {
            $ret[$i] = json_encode($_retorno[$i]);
        }

        return $ret;
    }

    /**
     * Ingresa un usuario en el sistema
     * @param Usuario $usuario objeto de usuario completo codificado en JSON
     * @return bool Verdadero si se pudo registrar el usuario exitosamente. 
     */
    function registrarUsuario($usuario) {

        $usuario = json_decode(utf8_encode($usuario));

        $user = new Usuario();
        $user->Rol = $usuario->Rol;
        $user->email = $usuario->email;
        $user->Password = $usuario->Password;
        $user->nombreUsuario = $usuario->nombreUsuario;
        $user->nombreCompleto = $usuario->nombreCompleto;

        $user->imagen = $GLOBALS["uploads"] . $user->nombreUsuario;
        //echo $user->imagen;

        $_buss = new BCUsuario();
        $_err = "";
        $_ret = $_buss->registrarUsuario($user, $_err);

        //retorna un arreglo con el valor de verdad en [0]
        //y el mensaje de error en [1]

        return json_encode($_ret);
    }

    /**
     * Inicia la sesión en el sistema, asignando una sesión en el servicio.
     * @param string $usuario Nombre de usuario
     * @param string $password Contraseña de seguridad
     * @return Sesion Una sesión válida o no. 
     */
    function iniciarSesion($usuario, $password) {
        $usuario = json_decode(utf8_encode($usuario));
        $password = json_decode(utf8_encode($password));

        $controladorSesion = new BC_Sesion();
        $retorno = new Sesion();
        try {
            $retorno = $controladorSesion->iniciarSesion($usuario, $password);
        } catch (Exception $e) {
            $retorno->MensajeError = "No se pudo iniciar la sesión";
        }

        $ret = json_encode($retorno);
        //echo $ret;

        return $ret;
    }

    /**
     * Verifica que la sesión está registrada en el sistema
     * @param string $usuario Nombre de usuario para la sesión
     * @param string $idSesion Identificador asignado para la sesión
     * @return string Objeto de sesión válido para uso en el sistema.Objeto JSON.
     */
    function obtenerSesion($usuario, $idSesion) {
        $usuario = json_decode(utf8_encode($usuario));
        $idSesion = json_decode(utf8_encode($idSesion));

        $_retorno = new Sesion();
        try {
            $controladorSesion = new BC_Sesion();
            $_retorno = $controladorSesion->verificarSesion($usuario, $idSesion, false);
        } catch (Exception $e) {
            $_retorno->MensajeError = "La sesión ya expiró";
        }

        return json_encode($_retorno);
    }

}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
$server->service($HTTP_RAW_POST_DATA);
?>