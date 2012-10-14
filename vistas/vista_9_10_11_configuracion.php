<?php include_once('header.php'); ?>
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
               			<h5>Perfil Tipos de Intervención</h5>
				
               			<select>
                    		<option>Kantor</option>
                    		<option>Burbules</option>
                    		<option>Clark</option>
               			</select>
          			<!--TABLA --> 

            			
            			<table class="table table-striped table-bordered">
                  			<thead>
                    				<tr>
                      					<th>Nombre Movida</th>
                      					<th>Descripción</th>
                      					<th>Porcentaje</th>
                      					<th>Tolerancia</th>
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr>
                      					<td>Mover</td>
                      					<td>Iniciar una idea y ofrecer una dirección para la conversación</td>
                      					<td > <input type="text" class="input-small" placeholder="entre 0 y 100"></td>
                      					<td > <input type="text" class="input-small" placeholder="entre 0 y 100"></td>
                      
                    				</tr>

                   
                     
                  			</tbody>
                		</table>
                		
                				
          			<!--FIN TABLA PERFIL DE MOVIDA-->
          
			</div>
			<!--Pestaña Reglas de Diálogo-->
			<div class="tab-pane " id="2">
				<h3>Reglas de Diálogo</h3>
				<h5>Lista de Reglas</h5>
				<!--Tabla de reglas-->
				<table class="table table-striped table-bordered">
                  			<thead>
                    				<tr>
                      					<th width="85%">Regla</th>
                                <th width="15%"> </th>
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr>
                      					<td><a href="#">Reglar 1</a></td>
                                <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button></td>
                    				</tr>
                            <tr>
                                <td><a href="#">Reglar 2</a></td>
                                <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button></td>
                            </tr>
                            <tr>
                                <td><a href="#">Reglar 3</a></td>
                                <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button></td>
                 		 	</tbody>
					<!--En caso de haber reglas se debe revizar escribir las reglas pertinentes con un arreglo-->
               			 </table>
				 <select>
                    			<option>Regla 1</option>
                    			<option>Regla 2</option>
                    			<option>Regla 3</option>
               			 </select>
				 <button class="btn btn-small"> Agregar</button>
          			 <button class="btn btn-small"> Agregar Todas</button>
				
			</div>
			<!--Pestaña Permisos de Acceso-->
			<div class="tab-pane " id="3">
				<h3>Permisos de Acceso</h3>
				<h5>Restringir el Acceso a los Siguientes Usuarios</h5>
				<!--Tabla de usuarios restringidos-->
				<table class="table table-striped table-bordered">
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
			
         	<button class="btn btn-small btn-primary "> Guardar Configuración</button>
			<a class="btn btn-small " href="nuevo_dialogo.php"> Cancelar</a>
                            
            </div>

        </div><!-- #main-content -->
</div><!-- #content -->
<?php include_once('footer.php'); ?>
