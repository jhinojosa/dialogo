<?php include_once('../header.php'); ?>
<?php 
    $sesion = htmlspecialchars($_GET["sesionactual"]);
    echo "<input type=\"hidden\" id=\"sesion\" value=\"$sesion\">";
?>

<div id="lista_alertas">
    <div id="main-content" class="span12">
      <h3>Diálogos Con Alerta</h3>
      
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
