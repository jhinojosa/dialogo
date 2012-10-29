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
          <li class="active">Alertas</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">

	<h3>Alertas</h3>
         
<!-----------------------------------------Pestañas---------------------------------------------------->
              	<div class="tabbable">
			<ul class="nav nav-tabs">
               			<li class="active"><a href="#1" data-toggle="tab">Dialogos Desbalanceados</a></li>
				            <li><a href="#2" class="muted">Sugerencias</a></li> 
            		</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="1">
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
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>Kaks</td>
                                  <td>ayer</td>
                                  <td>ahora</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>Kaks</td>
                                  <td>ayer</td>
                                  <td>ahora</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>Kaks</td>
                                  <td>ayer</td>
                                  <td>ahora</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>Kaks</td>
                                  <td>ayer</td>
                                  <td>ahora</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>Kaks</td>
                                  <td>ayer</td>
                                  <td>ahora</td>
                              </tr>
                  					</tbody>
                			</table>

          				<!--FIN TABLA MARCADORES-->
				</div>
				<div class="tab-pane active" id="2">
				</div>
			</div>
		</div>

        </div><!-- #main-content -->
  </div><!-- #content -->
<?php include_once('footer.php'); ?>
