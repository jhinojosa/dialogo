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
              <li class="active">Diálogos</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

<div class="row" id="content">
<div id="main-content" class="span12">
  <h3>Diálogos Disponibles</h3>
  <div class="btn-group">
  <button class="btn"><i class="icon-plus-sign"></i><i class="icon-comment"></i> Nuevo Diálogo</button>
  <button class="btn"><i class="icon-warning-sign"></i> Alertas</button>
  <button class="btn"><i class="icon-refresh"></i> Refrescar</button>
</div>
	 <form id="buscar-dialogo" class="form-search">
        <div class="input-prepend">
           <span class="add-on"><i class="icon-search"></i> Buscar Diálogo</span>
           <input type="text" class="input-medium search-query">
        </div>
    </form>
    <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="25%">Título</th>
              <th width="12%">Autor</th>
              <th width="15%">Publicación</th>
              <th width="18%">Última intervención</th>
              <th width="15%">Estado</th>
              <th width="15%"> <span class="help-block"> Visible solo para el Administrador</span></td> </th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="ventana_dialogo.php">Grupo 2</a></td>
              <td>Julio</td>
              <td>04-09-2012</td>
              <td>23-09-2012</td>
              <td><span class="label label-important">Desbalanceado</span></td>
              <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button>
              
            </tr>
            <tr>
              <td><a href="ventana_dialogo.php">Grupo 3</a></td>
              <td>Camilo</td>
              <td>04-09-2012</td>
              <td>23-09-2012</td>
              <td><span class="label label-success">Balanceado</span></td>
              <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button></td>
             
            </tr>
            <tr>
              <td><a href="ventana_dialogo.php">Grupo 1</a></td>
              <td>Gonzalo</td>
              <td>04-09-2012</td>
              <td>23-09-2012</td>
              <td><span class="label label-success">Balanceado</span></td>
              <td><button class="btn btn-block btn-small btn-danger"> Eliminar</button></td>
              
            </tr>
          </tbody>
    </table>
</div><!-- #main-content -->
</div><!-- #content -->

<?php include_once('footer.php'); ?>
