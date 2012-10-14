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
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
        
        <!--Import de SOAP CLIENT-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
        
        <!--        Imports de jquery dataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>


        <!--Codebehind de
        VentanaEstadísticas.php-->
        <script src="VentanaEstadisticas.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        
        <!--Estilos de páginas:
        VentanaEstadísticas.css
        encabezado.css-->
        <link rel="stylesheet" href="VentanaEstadisticas.css" type="text/css"/>
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
        <script src="datatypes/CategoriaMovida.js" type="text/javascript"></script>



    </head>

   <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>

        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>

        <div class="clear" style="height: 20px;"></div>

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
                <a>Estadísticas.</a>
            </div>
        </div>

        <div class="clear" style="height: 30px;"></div>

        <div class="container_6">
            <div id="tabs">
                <ul>
                    <li>
                        <a href="#tab1">Balance de tipos de movida</a>
                    </li>
                    <li>
                        <a href="#tab2">Participación Usuario/Movida</a>
                    </li>
                    <li>
                        <a href="#tab3">Participación Usuario/Eje</a>
                    </li>
                </ul>
                <div id="tab1">
                    <table id="grillaPorcentajes">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tab2">
                    <table id="grillaUsuarios">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tab3">
                    <table id="grillaEje">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
    </body>
</html>