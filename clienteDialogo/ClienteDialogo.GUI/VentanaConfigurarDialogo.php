<?php include_once('../header.php'); ?>

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
				<div class="tab-pane " id="#">
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

		<button id="btnGuardar" class="btn btn-small btn-primary"> Guardar Configuración</button>
			<a id="btnCancelar" class="btn btn-small" href="VentanaNuevoDialogo.php"> Cancelar</a>
            </div>		
        </div>
	
	
<script src="VentanaConfigurarDialogo.js" type="text/javascript"></script>	
<?php include_once('../footer.php'); ?>
