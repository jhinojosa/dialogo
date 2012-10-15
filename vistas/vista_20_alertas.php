<?php include_once('header.php'); ?>

        <div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
              <li class="active">Alertas</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

        <div class="row" id="content">
          
        </div><!-- #content -->

	<div id="main-content" class="span12">

	<h1>Alertas</h1>
         
<!-----------------------------------------Pestañas---------------------------------------------------->
              	<div class="tabbable">
			<ul class="nav nav-tabs">
               			<li class="active"><a href="#1" data-toggle="tab">Dialogos Desbalanceados</a></li>
				<li><a href="#2" data-toggle="tab">Sugerencias</a></li> 
            		</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="1">
					<h3>Diálogos Desbalanceados</h3>
					 <!--TABLA MARCADORES--> 
            				
					<form id="buscar-dialogo" class="form-search">
          					<div class="input-prepend " >
           						<span class="add-on"><i class="icon-search"></i>Buscar Diálogo</span>
           						<input type="text" class="input-medium search-query">
          					</div>
         				</form>
            				<table class="table table-striped table-bordered">
                  				<thead>
                    					<tr>
                      						<th>Título</th>
                      						<th>Autor</th>
								<th>Publicación</th>

								<th>Última Intervención</th>

								


                    					</tr>
                  				</thead>
                  				<tbody>
                    					<tr>
                      						<td><a href="#">Título Ejemplo 2</a></td>
                      						<td>Kaks</td>
								<td>ayer</td>
								<td>ahora</td>
                  					</tbody>
                			</table>

          				<!--FIN TABLA MARCADORES-->
				</div>
				<div class="tab-pane active" id="2">
				</div>
			</div>
		</div>

        </div><!-- #main-content -->
<?php include_once('footer.php'); ?>
