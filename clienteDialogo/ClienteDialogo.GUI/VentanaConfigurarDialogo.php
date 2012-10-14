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

        <!--Imports de jQuery DataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>
        
        <!--Import de SOAP CLIENT-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
        
        <!--Imports de jEditable-->
        <script src="../Javascript/jQuery/jEditable/jquery.jeditable.js" type="text/javascript"></script>

        <!--Codebehind de
        VentanaMarcadores.php-->
        <script src="VentanaConfigurarDialogo.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        
        <!--Estilos de páginas:
        VentanaMarcadores.css
        encabezado.css-->
        <link rel="stylesheet" href="VentanaConfigurarDialogo.css" type="text/css">
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        <!--IMPORTS-->
        <script src="Controladores/CDialogo.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="datatypes/Dialogo.js" type="text/javascript"></script>
        <script src="datatypes/Intervencion.js" type="text/javascript"></script>
        <script src="datatypes/Acta.js" type="text/javascript"></script>
        <script src="datatypes/Usuario.js" type="text/javascript"></script>
        <script src="datatypes/Movida.js" type="text/javascript"></script>
        <script src="datatypes/Balance.js" type="text/javascript"></script>
        <script src="datatypes/Regla.js" type="text/javascript"></script>
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
                <a>Configuración de diálogo.</a>
            </div>
        </div>

        <div class="clear" style="height: 30px;"></div>

        <div class="container_6">
            <div id="tabs">
                <ul>
                    <li>
                        <a href="#tab1">Perfiles de movidas</a>
                    </li>
                    <li>
                        <a href="#tab2">Reglas de diálogo</a>
                    </li>
                    <li>
                        <a href="#tab3">Permisos de acceso</a>
                    </li>
                </ul>
                <div id="tab1">
                    <div class="container_6">
                        <div class="grid_2" id="cntndrCmbPerfiles">
                            <label for="cmbPerfilIntervencion" class="">Perfil de tipos de intervención:</label>
                            <select id="cmbPerfilIntervencion">
<!--                                <option></option>-->
                            </select>
                        </div>
                        <div class="grid_3" id="lblDescripcion"></div>
                        <div class="clear" style="height: 20px;"></div>
                        <div class="tableContainer">
                            <div class="gridTitle ui-widget ui-corner-all">Asignación de porcentajes de balance</div>
                            <table id="dgBalance" class="tabla">
                                <thead>
                                    <tr id="headerDgBalance">
                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="tab2">
                    <div class="container_6">
                        <div class="tableContainer">
                            <div class="gridTitle ui-widget ui-corner-all">Lista de reglas</div>
                            <table id="dgReglas" class="tabla">
                                <thead>
                                    <tr id="headerDgReglas">
                                    </tr>
                                </thead>
                                <tbody id="bodyReglas">
<!--                                    <tr><td>ID</td><td class="editable">HOLA</td></tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="clear" style="height: 20px;"></div>
                        <div class="grid_4" id="cntndrCmbReglasPredefinidas" >
                            <label for="cmbReglasPredefinidas">Reglas predefinidas:</label>
                            <select id="cmbReglasPredefinidas">
                                <!--                                <option value="1">Regla 1 </option>
                                                                <option value="2">Regla 2 </option>
                                                                <option value="3">Regla 3</option>-->
                            </select> 
                        </div>
                        <div class="grid_2" id="cntndrBotones">
                            <button id="btnAgregarReglaPredefinida" class="botonEnTab">
                                Agregar
                            </button>
                            <button id="btnAgregarTodasPredefinida" class="botonEnTab">
                                Agregar todas
                            </button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>


                <div id="tab3">
                    <div class="container_6">
                        <div class="tableContainer">
                            <div class="gridTitle ui-widget ui-corner-all">Restringir el acceso a los siguientes usuarios</div>
                            <table id="dgUsuarios">
                                <thead>
                                    <tr id="headerDgUsuarios"></tr>
                                </thead>
                                <tbody>
<!--                                    <tr><td>HOLA</td></tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="" style="height: 20px;"></div>

                        <div class="grid_3" id="facilitador">
                            <div style="float: left;">
                                <label for="cmbFacilitador">Facilitador:</label>
                                <select id="cmbFacilitador">
<!--                                    <option value="1">Facilitador 1</option>
                                    <option value="2">Facilitador 2</option>
                                    <option value="3">Facilitador 3</option>-->
                                </select> 
                            </div>
                            <div id="btnCambiar" class="grid_1">
                                <button id="btnCambiarFacilitador">
                                    Cambiar
                                </button>
                            </div>
                        </div>

                        <div class="grid_3" id="agregar">

                            <input type="text" size="30" id="txtNombreUsuario" >
                            <button id="btnAgregarUsuario">
                                Agregar
                            </button>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear" style="height: 10px;"></div>
            <div id="fondoUnico">
                <div class="grid_4" id="lblMensajeError"></div>
                <div class="grid_2">
                    <button id="btnGuardar" class="botonInferior">
                        Guardar configuración
                    </button>
                </div>
            </div>
        </div>
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
        
        
    </body>
</html>