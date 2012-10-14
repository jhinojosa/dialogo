<?php include_once('header.php'); ?>
<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li ><a href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
                    <li class="active" ><a href="#"><i class="icon-star"></i> Marcadores</a></li>
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
          <li class="active">Marcadores</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">
         
<!-----------------------------------------Pestañas---------------------------------------------------->
              	<div class="tabbable">

			<div class="tab-content">
				<div class="tab-pane active" id="1">
					<h3>Marcadores</h3>
					 <!--TABLA MARCADORES--> 
            
            				<table class="table table-striped table-bordered">
                  				<thead>
                    					<tr>
                      						<th>Diálogo</th>
                      						<th>Texto</th>
                    					</tr>
                  				</thead>
                  				<tbody>
                    					<tr>
                      						<td><a href="#">Título Ejemplo 2</a></td>
                      						<td>estas es mi intervención favorita en el diálogo</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>estas es mi intervención favorita en el diálogo</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>estas es mi intervención favorita en el diálogo</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>estas es mi intervención favorita en el diálogo</td>
                              </tr>
                              <tr>
                                  <td><a href="#">Título Ejemplo 2</a></td>
                                  <td>estas es mi intervención favorita en el diálogo</td>
                              </tr>
                					</tbody>
                			</table>

          				<!--FIN TABLA MARCADORES-->
				</div>
			</div>
		</div>

        </div><!-- #main-content -->
      </div><!-- #content -->

<?php include_once('footer.php'); ?>
