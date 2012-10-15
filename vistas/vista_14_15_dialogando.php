<?php include_once('header.php'); ?>

<div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
	      <li><a href="#">Diálogos Disponibles</a> <span class="divider">/</span></li>
              <li class="active">Dialogando</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

        <div class="row" id="content">
          
        </div><!-- #content -->
	<div id="main-content" class="span12">

	  <h1>Nombre Diálogo</h1>
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
				<div class="row-fluid" id="Tarjeta con información del diálogo">
						<div class="span2"><img src="Images/no_user_photo-v1.gif" class="img-rounded" width="140" height="154"></div>
						<div class="span6">
							<dl>
								<dt>Título</dt>
								<dd>Título de diálogo</dd>
								<dt>Nombre del creador</dt>
								<dd>Juanito Pérez</dd>
								<dt>Fecha de creación</dt>
								<dd>01-01-0000</dd>
							</dl>
						</div>
				</div>
				<!-- Botones "Ver estadísticas" y "Configurar" -->
				<div>
					<a class="btn btn-small pull-left" href="estadisticas_dialogo.php"><i class="icon-signal"></i> Ver estadísticas</a>
					<button class="btn btn-small pull-right"><i class="icon-wrench"></i> Configuración</button>
				</div>
				<!-- Tabla con las reglas -->
				
					<table class="table table-striped">
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
						<button class="btn btn-small pull-right"><i class="icon-hdd"></i> Guardar Acta</button>
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

<?php include_once('footer.php'); ?>
