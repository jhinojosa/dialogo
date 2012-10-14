<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

        <!--Favicon-->
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        <script>
            /**
             * Deshabilita el volver a la ventana anterior al cerrar la aplicación desde el botón.
             */
            if (history.forward(1)){location.replace(history.forward(1))}    
        </script>

        <!--Estilos de 960grid-->
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/reset.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/text.css" type="text/css">

        <!--Hoja de estilos jQueryUI-->
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css">

        <!--Estilo del Menú en CSS -->
        <link rel="stylesheet" href="Menu/css/stylesheet.css" type="text/css">


        <!--Javascript de jQuery-->
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>

        <!--Import de jQuery File Upload plugin-->
        <script src="../Javascript/jQuery/valums-file-uploader-cf7bfb1/client/fileuploader.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/valums-file-uploader-cf7bfb1/client/fileuploader.css" type="text/css"> 

        <!--Import de clases externas-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>


        <!--Code behind de
        InicioSesion.php,
        VentanaRegistro.php-->
        <script src="InicioSesion.js" type="text/javascript"></script>
        <script src="recuperacionContrasena.js" type="text/javascript"></script>
        <script src="VentanaRegistro.js" type="text/javascript"></script>
        <script src="Controles/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        

        <!--Estilos de páginas:
        InicioSesion.css,
        VentanaRegistro.css-->
        <link rel="stylesheet" href="VentanaRegistro.css" type="text/css">
        <link rel="stylesheet" href="InicioSesion.css" type="text/css">
        <link rel="stylesheet" href="Controles/ControlNotificacion/ControlNotificacion.css" type="text/css">
        <link rel="stylesheet" href="recuperacionContrasena.css" type="text/css">

        <!--IMPORTS-->
        <script src="../ClienteDialogo.GUI/datatypes/Usuario.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Sesion.js" type="text/javascript"></script>
        <script src="Controladores/CValidacionUsuario.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>

        <!--[if IE]>
        <script>
        alert("Esta aplicación no es compatible con Internet Explorer.\n"+
            "Por favor, utilice otro navegador.");
        window.close();
            
        </script>
        <!--<![endif]-->
    </head>

    <body onload="document.getElementById('cargando').style.display='none';">

        <?php
        require_once 'Controles/ControlNotificacion/ControlNotificacion.php';
        ?>
        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 10000000000;" ><br><br>CARGANDO<br><img src="../ClienteDialogo.GUI/Images/ajax-loader.gif"></div>

        <div id="top">

            <div id="menu" class="container_6">
                <ul class="menu">
                    <li>
                        <a href="#" class="active"><span>Inicio</span></a>
                    </li>
                    <li>
                        <a href="../../servicioDialogo/uploads/ayuda/getting_started.doc" target="_blank"><span>Ayuda</span></a>
                    </li>
                    <li>
                        <a id="registrar" href="#"><span>Registrar</span></a>
                    </li>
                    <li>
                        <a href="about.html" target="_blank"><span>Acerca de...</span></a>
                    </li>
                </ul>
            </div>

            <div id="titulo_logo" class="container_6">
                <div id="logo_usach">
                    <img alt="logo_usach" src="Images/título.png" >
                </div>
                <div class="clear">
                    &nbsp;
                </div>
            </div>

            <div class="Vspace_30px">
                &nbsp;
            </div>

            <div class="container_6">
                <div id="login_form" class="grid_3 push_1 suffix_1">


                    <div><label class="grid_2 push_1" for="nombre_usuario"><a>Usuario:</a></label></div>
                    <div><input id="usuario" type="text" size="40" class="grid_2 push_1 ui-corner-all ui-widget-content text"></div>

                    <div class="clear Vspace_10px">
                        &nbsp;
                    </div>

                    <div><label class="grid_2 push_1" for="contrasena"><a>Contraseña:</a></label></div>
                    <div><input id="contrasegna" type="password" size="40" class="grid_2 push_1 ui-corner-all ui-widget-content text"></div>
                    <div class="grid_2 push_1" style="text-align: right;">
                        <a id="forgotPassword" href="#" >¿Olvidó su contraseña?</a>
                    </div>
                    <div id="botonesInicioSesion" class="grid_3 suffix_1">
                        <button id="ingresar" class="grid_1 push_1"> Ingresar </button>
                        <button id="limpiar" class="grid_1 push_1 "> Limpiar </button>
                    </div>
                </div>

            </div>

        </div>

        <!--Diálogo modal de recuperación de contraseña-->
        <?php
        include('recuperacionContrasena.php');
        ?>

        <!--Díalogo modal de registro de usuario
        Se carga cuando se hace click en el botón Registrarse del menú CSS-->

        <?php
        include('VentanaRegistro.php');
        ?>

        <!--Fin diálogo modal registro de usuario-->

        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>


    </body>
</html>