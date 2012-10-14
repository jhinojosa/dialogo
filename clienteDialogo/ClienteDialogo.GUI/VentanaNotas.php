<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>NOTAS</title>

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
        <!--Import de SOAP CLIENT-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

        <script src="Controladores/CNotas.js" type="text/javascript"></script>
        <script src="datatypes/Intervencion.js" type="text/javascript"></script>
        <script src="datatypes/Usuario.js" type="text/javascript"></script>
        <script src="datatypes/Nota.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        
        <script src="VentanaNotas.js" type="text/javascript"></script>
        <link rel="stylesheet" href="VentanaNotas.css" type="text/css">
        
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">
    </head>
    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>

        <?php
//        $sesionActual = htmlspecialchars($_GET['sesionActual']);
        $intervencion = htmlspecialchars($_GET['intervencion']);
        
        
//        echo "<input type=\"hidden\" id=\"sesionActual\" value=\"$sesionActual\">";
        echo "<input type=\"hidden\" id=\"intervencion\" value=\"$intervencion\">";
        ?>
        
        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>
        <div id="cont" >
            <div id="dialogoNotas" title="Notas">

                <div>
                    <textarea id="txtNotas"  class="text ui-corner-all" ></textarea>
                </div>
            </div>
            <div id="botones">
                <button id="btnGuardar">Guardar</button>
                <button id="btnEliminar">Eliminar</button>
            </div>
        </div>
        
        
    </body>
</html>