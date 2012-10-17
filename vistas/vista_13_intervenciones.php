<?php include_once('header.php'); ?>
<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li ><a href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
                    <li ><a href="#"><i class="icon-star"></i> Marcadores</a></li>
                    <li class="active" ><a href="#"><i class="icon-eye-open"></i> Intervenciones</a></li>
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
          <li class="active">Intervenciones</li>
        </ul>
    </div> <!-- #barra-estado -->
</div>

<div class="row" id="content">


	<div id="main-content" class="span12">
            
<!--Pestañas-->
	                  
	   <div class="tabbable">
		<div class="tab-content">
			<div class="tab-pane active" id="1">
				<h3>Intervenciones</h3>
				<form id="buscar-dialogo" class="form-search">
        				<div class="input-prepend">
           			 		<span class="add-on"><i class="icon-search"></i> Buscar Intervención</span>
           			 		<input type="text" class="input-medium search-query">
					     </div>
               <span class="help-block">Ingrese autor o parte del texto del diálogo que busca.</span>
				</form>
				<!--TABLA BUSCAR INTERVENCIONES--> 
              			
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
                            <tr>
                                <td><a href="#">Título Ejemplo</a></td>
                                <td>este es el texto de ejemplo del Diálogo</td>
                            </tr>
                            <tr>
                                <td><a href="#">Título Ejemplo</a></td>
                                <td>este es el texto de ejemplo del Diálogo</td>
                            </tr>
                            <tr>
                                <td><a href="#">Título Ejemplo</a></td>
                                <td>este es el texto de ejemplo del Diálogo</td>
                            </tr>
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
      </div><!-- #content -->

<?php include_once('footer.php'); ?>
