<?php include_once('header.php'); ?>
	<div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
              <li class="active">Diálogos Disponibles</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

        <div class="row" id="content">
          
        </div><!-- #content -->
	<div id="main-content" class="span12">
	<h1>Diálogos Disponibles</h1>

 <div class="tabbable">

	<ul class="nav nav-tabs">
				    <li class="active"><a href="#1" data-toggle="tab">Diálogos Disponibles</a></li>
			
	</ul>
<div class="tab-content">
  <div class="tab-pane active" id="1">
	<h3>Diálogos Disponibles</h3>
	<!--<div id="main-content" class="span12">-->

	 <form id="buscar-dialogo" class="form-search">
          <div class="input-prepend " >
           <span class="add-on">
	    <i class="icon-search"></i>
		 Buscar Diálogo
	   </span>
           <input type="text" class="input-medium search-query">
          </div>
         </form>
	 <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Autor</th>
                      <th>Publicación</th>
                      <th>Última intervención</th>
                      <th>Estado</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="ventana_dialogo.php">Grupo 2</a></td>
                      <td>Julio</td>
                      <td>04-09-2012</td>
                      <td>23-09-2012</td>
                      <td><span class="label label-important">Desbalanceado</span></td>
                      
                    </tr>
                    <tr>
                      <td><a href="ventana_dialogo.php">Grupo 3</a></td>
                      <td>Camilo</td>
                      <td>04-09-2012</td>
                      <td>23-09-2012</td>
                      <td><span class="label label-success">Balanceado</span></td>
                     
                    </tr>
                    <tr>
                      <td><a href="ventana_dialogo.php">Grupo 1</a></td>
                      <td>Gonzalo</td>
                      <td>04-09-2012</td>
                      <td>23-09-2012</td>
                      <td><span class="label label-success">Balanceado</span></td>
                      
                    </tr>
                  </tbody>
         </table>

</div>
</div>
</div>
        </div><!-- #main-content -->

<?php include_once('footer.php'); ?>
