<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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

        <!-- jQuery DataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/> 

        <!--Imports de jEditable-->
        <script src="../Javascript/jQuery/jEditable/jquery.jeditable.js" type="text/javascript"></script>

        <!--Codebehind-->
        <script src="Controls/controlReglas.js" type="text/javascript"></script>
        <script src="Controls/ControlPerfilMovidas.js" type="text/javascript"></script>
        <script src="VentanaAdministracion.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>

        <!--Estilos-->
        <link rel="stylesheet" href="Controls/controlReglas.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlPerfilMovidas.css" type="text/css">
        <link rel="stylesheet" href="VentanaAdministracion.css" type="text/css"/>
        <link rel="stylesheet" href="../ClienteDialogo.GUI/CSS/encabezado.css" type="text/css"/>
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css">

        <!--IMPORTS-->

        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="Controladores/CSesion.js" type="text/javascript"></script>
        <script src="Controladores/CRegla.js" type="text/javascript"></script>
        <script src="Controladores/CMovida.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Sesion.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Movida.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Usuario.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Regla.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/CategoriaMovida.js" type="text/javascript"></script>
    </head>

    <!--    <body onload="document.getElementById('cargando').style.display='none';">
    
            <div id="cargando" style="width: 100%; height: 100%; text-align: center; font-weight: bold; color:#005190;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>-->
    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="../ClienteDialogo.GUI/Images/ajax-loader.gif"></div>


        <?php
        $idsesion = htmlspecialchars($_GET["idsesion"]);
        $usuario = htmlspecialchars($_GET["usuario"]);

        echo "<input type=\"hidden\" id=\"usuario\" value=\"$usuario\">";
        echo "<input type=\"hidden\" id=\"idsesion\" value=\"$idsesion\">";
        ?>

        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>
        <div class="clear" style="height: 40px;"></div>
        <div id="encabezado" class="container_6">
            <div class="" id="imagenEncabezado">
                <img id="logoUsach" alt="logoUsach" src="../ClienteDialogo.GUI/Images/logoUsach.png" />
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
                <a>Administración.</a>
            </div>
        </div>

        <div class="clear" style="height: 20px;"></div>

        <div class="container_6 ui-widget">
            <div id="tabs" >
                <ul>
                    <li>
                        <a href="#tab1">Reglas</a>
                    </li>
                    <li>
                        <a href="#tab2">Perfiles de movidas</a>
                    </li>
                </ul>
                <div id="tab1">
                    <div id="ctrlReglas">
                        <?php
                        require_once 'Controls/controlReglas.php';
                        ?>
                    </div>
                </div>

                <div id="tab2">
                    <div id="ctrlPerfilMovidas">
                        <?php
                        require_once 'Controls/ControlPerfilMovidas.php';
                        ?>
                    </div>
                </div>


            </div>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
        <!--        <div id="notificar" title="Notificación">
                    <p id="textoNotificar"></p>
                </div>-->


    </body>
</html>