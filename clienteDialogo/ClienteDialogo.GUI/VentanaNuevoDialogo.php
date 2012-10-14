<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

        <!--Favicon-->
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        <!--Estilos de 960grid-->
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css"/>
        <link rel="stylesheet" href="../CSS/960g_6col/reset.css" type="text/css"/>
        <link rel="stylesheet" href="../CSS/960g_6col/text.css" type="text/css"/>

        <!--Hoja de estilos jQueryUI-->
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css"/>

        <!--Javascript de jQuery-->
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js"></script>
        
        <!--Import de clases externas-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
        
        <!--Import jWYSIWYG-->
        <script src="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.js"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.css" type="text/css"/>
        
        <!--Codebehind de
        VentanaNuevoDialogo.php
        controlEscrituraIntervencion.php-->
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        <script src="Controls/controlEscrituraIntervencion.js" type="text/javascript"></script>
        <script src="VentanaNuevoDialogo.js" type="text/javascript"></script>
        

        <!--Estilos de páginas:
        VentanaNuevoDialogo.css
        controlEscrituraIntervencion.js
        encabezado.css-->
        <link rel="stylesheet" href="VentanaNuevoDialogo.css" type="text/css"/>
        <link rel="stylesheet" href="Controls/controlEscrituraIntervencion.css" type="text/css"/>
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css"/>
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        <!--IMPORTS-->
        <script src="Controladores/CDialogo.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="datatypes/Dialogo.js" type="text/javascript"></script>
        <script src="datatypes/Intervencion.js" type="text/javascript"></script>
        <script src="datatypes/Usuario.js" type="text/javascript"></script>
        <script src="datatypes/Acta.js" type="text/javascript"></script>
        <script src="datatypes/Regla.js" type="text/javascript"></script>
        <script src="datatypes/Movida.js" type="text/javascript"></script>
        <script src="datatypes/Balance.js" type="text/javascript"></script>
        <script src="datatypes/Sesion.js" type="text/javascript"></script>

    </head>

  <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>
        
        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>
           

        <div class="clear" style="height: 40px;"></div>
        <div id="encabezado" class="container_6">
            <div class="" id="imagenEncabezado">
                <img id="logoUsach" alt="logoUsach" src="Images/logoUsach.png" />
            </div>
            <div class="grid_4" id="textoEncabezado">
                <div class="encabezadoTexto_1">
                    <a>Diálogo Remoto</a>
                </div>
                <div class="encabezadoTexto_2">
                    <a>Mejorando el entendimiento</a>
                </div>
            </div>

            <div id="tituloPaginaActual" class="grid_4">
                <a>Creando un nuevo diálogo.</a>
            </div>
        </div>

        <div class="clear" style="height: 20px;"></div>

        <div class="container_6 ui-widget">
        <form>
            <div class="grid_2" id="tituloNuevoDialogo" >
                <label for="txtTitulo">Título del nuevo diálogo
                    <input id="txtTitulo" type="text" size="40" class="ui-corner-all"/>
                </label>
            </div>

            <div class="clear" style="height: 10px;"></div>

            <div class="grid_6">
                <!--Ingresar aquí control de edicion de texto.-->
                <?php
                include('Controls/controlEscrituraIntervencion.php');
                ?>
            </div>

            <div class="clear" style="height: 10px;"></div>

            <div class="grid_4" id="configNuevoDialogo">
                <div class="grid_1">
                    <a>Perfil de movidas</a>
                </div>
                <div class="grid_3 dataConfig">
                    <a id="txtPerfilMovidasSeleccionado">perfiles de movidas aquí</a>
                </div>
                <div class="grid_1">
                    <a>Reglas</a>
                </div>
                <div class="grid_3 dataConfig">
                    <a id="txtReglasSeleccionadas">reglas aquí</a>
                </div>
                <div class="grid_1">
                    <a>Restricciones</a>
                </div>
                <div class="grid_3 dataConfig">
                    <a id="txtRestriccionesSeleccionadas">restricciones aquí</a>
                </div>
            </div>

            <div class="grid_1 push_1" id="cambiarConfig">
                <a href="#" id="btnAbrirConfiguracion">Cambiar configuración...</a>
            </div>

            <div class="clear" style="height: 10px;"></div>

            <div class="grid_5 ui-widget" id="lblMensajeError">
<!--                <div onclick="toggleMensajeError()" id="mensajeError" class="ui-state-highlight ui-corner-all" style=" padding: 0pt 0.7em;">
                    <p>
                        <span class="" style="float: left; margin-right: 0.3em;"></span>
                        Mensaje de notificación.
                    </p>
                </div>-->
            </div>

            <div class="push_5 grid_1 " id="publicar">
                <button id="btnEnviar">
                    Publicar
                </button>
            </div>
            </form>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
       
    </body>
</html>