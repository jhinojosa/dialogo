<?php /*<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

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

        <!--Codebehind de VentanaMarcadores.php-->
        <script src="Controladores/CMarcadores.js"></script>
        <script src="Controladores/ConexionManager.js"></script>
        <script src="VentanaBusqueda.js"></script>

    </head>

    <body onload="document.getElementById('cargando').style.display='none';">

        <div id="cargando" style="position: fixed; background-color: #ffffff; width: 100%; height: 100%; text-align: center;  font-weight: bold; color:#005190; z-index: 2147483646;" ><br><br>CARGANDO<br><img src="Images/ajax-loader.gif"></div>
*/?>
<?php include_once('../header.php'); ?>
        <script src="Controladores/CMarcadores.js"></script>
        <script src="VentanaBusqueda.js"></script>
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css"/>
                <link rel="stylesheet" href="VentanaBusqueda.css" type="text/css"/>

        <?php
        $sesion = htmlspecialchars($_GET['sesionactual']);

        echo "<input type=\"hidden\" id=\"sesion\" value=\"$sesion\">";
        ?>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li ><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
                    <li ><a href="#" id="btnVerMarcadores"><i class="icon-star"></i> Marcadores</a></li>
                    <li ><a href="#" id="btnBuscarIntervenciones"><i class="icon-eye-open"></i> Intervenciones</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="#"><i class="icon-question-sign"></i> Ayuda</a></li>
                    <li><a href="#"><i class="icon-info-sign"></i> Acerca de</a></li>
                </ul>
            </div>
        </div>    
    </div>  
</div><!-- #menu-bar -->
    
<div id="barra-estado" class="row">
  <div class="span12">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
      <li class="active">Búsqueda de intervenciones</li>
    </ul>
  </div> <!-- #barra-estado -->
</div>

        <div class="row">
            <div class="span12">
                <div id="aBuscar">
                    <label for="txtNombreUsuario">Ingrese el nombre de usuario a buscar (puede no ser exacto): </label>
                    <input type="text" id="txtNombreUsuario" />
                    <input type="button" id="btnBuscar" class="btn" value="Buscar" />
                </div>
            </div>
        </div>
        <br /> <br />
        <div class="row">
            <div class="span12">
                <table id="bi_resultado" class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th>Texto Intervención</th>
                            <th>Diálogo</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody id="bi_resultado_body">
                        <tr><td colspan="3">Por favor, realice una búsqueda.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
<?php include_once('../footer.php'); ?>
<?php /*        
        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
        <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
    </body>
</html>
*/?>
