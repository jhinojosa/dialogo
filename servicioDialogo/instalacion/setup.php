<?php

include 'install.config.php';
    
date_default_timezone_set($GLOBALS["default_time_zone"]);


///**
// * Ubicación dentro del servidor, del archivo dialogo_archivos.sqlite 
// */
//$dialogo_archivos_sqlite = "dialogo_archivos.sqlite";
//
///**
// * Nombre de archivo de base de datos sqlite que almacena la configuración de conexión. 
// */
//$dialogo_configbd_sqlite = "dialogo_configbd.sqlite";
///**
// * Ubicación dentro del servidor, de los archivos sqlite. 
// */
//$dir_archivos_sqlite = "../sqlite_files/";
///**
// * dirección a la que se accede desde la página web a las imágenes de avatar de usuario. 
// */
//$from_page_location = "../../servicioDialogo/";
///**
// * Ubicación dentro del servidor de las imagenes de avatar de usuario. 
// */
//$default_user_image = "uploads/default/default.jpg";


require_once '../servicioDialogo.DAC/ConnectionManager.php';
require_once '../servicioDialogo.Datos/Usuario.php';
require_once '../servicioDialogo.DAC/UsuarioDAC.php';
require_once '../servicioDialogo.DAC/CategoriaMovidaDAC.php';
require_once '../servicioDialogo.DAC/CategoriaMovidaDAC.php';
require_once '../servicioDialogo.DAC/MovidaDAC.php';


$servidor = $_POST["servidor"];
$puerto = $_POST["puerto"];
$basededatos = $_POST["basededatos"];
$usuario = $_POST["usuario"];
$contrasegna = $_POST["contrasegna"];

$stp = new Setup($servidor, $puerto, $basededatos, $usuario, $contrasegna);

class Setup {

    private $server;
    private $port;
    private $database;
    private $user;
    private $password;
    public $mensajeNotificacion;

    public function __construct($servidor, $puerto, $basededatos, $usuario, $contrasegna) {
        $this->mensajeNotificacion = "";
        $this->server = $servidor;
        $this->port = $puerto;
        $this->database = $basededatos;
        $this->user = $usuario;
        $this->password = $contrasegna;
        $this->configurarBd();
    }

    public function configurarBd() {


        try {
            $_cadena = "host=" . $this->server . " ";
            $_cadena.= "port=" . $this->port . " ";
            $_cadena.= "user=" . $this->user . " ";
            $_cadena.= "password=" . $this->password . " ";
            $_cadena.= "dbname=" . $this->database . " ";

            $testconn = @pg_connect($_cadena);
            if (!$testconn) {
                echo "No se puede establecer la conexión con los datos ingresados.";
                return;
            }
            @pg_close($testconn);

            ConnectionManager::configurarBaseDatos("postgresql", $this->server, $this->port, $this->database, $this->user, $this->password);

            $this->instalarDatosBase();

            
        } catch (Exception $e) {
            echo "No se pudo crear la configuración de la base de datos";
        }
    }

    public function instalarDatosBase() {

        $admin = new Usuario();
        $admin->nombreUsuario = "administrador";
        $admin->Password = "administrador";
        $admin->Password = $admin->hashPassword();
        $admin->imagen = $GLOBALS["default_user_image"];
        $admin->email = "juan.gonzaleztog@usach.com";
        $admin->Rol = $admin->ROL_ADMINISTRADOR;

        $usuDac = new UsuarioDAC();

//        if ($usuDac->obtenerUsuario($admin->nombreUsuario, false) == null)
            if(!$usuDac->insertarUsuario($admin)){
                echo "Los datos ya existen o hubo un problema durante su inserción.";
                return;
            }

        $admin = new Usuario();
        $admin->nombreUsuario = "admin";
        $admin->Password = "admin";
        $admin->Password = $admin->hashPassword();
        $admin->imagen = $GLOBALS["default_user_image"];
        $admin->email = "cristian.chavezr@yahoo.es";
        $admin->Rol = $admin->ROL_ADMINISTRADOR;

        $usuDac = new UsuarioDAC();

//        if ($usuDac->obtenerUsuario($admin->nombreUsuario, false) == null)
            if(!$usuDac->insertarUsuario($admin)){
                echo "Los datos ya existen o hubo un problema durante su inserción.";
                return;
            }



        $cmDac = new CategoriaMovidaDAC();
        $cat1 = new CategoriaMovida();
        $movDac = new MovidaDAC();

        $cat1->autor = new Usuario();
        $cat1->nombre = "Kantor-Isaacs";
        $cat1->descripcion = "Perfil de movidas creado en 1995";

        $cmDac->insertarCategoria($cat1); {
            $mov11 = new Movida();
            $mov11->autor = $admin;
            $mov11->Nombre = "Mover";
            $mov11->descripcion = "Iniciar una idea y ofrecer una dirección para la conversación.";
            $mov11->eje = intval($mov11->Eje->DarseAEntender);
            $movDac->insertarMovida($mov11);
            $movDac->asociarCategorias($cat1, $mov11);
        } {
            $mov12 = new Movida();
            $mov12->autor = $admin;
            $mov12->Nombre = "Oponer";
            $mov12->descripcion = "Desafiar lo que se está diciendo y cuestionar su validez.";
            $mov12->eje = intval($mov12->Eje->DarseAEntender);
            $movDac->insertarMovida($mov12);
            $movDac->asociarCategorias($cat1, $mov12);
        } {
            $mov13 = new Movida();
            $mov13->autor = $admin;
            $mov13->Nombre = "Seguir";
            $mov13->descripcion = "Completar lo que se ha dicho. Ayuda a otros a clarificar sus 
                pensamientos y apoyar lo que se está exponiendo.";
            $mov13->eje = intval($mov13->Eje->BuscarEntender);
            $movDac->insertarMovida($mov13);
            $movDac->asociarCategorias($cat1, $mov13);
        } {
            $mov14 = new Movida();
            $mov14->autor = $admin;
            $mov14->Nombre = "Dar perspectiva";
            $mov14->descripcion = "Informar sobre lo que sucede en el diálogo y proporcionar un punto de vivsta sobre el ello.";
            $mov14->eje = intval($mov14->Eje->BuscarEntender);
            $movDac->insertarMovida($mov14);
            $movDac->asociarCategorias($cat1, $mov14);
        }

        $cat2 = new CategoriaMovida();
        $cat2->nombre = "Clark";
        $cat2->descripcion = "Perfil de movidas creado en 2007";
        $cat2->autor = new Usuario();
        $cmDac->insertarCategoria($cat2);
        //recuperar el id de la categoria e insertarlo en el objeto.
        {
            $mov21 = new Movida();
            $mov21->autor = $admin;
            $mov21->Nombre = "Mover";
            $mov21->descripcion = "Comentario semilla o aseveración realizada.";
            $mov21->eje = intval($mov21->Eje->DarseAEntender);
            $movDac->insertarMovida($mov21);
            $movDac->asociarCategorias($cat2, $mov21);
        } {
            $mov22 = new Movida();
            $mov22->autor = $admin;
            $mov22->Nombre = "Contramover";
            $mov22->descripcion = "Aseveración diferente a la aseveración semilla pero que 
                no la ataca. Solo se aplica si el comentario no se enfoca en ningún aspecto 
                de la tesis del cometario que replica, en cambio, ofrece una interpretación 
                totalmente nueva del fenómeno.";
            $mov22->eje = intval($mov22->Eje->DarseAEntender);
            $movDac->insertarMovida($mov22);
            $movDac->asociarCategorias($cat2, $mov22);
        } {
            $mov23 = new Movida();
            $mov23->autor = $admin;
            $mov23->Nombre = "Cambiar de movida";
            $mov23->descripcion = "Un comentario que cambia su movida original o cambia su 
                punto de vista o hace una concesión en respuesta a un comentario (movida o 
                refutación) hecha por otro participante.";
            $mov23->eje = intval($mov23->Eje->DarseAEntender);
            $movDac->insertarMovida($mov23);
            $movDac->asociarCategorias($cat2, $mov23);
        } {
            $mov24 = new Movida();
            $mov24->autor = $admin;
            $mov24->Nombre = "Refutar principios";
            $mov24->descripcion = "Ataca o se manifiesta en desacuerdo con los principios (evidencias, 
                explicaciones, calificadores o respaldos), usados por otro participante para justificar
                sus comentarios.";
            $mov24->eje = intval($mov24->Eje->DarseAEntender);
            $movDac->insertarMovida($mov24);
            $movDac->asociarCategorias($cat2, $mov24);
        }{
            $mov25 = new Movida();
            $mov25->autor = $admin;
            $mov25->Nombre = "Refutar tesis";
            $mov25->descripcion = "Ataca o se manifiesta en desacuerdo con la tesis (o una parte en 
                particular de la tesis), de otro participante sin atacar los principios.";
            $mov25->eje = intval($mov25->Eje->DarseAEntender);
            $movDac->insertarMovida($mov25);
            $movDac->asociarCategorias($cat2, $mov25);
        }{
            $mov26 = new Movida();
            $mov26->autor = $admin;
            $mov26->Nombre = "Aclaración a refutación";
            $mov26->descripcion = "Comentarios hechos para fortalecer una posición (en términos de 
                precisión o validez), en respuesta a una refutación sin atacar la refutación o los 
                principios sostenidos por otro participante.";
            $mov26->eje = intval($mov26->Eje->DarseAEntender);
            $movDac->insertarMovida($mov26);
            $movDac->asociarCategorias($cat2, $mov26);
        }{
            $mov27 = new Movida();
            $mov27->autor = $admin;
            $mov27->Nombre = "Apoyar comentario";
            $mov27->descripcion = "Comentario usado para apoyar la veracidad o precisión de una 
                movida o refutación previamente realizada. Incluye voces de acuerdo con un 
                comentario, reformulaciones de un comentario previo, agregar principios en apoyo, 
                o expande un comentario anterior.";
            $mov27->eje = intval($mov27->Eje->DarseAEntender);
            $movDac->insertarMovida($mov27);
            $movDac->asociarCategorias($cat2, $mov27);
        }{
            $mov28 = new Movida();
            $mov28->autor = $admin;
            $mov28->Nombre = "Consultar significado";
            $mov28->descripcion = "un comentario que pide una clarificación sobre un comentario 
                anterior (por ejemplo: “qué quisiste decir con…” o “no entiendo lo que dices”). 
                Estos comentarios cuestionan el significado de un comentario y no su precisión.";
            $mov28->eje = intval($mov28->Eje->BuscarEntender);
            $movDac->insertarMovida($mov28);
            $movDac->asociarCategorias($cat2, $mov28);
        }{
            $mov29 = new Movida();
            $mov29->autor = $admin;
            $mov29->Nombre = "Aclarar significados";
            $mov29->descripcion = "Un comentario que pide una clarificación sobre un comentario 
                anterior (por ejemplo: “qué quisiste decir con…” o “no entiendo lo que dices”). 
                Estos comentarios cuestionan el significado de un comentario y no su precisión.";
            $mov29->eje = intval($mov29->Eje->DarseAEntender);
            $movDac->insertarMovida($mov29);
            $movDac->asociarCategorias($cat2, $mov29);
        }{
            $mov230 = new Movida();
            $mov230->autor = $admin;
            $mov230->Nombre = "Origanizar participantes";
            $mov230->descripcion = "Un comentario que: recuerda a otros participantes que participen 
                del diálogo, pide a otros por retroalimentación, tiene un aspecto meta-organizacional, 
                o pretende cambiar la forma en que alguien más está participando en el diálogo.";
            $mov230->eje = intval($mov230->Eje->BuscarEntender);
            $movDac->insertarMovida($mov230);
            $movDac->asociarCategorias($cat2, $mov230);
        }{
            $mov231 = new Movida();
            $mov231->autor = $admin;
            $mov231->Nombre = "Off-task";
            $mov231->descripcion = "Comentarios que no se relacionan con el tópico.";
            $mov231->eje = intval(2);
            $movDac->insertarMovida($mov231);
            $movDac->asociarCategorias($cat2, $mov231);
        }
        
        
        $cat3 = new CategoriaMovida();
        $cat3->nombre = "Burbules";
        $cat3->descripcion = "Perfil de movidas creado en 1999";
        $cat3->autor = new Usuario();
        $cmDac->insertarCategoria($cat3);
        {
            $mov30 = new Movida();
            $mov30->autor = $admin;
            $mov30->Nombre = "Hacer preguntas";
            $mov30->descripcion = "Poner inquietudes hacia los demás. Las preguntas abren o 
                cierran ámbitos de indagación y acción.";
            $mov30->eje = intval($mov30->Eje->BuscarEntender);
            $movDac->insertarMovida($mov30);
            $movDac->asociarCategorias($cat3, $mov30);
        }{
            $mov31 = new Movida();
            $mov31->autor = $admin;
            $mov31->Nombre = "Responder preguntas";
            $mov31->descripcion = "Aclarar a quien consulta, como al resto de los participantes, 
                cual es la respuesta según la propia perspectiva, idealmente describiéndola.";
            $mov31->eje = intval($mov31->Eje->DarseAEntender);
            $movDac->insertarMovida($mov31);
            $movDac->asociarCategorias($cat3, $mov31);
        }{
            $mov32 = new Movida();
            $mov32->autor = $admin;
            $mov32->Nombre = "Hacer enunciados de construcción";
            $mov32->descripcion = "Proponer temas en una dirección de exploración particular.";
            $mov32->eje = intval($mov32->Eje->BuscarEntender);
            $movDac->insertarMovida($mov32);
            $movDac->asociarCategorias($cat3, $mov32);
        }{
            $mov33 = new Movida();
            $mov33->autor = $admin;
            $mov33->Nombre = "Reorientación de la conversación";
            $mov33->descripcion = "Invitar a los demás participantes a llevar el tema en otra dirección.";
            $mov33->eje = intval($mov33->Eje->DarseAEntender);
            $movDac->insertarMovida($mov33);
            $movDac->asociarCategorias($cat3, $mov33);
        }{
            $mov34 = new Movida();
            $mov34->autor = $admin;
            $mov34->Nombre = "Hacer enunciados reguladores";
            $mov34->descripcion = "Realizar intervenciones que permitan encauzar el diálogo, 
                haciendo meta-referencias.";
            $mov34->eje = intval($mov34->Eje->DarseAEntender);
            $movDac->insertarMovida($mov34);
            $movDac->asociarCategorias($cat3, $mov34);
        }
        
        
        
        echo "La instalación se realizó con éxito.";
    }

}

?>
