<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<!--<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>

        Favicon
        <link rel="shortcut icon" href="../Favicon/favicon.ico">

        Estilos de 960grid
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css"/>
        <link rel="stylesheet" href="../CSS/960g_6col/reset.css" type="text/css"/>
        <link rel="stylesheet" href="../CSS/960g_6col/text.css" type="text/css"/>

        Hoja de estilos jQueryUI
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css"/>

        Javascript de jQuery
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        Javascript de JqueryUI
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>
        
        Import de SOAP CLIENT
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>
        
                Imports de jquery dataTables
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>


        Codebehind de
        VentanaEstadísticas.php
        <script src="VentanaEstadisticas.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>
        
        Estilos de páginas:
        VentanaEstadísticas.css
        encabezado.css
        <link rel="stylesheet" href="VentanaEstadisticas.css" type="text/css"/>
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css"/>
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        IMPORTS
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

        //<?php
        //require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        //?>

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
        Carga pantalla de advertencia cuando javascript no está habilitado
        <noscript>
            <meta http-equiv="Refresh" content="0; URL=../ClienteDialogo/Errores/JavascriptError.html" >
        </noscript>
    </body>
</html>-->


<?php include_once('../header.php'); ?>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li class="active" ><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
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
          <li><a href="#">Dialogando</a> <span class="divider">/</span></li>
          <li class="active">Estádisticas</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">

	  <h3>Estadísticas</h3>
	  <!--Inicio de las pestañas-->
               
            <div class="tabbable">
            	<ul class="nav nav-tabs">
               		<li class="active"><a href="#1" data-toggle="tab">Balance de Tipos de Movida</a></li>
               		<li><a href="#2" data-toggle="tab">Participación Usuario/Movida</a></li>
               		<li><a href="#3" data-toggle="tab">Participación Usuario/Eje</a></li>
            	</ul>
		          <!--Contenido de las pestañas-->
            	<div class="tab-content">
			       <!--Pestaña Perfiles de Movida-->
		               <div class="tab-pane active" id="1">
				                <h3>Balance de Tipos de Movida</h3>
               			
          			        <!--TABLA --> 

        			     <table class="table table-striped table-bordered" id="grillaPorcentajes">
                  			<thead>
                    				<tr>
                      					<th>Movida</th>
                      					<th>Descripción</th>
                      					<th>Porcentaje (%)</th>
                      					<th>Cantidad</th>
                    				</tr>
                  			</thead>
					<!--Los datos de la tabla varian según el perfil de movida(Kantor clark burbules)-->
                  			<tbody>
                    				<tr>
                      					<td>Dar Perspectiva</td>
                      					<td>Informar sobre lo que sucede en el diálogo</td>
                      					<td >84</td>
                      					<td >6</td>
                      
                    				</tr>

                   
                     
                  			</tbody>
                		</table>
		
          			<!--FIN TABLA PERFIL DE MOVIDA-->
          
			</div>
			<!--Pestaña Reglas de Diálogo-->
			<div class="tab-pane " id="2">
				<h3>Participación Usuario/Movida</h3>
				
				<!--Tabla-->
                                <table class="table table-striped table-bordered" id="grillaUsuarios">
                  			<thead>
                    				<tr>
                      					<th>Participante</th>
							<!--Las demás columnas dependen del perfil de movida, es distinto kantor a clark-->
							<th>Dar Perspectiva</th>
							<th>Mover</th>
							<th>Oponer</th>
							<th>Seguir</th>
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr>
                      					<td>Camilo</td>
							<td>1</td>
							<td>2</td>
							<td>0</td>
							<td>3</td>
                    				</tr>
                 		 	</tbody>
				</table>
			</div>
			<!--Pestaña Permisos de Acceso-->
			<div class="tab-pane " id="3">
				<h3>Participación Usuario/Eje</h3>
				
				<!--Tabla (se debe llenar luego, posee datosde ejemplo)-->
				<table class="table table-striped table-bordered" id="grillaEje">
                  			<thead>
                    				<tr>
                      					<th>Participante</th>
							<th>Buscar Entender</th>
							<th>Darse a Entender</th>
							
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr>
                      					<td>Camilo</td>
							<td>4</td>
							<td>2</td>
                    				</tr>  
						  
                  			</tbody>
                		</table>
			</div>
             	</div>                            
            </div>
        </div><!-- #main-content -->
</div><!-- content -->
<?php include_once('../footer.php'); ?>
