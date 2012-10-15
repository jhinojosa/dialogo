<?php include_once('header.php'); ?>

        <div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
              <li class="active">Intervenciones</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

        <div class="row" id="content">
          
        </div><!-- #content -->
	<div id="main-content" class="span12">

	  <h1>Intervenciones</h1>
            
<!--Pestañas-->
	                  
	   <div class="tabbable">
		<ul class="nav nav-tabs">
               		<li class="active"><a href="#1">Intervenciones</a></li> 
            	</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="1">
				<h3>Intervenciones</h3>
				
              			<form id="buscar-dialogo" class="form-search">
          				<div class="input-prepend " >
           					<span class="add-on">
	    						<i class="icon-search"></i>Buscar Usuario</span>
           					<input type="text" class="input-medium search-query">
          				</div>
         			</form>
              			
               			<table class="table table-striped table-bordered">
                  			<thead>
                    				<tr>
                      					<th>Diálogo</th>
                      					<th>Texto</th>
                    				</tr>
                  			</thead>
                  			<tbody>
                    				<tr>
                      					<td><a href="#">Título Ejemplo</a></td>
                      					<td>este es el texto de ejemplo del Diálogo</td>
						</tr>
                  			</tbody>
                		</table>

			</div>
		</div>
	   </div>

        </div><!-- #main-content -->

<?php include_once('footer.php'); ?>
