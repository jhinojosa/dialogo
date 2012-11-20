<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--[if lt IE 7]> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js"> <!--<![endif]-->

<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>
	
	<meta name="description" content="Description" />
	<meta name="keywords" content="" />
	<meta name="robots" content="all" />
	<meta name="author" content="Author"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	<!--Favicon-->
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        <!-- css-->
	<link rel="stylesheet/less" type="text/css" href="../estilos/style.less">
	<link rel="stylesheet" href="../estilos/css/bootstrap.css" type="text/css" media="screen" />
	<!-- /css-->

        <!--Hoja de estilos jQueryUI
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css">-->

        <!--Javascript de jQuery-->
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>

        <!--Imports de jQuery DataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <!--<link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>-->
        
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
        <!-- <div class="clear" style="height: 20px;"></div> -->
	
	<div id = "warning">
        
        <!--[if IE 6]>
        <p>
            La versión de Internet Explorer que est&aacute;s utilizando
            no está actualizada. <br />
            Este sitio funcionar&aacute; mejor si actualizas tu navegador.
            <a href="http://www.microsoft.com/latam/windows/internet-explorer/">Actualizar Internet Explorer</a>
        </p>
        <![endif]-->
        
                <noscript>
                 <p>
                	Es necesario que tengas activado Javascript en su navegador 
                	para utilizar todas las funciones de este sitio.
                  <a href="#">
                    	&iquest;C&oacute;mo activar Javascript?
                  </a>
                 </p>
        	</noscript>
        </div><!-- #warning -->

	<div id="page" class="container">
        <div id="header" class="row">

            <div id="app-logo" class="span2">
                <img src="../estilos/img/html/app-logo.png" alt="" />
            </div><!-- #app-logo -->

            <div id="app-title" class="span4">
                <h5>Universidad de Santiago de Chile <br>
                    Departamento de Ingeniería Informática</h5>
                <h3>Diálogo Remoto</h3>
            </div><!-- #app-title -->

            <div id="user-panel" class="span6">
                <div id="user-img">
                    <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( "camilo.farfan@usach.cl" ) ) );?>=100" class="img-polaroid">    
                </div><!-- #user-img -->

                <div id="user-options">
                    <h4>Hola Camilo!</h4>
                    <div class="btn-group">
                      <button class="btn btn-small"><i class="icon-wrench"></i> Administrar</button>
                      <button class="btn btn-small"><i class="icon-pencil"></i> Editar Perfil</button>
                      <button class="btn btn-small"><i class="icon-off"></i> Cerrar Sesión</button>
                    </div>    
                </div><!-- #user-options -->
                <div class="clearfix"></div>
            </div><!-- #user-panel -->                          
        </div><!-- #header -->

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

	<!-- TABLAS-->
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
						<label for="cmbPerfilIntervencion" class=""><h5>Perfil Tipos de Intervención</h5></label>
						<select id="cmbPerfilIntervencion">
<!--                                		<option></option>-->
						</select>
					</div>				
					<!--TABLA -->        
					<div class="grid_3" id="lblDescripcion"></div>
					<div class="clear" style="height: 20px;"></div>
					<table id="dgBalance" class="table table-striped table-bordered">
						<div class="tableContainer">
							<thead>
								<tr id="headerDgBalance"> </tr>
							</thead>
							<tbody></tbody>
						</div>
					</table>
				</div>		
          			<!--FIN TABLA PERFIL DE MOVIDA-->
				
				
				<!--Pestaña Reglas de Diálogo-->
				<div class="tab-pane " id="2">
					<h3>Reglas de Diálogo</h3>
					<!--Tabla de reglas-->					
					<h5>Lista de Reglas</h5>
						<table id="dgReglas" class="table table-striped table-bordered">
							<thead>
								<tr width="85%" id="headerDgReglas"></tr>
							</thead>
							<tbody id="bodyReglas">
								 <!--</td><td class="editable">HOLA</td></tr>-->
							</tbody>
						</table>
						<select id="cmbReglasPredefinidas"></select> 
						<button id="btnAgregarReglaPredefinida" class="botonEnTab">
						Agregar
						</button>
						<button id="btnAgregarTodasPredefinida" class="botonEnTab">
							Agregar todas
						</button>
						<div class="clear"></div>
				</div>	
				
				<!--Pestaña Permisos de Acceso-->
				<div class="tab-pane " id="3">
					<h3>Permisos de Acceso</h3>
					<h5>Restringir el Acceso a los Siguientes Usuarios</h5>
					<!--Tabla de usuarios restringidos-->
					<table class="table table-striped table-bordered" id="DgUsuarios">
						<thead>
							<tr id="headerDgUsuarios" > </tr>
						</thead>
						<tbody>
							<tr class="error">
								<td>No existen usuarios restringidos</td>
							</tr>  
						</tbody>
					</table>
					<form class="form-inline">
						<input type="text" class="input-large" placeholder="Usuario Restringido">
						<button  class="btn btn-small">Agregar Usuario </button>
					</form>
					<label for="cmbFacilitador"><h5>Facilitador:</h5></label>
					<select id="cmbFacilitador"></select> 
					<button id="btnCambiarFacilitador" class="btn btn-small">
						Cambiar
					</button>
				</div>
			</div>
                </div>
            </div>
		
        </div>
	<button class="btn btn-small pull-right" id="btnGuardar"> Guardar Configuración</button>
			<a class="btn btn-small pull-right" href="VentanaNuevoDialogo.php"> Cancelar</a>
	
	<div class="row">
            <div id="footer" class="span12">
                <div class="row">
                    <div class="span10">
                        <h5>Universidad de Santiago de Chile <br>
                        Departamento de Ingeniería Informática</h5>
                        <p>Aplicación Web resultado de la Memoria de Título de Cristian Chávez R.<br>
                        Usabilidad mejorada por parte de los alumnos de la Asignatura Interacción Humano Computador,<br>
                        Segundo Semestre de 2012</p>
                    </div>
                    <div id="usach-footer" class="span2">
                        <a href="http://www.usach.cl/"><img src="../estilos/img/html/usach-white.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- #page -->

    <div id="agradecimientos">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <p>
                        En el desarrollo de esta aplicación se utilizaron herramientas y bibliotecas licenciadas 
                        bajo código abierto.
                    </p>

                    <a href="http://jquery.com/" target="_blank">jQuery</a>
                    <a href="http://twitter.github.com/bootstrap/" target="_blank">Twitter Bootstrap</a>
                    <a href="http://valums.com/ajax-upload/" target="_blank">Valums file uploader</a>
                    <a href="http://javascriptsoapclient.codeplex.com/" target="_blank">Javascript SOAP Client 2.4</a>
                    <a href="http://onehackoranother.com/projects/jquery/tipsy/" target="_blank">Tipsy</a>
                    <a href="https://github.com/akzhan/jwysiwyg/" target="_blank">Jwysiwyg</a>
                    <a href="http://medialize.github.com/jQuery-contextMenu/" target="_blank">JQuery context menu</a>
                    <a href="http://mbraak.github.com/jqTree/" target="_blank">JqTree</a>
                    <a href="http://www.appelsiini.net/projects/jeditable" target="_blank">JEditable</a>
                    <a href="http://datatables.net/" target="_blank">JQuery Data Tables</a>
                    <a href="http://sourceforge.net/projects/nusoap/" target="_blank">NuSOAP</a>
                    <a href="http://www.php.net/" target="_blank">PHP</a>
                </div>
            </div>
        </div>
    </div>
    
<!-- javascript 
<script type="text/javascript" src="../estilos/js/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript" src="../estilos/js/bootstrap.js"></script>
<script type="text/javascript" src="../estilos/js/less-1.3.0.min.js"></script>
<script type="text/javascript" src="../estilos/js/scripts.js"></script>


        <!--Carga pantalla de advertencia cuando javascript no está habilitado-->
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
        
        
    </body>
</html>
