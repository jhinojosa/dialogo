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

<script>
            /**
             * Deshabilita el volver a la ventana anterior al cerrar la aplicación desde el botón.
             */
            if (history.forward(1)){location.replace(history.forward(1))}    
</script>

<!-- css-->
<link rel="stylesheet/less" type="text/css" href="../estilos/style.less">
<link rel="stylesheet" href="../estilos/css/bootstrap.css" type="text/css" media="screen" />
<!-- /css-->
<script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
<script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
<script src="../Javascript/jQuery/valums-file-uploader-cf7bfb1/client/fileuploader.js" type="text/javascript"></script>
<script src="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.js"></script>

<script src="Controls/controlListaDialogos.js" type="text/javascript"></script>
<script src="Controls/DatosUsuario.js" type="text/javascript"></script>
<script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>

<!-- 
Problema: scripts necesarios para nuevo dialogo, pero interfieren en la ventana de dialogos disponibles

<script src="Controls/controlEscrituraIntervencion.js" type="text/javascript"></script>
<script src="VentanaNuevoDialogo.js" type="text/javascript"></script>

#Problema -->

<script src="VentanaPrincipal.js" type="text/javascript"></script>
<script src="datatypes/Usuario.js" type="text/javascript"></script>
<script src="datatypes/Sesion.js" type="text/javascript"></script>
<script src="datatypes/Intervencion.js" type="text/javascript"></script>
<script src="datatypes/Dialogo.js" type="text/javascript"></script>
<script src="datatypes/Acta.js" type="text/javascript"></script>
<script src="datatypes/Movida.js" type="text/javascript"></script>
<script src="datatypes/Balance.js" type="text/javascript"></script>
<script src="datatypes/Regla.js" type="text/javascript"></script>
<script src="Controladores/CSesion.js" type="text/javascript"></script>
<script src="Controladores/CDialogo.js" type="text/javascript"></script>
<script src="Controladores/ConexionManager.js" type="text/javascript"></script>
<script src="Controladores/CValidacionUsuario.js" type="text/javascript"></script>

<script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js"></script>
<!-- modernizr -->
<!--<script type="text/javascript" src="js/modernizr.js"></script>-->
<!-- /modernizr -->

</head>
<body onload="document.getElementById('cargando').style.display='none';">
    <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>
    <?php
        $usuario = htmlspecialchars($_GET['usuario']);
        $idsesion = htmlspecialchars($_GET['idsesion']);

        echo "<input type=\"hidden\" id=\"usuarioM\" value=\"$usuario\">";
        echo "<input type=\"hidden\" id=\"idsesion\" value=\"$idsesion\">";
    ?> 

    <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
    ?>

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

            <div id="app-logo" class="span2">
                <img src="../estilos/img/html/app-logo.png" alt="" />
            </div><!-- #app-logo -->

            <div id="app-title" class="span4">
                <h5>Universidad de Santiago de Chile <br>
                    Departamento de Ingeniería Informática</h5>
                <h3>Diálogo Remoto</h3>
            </div><!-- #app-title -->

            <div id="user-panel" class="span6">
                <div id="user-img">
                    <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( "camilo.farfan@usach.cl" ) ) );?>=100" class="img-polaroid">    
                </div><!-- #user-img -->

                <div id="user-options">
                    <h4>Hola Camilo!</h4>
                    <div class="btn-group">
                      <button id="btnAdministrar" class="btn btn-small"><i class="icon-wrench"></i> Administrar</button>
                      <button id="username" class="btn btn-small"><i class="icon-pencil"></i> Editar Perfil</button>
                      <button id="btnCerrarSesion" class="btn btn-small"><i class="icon-off"></i> Cerrar Sesión</button>
                    </div>    
                </div><!-- #user-options -->
                <div class="clearfix"></div>
            </div><!-- #user-panel -->                          
        </div><!-- #header -->