<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

        <script>
            /**
             * Deshabilita el volver a la ventana anterior al cerrar la aplicación desde el botón.
             */
            if (history.forward(1)){location.replace(history.forward(1))}    
        </script>
        <!--Favicon-->
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        <!--Estilos de 960grid-->
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/reset.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/text.css" type="text/css">

        <!--Hoja de estilos jQueryUI-->
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css">

        <!--Javascript de jQuery-->
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>


        <!--Import de clases externas-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

        <script src="../Javascript/jQuery/valums-file-uploader-cf7bfb1/client/fileuploader.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/valums-file-uploader-cf7bfb1/client/fileuploader.css" type="text/css"> 

        <!--Codebehind de
        VentanaPrincipal.php
        DatosUsuario.php
        ControlListaDialogo.php-->
        <script src="Controls/controlListaDialogos.js" type="text/javascript"></script>
        <script src="VentanaPrincipal.js" type="text/javascript"></script>
        <script src="Controls/DatosUsuario.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>

        <!--Estilos de páginas:
        VentanaPrincipal.css
        DatosUsuario.css
        controlListaDialogo.css-->
        <link rel="stylesheet" href="VentanaPrincipal.css" type="text/css">
        <link rel="stylesheet" href="Controls/DatosUsuario.css" type="text/css">
        <link rel="stylesheet" href="Controls/controlListaDialogos.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">


        <!--IMPORTS-->

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


        <script>
            
        </script>
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

        <div class="clear" style="height: 40px;"></div>
        <div id="encabezado" class="container_6">
            <div class="" id="imagenEncabezado">
                <img id="logoUsach" alt="logoUsach" src="Images/logoUsach.png" >
            </div>
            <div class="grid_4" id="textoEncabezado">
                <div class="encabezadoTexto_1">
                    Diálogo Remoto
                </div>
                <div class="encabezadoTexto_2">
                    Mejorando el entendimiento
                </div>

                <div id="DatosUsuario">
                    <!--AQUÍ VA EL AVATAR, NOMBRE DE USUARIO Y BOTÓN CERRAR SESIÓN y ADMINISTRAR-->
                    <?php
                    include('Controls/DatosUsuario.php');
                    ?>
                </div>
            </div>
        </div>
        <div class="clear" style="height: 20px;"></div>
        <div>
            <div id="barraBotones" class="">
                <button id="btnNuevoDialogo" class="grid_1"> nuevo diálogo </button>
                <button id="btnVerMarcadores" class="grid_1"> ver marcadores </button>
                <button id="btnBuscarIntervenciones" class="grid_1"> buscar intervenciones </button>
                <button id="btnVerAlertas" class="grid_1"> ver alertas </button>
                <div id="btnRefrescar" class="grid_1">
                    refrescar
                </div>
            </div>

            <div class="clear" style="height: 10px;"></div>
            <div class="container_6 ui-widget" id="listaDialogos">
                <?php
                include('Controls/controlListaDialogos.php');
                ?>
            </div>
        </div>

        <div id="somediv"></div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>

    </body>
</html>