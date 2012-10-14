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

        <!--Imports de jquery datatable-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/> 

        <!--Import de clases externas-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

        <!--Codebehind de
        VentanaMarcadores.php-->
        <script src="Controladores/CMarcadores.js"></script>
        <script src="Controladores/ConexionManager.js"></script>
        <script src="VentanaBusqueda.js"></script>

        <!--Estilos de páginas:
        VentanaMarcadores.css
        encabezado.css-->
        <link rel="stylesheet" href="VentanaBusqueda.css" type="text/css"/>
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css"/>

    </head>

    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>

        <?php
        $sesion = htmlspecialchars($_GET['sesionactual']);

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
                <a>Búsqueda de intervenciones.</a>
            </div>
        </div>

        <div class="clear" style="height: 20px;"></div>

        <div class="container_6 ui-widget">
            <div class="grid_6" id="busqueda">

                <div class="grid_2" id="aBuscar">
                    <label for="txtNombreUsuario" >Nombre de usuario: </label>
                    <input type="text" id="txtNombreUsuario" class="ui-corner-all" />
                </div>

                <div class="grid_1" id="boton">
                    <input type="button" id="btnBuscar" value="Buscar" />
                </div>
            </div>

            <div class="clear" style="height: 10px;"></div>

            <div class="container_6">
                <table id="dgResultado">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
        <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
    </body>
</html>