<?php include_once('header.php'); ?>
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

        			     <table class="table table-striped table-bordered">
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
				<table class="table table-striped table-bordered">
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
				<table class="table table-striped table-bordered">
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
<?php include_once('footer.php'); ?>
