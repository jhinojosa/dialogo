<?php include_once('../header.php'); ?>
<?php 
    $sesion = htmlspecialchars($_GET["sesionactual"]);
    echo "<input type=\"hidden\" id=\"sesion\" value=\"$sesion\">";
?>
<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li ><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
                    <li ><a href="#" id="btnVerMarcadores"><i class="icon-star"></i> Marcadores</a></li>
                    <li ><a href="#" id="btnBuscarIntervenciones"><i class="icon-eye-open"></i> Intervenciones</a></li>
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
      <li class="active">Alertas</li>
    </ul>
  </div> <!-- #barra-estado -->
</div>
<div id="lista_alertas">
    <div class="row">
        <div id="main-content" class="span12">
          <h3>Diálogos Con Alerta</h3>
        </div>
    </div>
        <table id="grilla" class="table table-striped table-bordered">
            <thead>
                    <tr>
                      <th>idDialogo</th>
                      <th width="25%">Título</th>
                      <th width="12%">Autor</th>
                      <th width="15%">Publicación</th>
                      <th width="18%">Última intervención</th>
                      <th width="15%">Estado</th>
                      <th width="15%"> <span class="help-block"> Visible solo para el Administrador</span></th>     
                    </tr>
                  </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script src="VentanaAlertas.js"></script>
    <script src="Controladores/CMarcadores.js" type="text/javascript"></script>
    <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
    <script src="Controladores/CDialogo.js" type="text/javascript"></script>
    <script src="../ClienteDialogo.GUI/datatypes/Dialogo.js" type="text/javascript"></script>
    <script src="../ClienteDialogo.GUI/datatypes/Acta.js" type="text/javascript"></script>
<?php include_once('../footer.php'); ?>
