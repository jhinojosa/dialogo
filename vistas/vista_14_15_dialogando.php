<?php include_once('header.php'); ?>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li class="active"><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
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
        	<li class="active">Dialogando</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">


	<div id="main-content" class="span12">

	  <h3>Nombre Diálogo</h3>
<!--Inicio de las pestañas-->
               
            <div class="tabbable">
            	<ul class="nav nav-tabs">
               		<li class="active"><a href="#1" data-toggle="tab">Explorador de diálogo</a></li>
               		<li><a href="#2" data-toggle="tab">Acerca del diálogo</a></li>
					<li><a href="#3" data-toggle="tab">Actas del diálogo</a></li>
            	</ul>
				<!--Contenido de las pestañas-->
            	<div class="tab-content">
				<!--Pestaña Explorador de diálogo-->
					<div class="tab-pane active" id="1">
						<button class="btn btn-small pull-right"><i class="icon-refresh"></i> Refrescar</button>
						<!-- Cuadro con la navegación del diálogo -->
						<h3>Explorador de Diálogo</h3>
							<div id="controlHilo">
								<!-- Incluir la ruta al archivo DialogBrowser.php -->
								<p>Aquí va la llamada al módulo "DialogBrowser" para mostrar el cuadro con las movidas dentro del diálogo</p>
								<?php
								include('./Controls/DialogBrowser.php');
								?>
							</div>
						<!-- Cuadro con el árbol de intervenciones -->
		                <h3>Árbol de intervenciones</h3>
		                    <div id="Navegador" class="ui-corner-all">
								<!-- Incluir la ruta al archivo NavegadorHilo.php -->
								<p>Aquí va la llamada al módulo "Navegador" para mostrar el árbol de intervenciones</p>
								<?php
								include('./Controls/NavegadorHilo.php');
								?>
							</div>
		            </div>

					<!--Pestaña Acerca del diálogo-->
					<div class="tab-pane " id="2">
						<h3>Acerca del Diálogo</h3>
						<!-- Fomulario con los datos del diálogo -->
						<div class="row" id="Tarjeta con información del diálogo">
								<div class="span4">
									<h5>Título</h5>
									<p class="text-success">Título de diálogo</p>
								</div>
								<div class="span3">
									<h5>Fecha de creación</h5>
									<p class="text-success">01-01-0000</p>
								</div>
								<div class="span1"><img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( "camilo.farfan@usach.cl" ) ) );?>=50" class="img-polaroid"></div>
								<div class="span3">
									<h5>Nombre del creador</h5>
									<p class="text-success">Juanito Pérez</p>
								</div>
						</div>
						<!-- Botones "Ver estadísticas" y "Configurar" -->
						<div class="btn-group">
							<a class="btn btn-small" href="estadisticas_dialogo.php"><i class="icon-signal"></i> Ver estadísticas</a>
							<a class="btn btn-small"><i class="icon-wrench"></i> Configuración</a>
						</div>
						<!-- Tabla con las reglas -->
						
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
									  <th>Reglas</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td>Regla N°1</td>
									</tr>
									<tr>
										<td>Regla N°2</td>
									</tr>
									<tr>
									  <td>Regla N°3</td>
									</tr>
								</tbody>
							</table>
							<div class="row-fluid">
							  <div class="span12">Mostrando 3 reglas asociadas</div>
							</div>
						
						<!-- Sección correspondiente al Acta dialogal -->
						<div>
							<!-- Acta dialogal -->
							<h4>Acta dialogal</h4>
							<p>El CSS debe interpretar este campo de texto para agregarle las herramientas de edición</p>
							<div>
		                        <textarea id="txtActaUsuario" rows="8" class="span12" ></textarea>
								<div class="clear"></div>
							</div>
							<!-- Botones asociados al acta dialogal -->
							<div>
								<button class="btn btn-small pull-left"><i class="icon-list-alt"></i> Ver todas las actas</button>
								<button class="btn btn-small btn-primary pull-right"><i class="icon-hdd icon-white"></i> Guardar Acta</button>
							</div>
						</div>
					</div>			
			<!--Pestaña Actas del diálogo -->
			<div class="tab-pane " id="3">
				<h3>Actas del Diálogo</h3>
				<h5>Seleccione Usuario</h5>
				<select>
				  <option>Juanito Perez</option>
				  <option>John Doe</option>
				  <option>Perico Palote</option>
				</select>
				<h5>Acta</h5>
				<textarea id="txtActaUsuario" rows="8" class="span12" ></textarea>
			</div>
				</div>                           
            </div>
        </div><!-- #main-content -->
  </div><!-- #content -->

<?php include_once('footer.php'); ?>
