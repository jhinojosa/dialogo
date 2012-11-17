<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<!--<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

        Favicon
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        Estilos de 960grid
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/reset.css" type="text/css">
        <link rel="stylesheet" href="../CSS/960g_6col/text.css" type="text/css">

        Hoja de estilos jQueryUI
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css">

        Javascript de jQuery
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        Javascript de JqueryUI
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>

        Imports de jQuery DataTables
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>
        
        Import de SOAP CLIENT
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
        
        Imports de jEditable
        <script src="../Javascript/jQuery/jEditable/jquery.jeditable.js" type="text/javascript"></script>

        Codebehind de
        VentanaMarcadores.php
        <script src="VentanaConfigurarDialogo.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        
        Estilos de páginas:
        VentanaMarcadores.css
        encabezado.css
        <link rel="stylesheet" href="VentanaConfigurarDialogo.css" type="text/css">
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        IMPORTS
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
        //require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
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
                                <option></option>
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
                                    <tr><td>ID</td><td class="editable">HOLA</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clear" style="height: 20px;"></div>
                        <div class="grid_4" id="cntndrCmbReglasPredefinidas" >
                            <label for="cmbReglasPredefinidas">Reglas predefinidas:</label>
                            <select id="cmbReglasPredefinidas">
                                                                <option value="1">Regla 1 </option>
                                                                <option value="2">Regla 2 </option>
                                                                <option value="3">Regla 3</option>
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
                                    <tr><td>HOLA</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="" style="height: 20px;"></div>

                        <div class="grid_3" id="facilitador">
                            <div style="float: left;">
                                <label for="cmbFacilitador">Facilitador:</label>
                                <select id="cmbFacilitador">
                                    <option value="1">Facilitador 1</option>
                                    <option value="2">Facilitador 2</option>
                                    <option value="3">Facilitador 3</option>
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
        Carga pantalla de advertencia cuando javascript no está habilitado
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
        
        
    </body>
</html>-->
<?php include_once('../header.php'); ?>
<script src="VentanaConfigurarDialogo.js" type="text/javascript"></script>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li class="active" ><a href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
                    <li ><a href="#"><i class="icon-star"></i> Marcadores</a></li>
                    <li ><a href="#"><i class="icon-eye-open"></i> Intervenciones</a></li>
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
	           <li><a href="#">Diálogos</a> <span class="divider">/</span></li>
             <li><a href="#">Nuevo Diálogo</a> <span class="divider">/</span></li>
        	   <li class="active">Configuración Diálogo</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">

	  <h1>Configuración de Diálogo</h1>
<!--Inicio de las pestañas-->
               
            <div class="tabbable">
            	<ul class="nav nav-tabs">
               		<li class="active"><a href="#1" data-toggle="tab">Perfiles de Movida</a></li>
               		<li><a href="#2" data-toggle="tab">Reglas de Diálogo</a></li>
               		<li><a href="#3" data-toggle="tab">Permisos de Acceso</a></li>
            	</ul>
		<!--Contenido de las pestañas-->
            	<div class="tab-content">
			<!--Pestaña Perfiles de Movida-->
			<div class="tab-pane active" id="1">
                            <h3>Perfiles de Movida</h3>
                                <div class="grid_2" id="cntndrCmbPerfiles">
                                    <label for="cmbPerfilIntervencion" class=""><h5>Perfil Tipos de Intervención:</h5></label>
                                        <select id="cmbPerfilIntervencion">
                                            <option></option>
                                        </select>
                                </div>
          			<!--TABLA -->
            			<table class="table table-striped table-bordered tabla" id="dgBalance">
                  			<thead>
                                            <tr id="headerDgBalance">                                                       
                                            </tr>
                  			</thead>
                  			<tbody>
<!--                                            <tr>
                                                <td><input type="text" class="input-small" placeholder="entre 0 y 100" /></td>
                                                <td><input type="text" class="input-small" placeholder="entre 0 y 100" /></td>                      
                                            </tr>-->
                  			</tbody>
                		</table>
                		
                				
          			<!--FIN TABLA PERFIL DE MOVIDA-->
          
			</div>
			<!--Pestaña Reglas de Diálogo-->
			<div class="tab-pane " id="2">
				<h3>Reglas de Diálogo</h3>
				<h5>Lista de Reglas</h5>
				<!--Tabla de reglas-->
				<table id="dgReglas" class="tabla table table-striped table-bordered">
                                    <thead>
                                        <tr id="headerDgReglas">
                                        </tr>
                                    </thead>
                                    <tbody id="bodyReglas">
                                    </tbody>
                                </table>
                                <select id="cmbReglasPredefinidas">
                                </select>
                                <button id="btnAgregarReglaPredefinida" class="btn btn-small ">Agregar</button>
                                <button id="btnAgregarTodasPredefinida" class="btn btn-small ">Agregar todas</button>	
                                <button id="btnAgregarTodasPredefinida" class="btn btn-small ">Quitar</button>	
			</div>
			<!--Pestaña Permisos de Acceso-->
			<div class="tab-pane " id="3">
				<h3>Permisos de Acceso</h3>
				<h5>Restringir el Acceso a los Siguientes Usuarios</h5>
				<!--Tabla de usuarios restringidos-->
				<table class="table table-striped table-bordered" id="dgUsuarios">
                  			<thead>
                    				<tr>
                      					<th>Usuario</th>
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr class="error">
                      					<td>No existen usuarios restringidos</td>
                    				</tr>  
						<!--en caso de existir se deben agregar con una rregloo algo asi-->   
                  			</tbody>
                		</table>
				<form class="form-inline">
                    			<input type="text" class="input-large" placeholder="Usuario Restringido">
                    			<button  class="btn btn-small">Agregar Usuario </button>
               			</form>
				<h5>Facilitador</h5>
				<select>
                    		<option>facilitador 1</option>
                   		<option>facilitador 2</option>
                    		<option>facilitador 3</option>
               			</select>
                		<button class="btn btn-small"> Cambiar</button>
			</div>
             	</div>
                <button id="btnGuardar" class="btn btn-small btn-primary">
                        Guardar configuración
                </button>
		<a class="btn btn-small " href="VentanaNuevoDialogo.php"> Cancelar</a>                
            </div>

        </div><!-- #main-content -->
</div><!-- #content -->
<?php include_once('../footer.php'); ?>