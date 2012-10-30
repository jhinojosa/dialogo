<?php
session_start();

// se cierra la sesion?
if (isset($_REQUEST['logout'])) {
    
    // Se destruyen todas las variables de sesion
    $_SESSION = array();

    // la sesion es destruida!
    session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--[if lt IE 7]> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js"> <!--<![endif]-->

<head>

<title>Sistema para el diálogo remoto</title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Description" />
<meta name="keywords" content="" />
<meta name="robots" content="all" />
<meta name="author" content="Author"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css-->
<link rel="stylesheet/less" type="text/css" href="../estilos/style.less">
<link rel="stylesheet" href="../estilos/css/bootstrap.css" type="text/css" media="screen" />
<!-- /css-->

<!-- modernizr -->
<!--<script type="text/javascript" src="js/modernizr.js"></script>-->
<!-- /modernizr -->

<!--Favicon-->
<link rel="shortcut icon" href="../Favicon/favicon.ico">

<script>
    /**
     * Deshabilita el volver a la ventana anterior al cerrar la aplicación desde el botón.
     */
    if (history.forward(1)){location.replace(history.forward(1))}
</script>
<script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
<script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

<script src="InicioSesion.js" type="text/javascript"></script>
<script src="recuperacionContrasena.js" type="text/javascript"></script>
<script src="Controles/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
<script src="../ClienteDialogo.GUI/datatypes/Usuario.js" type="text/javascript"></script>
<script src="../ClienteDialogo.GUI/datatypes/Sesion.js" type="text/javascript"></script>
<script src="Controladores/CValidacionUsuario.js" type="text/javascript"></script>
<script src="Controladores/ConexionManager.js" type="text/javascript"></script>
<script src="VentanaRegistro.js" type="text/javascript"></script>
</head>

<body>
    <div id = "warning">
        
        <!--[if IE 6]>
        <p>
            La versión de Internet Explorer que est&aacute;s utilizando
            no está actualizada. <br />
            Este sitio funcionar&aacute; mejor si actualizas tu navegador.
            <a href="http://www.microsoft.com/latam/windows/internet-explorer/">Actualizar Internet Explorer</a>
        </p>
        <![endif]-->
        
        <noscript>
            <p>
                Es necesario que tengas activado Javascript en su navegador 
                para utilizar todas las funciones de este sitio.
                <a href="#">
                    &iquest;C&oacute;mo activar Javascript?
                </a>
            </p>
        </noscript>
    </div><!-- #warning -->
    

    <div id="page" class="container">
        
        <div id="header" class="row">

            <!-- logo de la app -->
            <div id="app-logo" class="span2">
                <img src="../estilos/img/html/app-logo.png" alt="" />
            </div>
            <!-- fin logo de la app -->

            <!-- titulo de la app -->
            <div id="app-title" class="span4">
                <h5>Universidad de Santiago de Chile <br>
                    Departamento de Ingeniería Informática</h5>
                <h3>Diálogo Remoto</h3>
            </div>
            <!-- fin titulo de la app -->

            <!-- formulario de inicio de sesión -->
            <div id="top-login" class="span6">
                <form id="login" class="form-inline">
                    <legend>Iniciar Sesión</legend>
                    <div id="top-user">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input id="usuario" type="text" class="input-medium" placeholder="Nombre de Usuario">
                        </div>
                    </div>        
                    <div id="top-password">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input id="contrasegna" type="password" class="input-small" placeholder="Contraseña">
                        </div>
                        <a id="forgotPassword" href="#myModal" role="button" data-toggle="modal">¿Olvido su Contraseña?</a>
                    </div>
                    <a id="ingresar" class="btn btn-primary clearfix">Ingresar</a>
                </form>

                <?php require_once 'recuperacionContrasena.php';?>
                <?php require_once 'Controles/ControlNotificacion/ControlNotificacion.php';?>
            </div>
            <!-- fin de formulario de inicio de sesión -->                           
        </div> <!-- #header -->

    <div id="menu-bar" class="row">
        <div class="span12">
            <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                        <li class="active"><a rel="tooltip" title="first tooltip" href="#"><i class="icon-home"></i> Portada</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a href="../../servicioDialogo/uploads/ayuda/getting_started.doc" target="_blank" ><i class="icon-question-sign"></i> Ayuda</a></li>
                    </ul>
                 </div>
            </div>    
        </div>  
    </div><!-- #menu-bar -->


    <div id="barra-estado" class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li class="active"><i class="icon-home"></i> Portada</li>
            </ul>
        </div> 
    </div> <!-- #barra-estado -->       

    <div class="row" id="content">

        <div id="1st-col-home" class="span6">
            <div class="hero-unit">
                
                <h3>¿Qué es...</h3>
                <h1>Diálogo Remoto?</h1>
                <p><br>Diálogo Remoto es una aplicación de código abierto desarrollada como producto de un proyecto de migración, en el contexto del trabajo de titulación del alumno Cristian Alberto Chávez Ramos, para la carrera de Ingeniería de Ejecución en Computación e Informática de la Universidad de Santiago de Chile.</p>
                <p>
                    <a class="btn btn-info btn-large" href="about.html" target="_blank"> Saber más</a>
                </p>
            </div>
        </div>

        <div id="2nd-col-home" class="span6" >
            <?php require_once 'VentanaRegistro.php';?>
        </div>

    </div><!-- #content -->

        <!-- no agregar nada más, de aquí en adelante va footer.php -->
<?php require_once '../footer.php';?>

        
