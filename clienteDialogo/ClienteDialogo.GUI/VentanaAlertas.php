<!DOCTYPE html>
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


        <!--Codebehind de
        VentanaAlertas.php
        controlListaDialogos.php-->
        <script src="Controls/controlListaDialogos.js" type="text/javascript"></script>
        <script src="VentanaAlertas.js"></script>
        

        <!--Estilos de páginas:
        VentanaAlertas.css
        encabezado.css
        controlListaDialogos.css-->
        <link rel="stylesheet" href="VentanaAlertas.css" type="text/css"/>
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css"/>
        <link rel="stylesheet" href="Controls/controlListaDialogos.css" type="text/css"/>

        <script src="Controladores/CMarcadores.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="Controladores/CDialogo.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Dialogo.js" type="text/javascript"></script>
        <script src="../ClienteDialogo.GUI/datatypes/Acta.js" type="text/javascript"></script>

    </head>

    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>

        <?php
        $sesion = htmlspecialchars($_GET["sesionactual"]);

        echo "<input type=\"hidden\" id=\"sesion\" value=\"$sesion\">";
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
                <a>Alertas.</a>
            </div>
        </div>

        <div class="clear" style="height: 20px;"></div>

        <div class="container_6">
            <div id="tabs">
                <ul>
                    <li>
                        <a href="#tab1">Diálogos desbalanceados</a>
                    </li>
                    <li>
                        <a href="#tab2">Sugerencias</a>
                    </li>
                </ul>
                <div id="tab1">
                    <?php
                    include('Controls/controlListaDialogos.php');
                    ?>
                </div>
                <div id="tab2">
                    <p>Pestaña sugerencias no funcional (?)!!</p>
                </div>

            </div>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
        <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
    </body>
</html>