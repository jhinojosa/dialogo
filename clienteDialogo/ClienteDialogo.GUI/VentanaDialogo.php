<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

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

        <!--Imports de jquery.dataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>

        <!--jQuery contextMenu-->
        <script src="../Javascript/jQuery/jquery.contextMenu/jquery.contextMenu.js" type="text/javascript"></script>

        <!--Import de SOAP CLIENT-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

        <!--Import jWYSIWYG-->
        <script src="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.css" type="text/css">

        <!--Import jqTree -->
        <script src="../Javascript/jQuery/jqTree/tree.jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/jqTree/jqtree.css" type="text/css">

       <!-- BlockUI -->
       <script src="../Javascript/jQuery/blockUI/jquery.blockUI.js" type="text/javascript"></script>
       
       
        <!--Codebehind de
        VentanaDialogo.php
        controlEscrituraIntervencion.php-->
        <script src="Controls/controlEscrituraIntervencion.js" type="text/javascript"></script>
        <script src="VentanaDialogo.js" type="text/javascript"></script>
        <script src="Controls/NavegadorHilo.js" type="text/javascript"></script>
        <script src="Controls/contextMenus/responderContextMenu.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>

        <!--Estilos de páginas:
        VentanaMarcadores.css
        encabezado.css
        controlEscrituraIntervencion.css-->
        <link rel="stylesheet" href="VentanaDialogo.css" type="text/css">
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        <!--        <link rel="stylesheet" href="VentanaDialogo.css" type="text/css">-->
        <!--<link rel="stylesheet" href="Controls/controlEscrituraIntervencion.css" type="text/css"/>-->

        <!--IMPORTS-->
        <script src="datatypes/Intervencion.js" type="text/javascript"></script>
        <script src="datatypes/Acta.js" type="text/javascript"></script>
        <script src="datatypes/Nota.js" type="text/javascript"></script>
        <script src="datatypes/Usuario.js" type="text/javascript"></script>
        <script src="datatypes/Dialogo.js" type="text/javascript"></script>
        <script src="datatypes/Movida.js" type="text/javascript"></script>
        <script src="datatypes/Balance.js" type="text/javascript"></script>
        <script src="datatypes/Regla.js" type="text/javascript"></script>
        <script src="datatypes/CategoriaMovida.js" type="text/javascript"></script>
        <script src="datatypes/Marcador.js" type="text/javascript"></script>
        <script src="datatypes/MovidaCorregida.js" type="text/javascript"></script>
        <script src="Controladores/CDialogo.js" type="text/javascript"></script>
        <script src="Controladores/CNotas.js" type="text/javascript"></script>
        <script src="Controladores/CActa.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="Controladores/CMarcadores.js" type="text/javascript"></script>
        <script src="Controladores/CSesion.js" type="text/javascript"></script>


        <!--controlDisplayTextoIntervencion-->
        <link rel="stylesheet" href="Controls/controlDisplayTextoIntervencion.css" type="text/css"/>
        <script src="Controls/controlDisplayTextoIntervencion.js" type="text/javascript"></script>

        <!--tipsy-->
        <link rel="stylesheet" href="../Javascript/jQuery/tipsy/src/stylesheets/tipsy.css">
        <script src="../Javascript/jQuery/tipsy/src/javascripts/jquery.tipsy.js"></script>  

        <!--DialogBrowser-->
        <link rel="stylesheet" href="Controls/DialogBrowser.css" type="text/css">
        <script src="Controls/DialogBrowser.js" type="text/javascript"></script>

        <!--[if lt IE 9]>
        <script src="../Javascript/ie7/IE9.js" type="text/javascript"></script>
        <![endif]-->
    </head>

    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>

        <?php
        $sesionActual = htmlspecialchars($_GET['sesionActual']);
        $idDialogo = $_GET['idDialogo'];

        if ($_GET['idIntervencion'] != null || $_GET['idIntervencion'] != "") {
            $idIntervencion = $_GET['idIntervencion'];
            echo "<input type=\"hidden\" id=\"idIntervencion\" value=\"$idIntervencion\">";
        }

        echo "<input type=\"hidden\" id=\"sesionActual\" value=\"$sesionActual\">";
        echo "<input type=\"hidden\" id=\"idDialogo\" value=\"$idDialogo\">";
        ?>

        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>
        <!--Menú contextual.-->
        <?php
        include('Controls/contextMenus/responderContextMenu.php');
        ?>

        <div class="clear" style="height: 20px;"></div>
        <!--
        Elemento de ayuda para los tipos de movida.
        -->
        <div id="moves" style="width: 450px; text-align: center; position: fixed; z-index: 9999998">
            <img src="Images/dialogo.jpg">
            <p style="text-align: justify;">
                De esta figura se desprende que en el diálogo cada participante busca darse a 
                entender (mediante el mover y el oponer) y entender (mediante el observar y el 
                seguir). Si estas movidas son hechas en el ambiente de respeto que se ha 
                descrito y el facilitador logra mantener las opiniones dentro de la línea del 
                tema el aprendizaje es casi inevitable.
            </p>
        </div>
        
        <div id="encabezado" class="container_6">
            <div class="" id="imagenEncabezado">
                <img id="logoUsach" alt="logoUsach" src="Images/logoUsach.png" >
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
                <a>Dialogando.</a>
            </div>
        </div>

        <div class="clear ui-widget" style="height: 30px;"></div>

        <div class="container_6">
            <div id="tabs" >
                <ul>
                    <li>
                        <a href="#tab1">Acerca del diálogo</a>
                    </li>
                    <li>
                        <a href="#tab2">Explorador de diálogo</a>
                    </li>
                    <li id="todasActas">
                        <a href="#tab3">Actas del diálogo</a>
                    </li>
                </ul>
                <div id="tab1">
                    <div class="grid_6" id="encabezadoTab1">
                        <div id="imagenUsuario" class="grid_1">
                            <img src="Images/no_user_photo-v1.gif" alt="no-user" width="50" height="">
                        </div>
                        <div id="datos" class="grid_4">
                            <div class="grid_1">
                                Título:
                            </div>
                            <div id="lblTitulo"class="data grid_3">
                                título aquí
                            </div>
                            <div class="grid_1">
                                Nombre del creador:
                            </div>
                            <div id="lblNombreUsuario" class="data grid_3">
                                nombre de usuario aquí
                            </div>
                            <div class="grid_1">
                                Fecha de creación:
                            </div>
                            <div id="lblFechaCreacion" class="data grid_3">
                                fecha de creación aquí
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div>
                            <button id="btnVerEstadisticas">
                                Ver estadísticas
                            </button>
                        </div>
                        <div class="clear"></div>
                        <div id="btnsRefPar">
                            <button id="btnConfigurar">
                                Configurar...
                            </button>
                            <button id="btnParticipar">
                                Participar
                            </button>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <table id="dgReglas">
                        <thead>
                            <tr>
                                <th>Reglas</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="clear"></div>
                    <div style="margin-top: 15px;">
                        Acta dialogal
                    </div>
                    <div id="txtArea">
                        <textarea id="txtActaUsuario" rows="8" cols="110"></textarea>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <button id="btnGuardarActa" class="grid_1">
                            Guardar acta
                        </button>
                        <button id="btnVerTodasActas" class="grid_2">
                            Ver todas las actas
                        </button>
                    </div>
                    <div class="clear"></div>
                </div>

                <div id="tab2">
                    <div id="btnRefrescarContainer">
                        <button id="btnRefrescar">Refrescar</button>
                    </div>
                    <div class="clear" style="heigth:10px;"></div>
                    
                    <div id="browserNav">
                        <div class="ui-widget" style="font-size:12px;"><b>Navegador del diálogo:</b></div>
                        <div id="controlHilo">
                            <?php
                            include('./Controls/DialogBrowser.php');
                            ?>

                        </div>

                        <div class="clear" style="height:20px;"></div>
                        <div class="ui-widget" style="font-size:12px;"><b>Árbol de intervenciones:</b></div>
                        <div id="Navegador" class="ui-corner-all">
                            <?php
                            //include('./Controls/controlDisplayTextoIntervencion.php');
                            include('./Controls/NavegadorHilo.php');
                            ?>
                        </div>
                    </div>
                    <div class="clear" style="height: 20px;"></div>
                    
                    <div id="controlTab">
                        <ul>
<!--                            <li>
                                <a href="#tab2-1">Responder</a>
                            </li>-->
                        </ul>

<!--                        <div id="tab2-1">
                            <div id="controlEscritura">
                                <?php
                                //include('Controls/controlEscrituraIntervencion.php');
                                ?>
                            </div>
                            <div class="clear"></div>
                        </div>-->
                    </div>
                </div>

                <div id="tab3">
                    <div>
                        <div>
                            <a>Usuario</a>
                        </div>
                        <div class="clear"></div>
                        <div>
                            <select id="cmbUsuarios">
                                <option>Usuario 1</option>
                                <option>Usuario 2</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                        <div id="lblActa">
                            <a>Acta</a>
                        </div>
                        <div id="cntndrActaOtroUsuario">
                            <div id="txtActaOtroUsuario" class="ui-corner-all"></div>
<!--                            <textarea id="txtActaOtroUsuario" rows="8" cols="110"></textarea>-->
                        </div>
                        <div class="clear" style="height: 20px;"></div>
                    </div>
                </div>
            </div>
        </div>
    <a name="final"></a>
    
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
        
        <!--        <div id="notas">
        <?php
//            include("VentanaNotas.html");
        ?>
                </div>-->
    </body>
</html>