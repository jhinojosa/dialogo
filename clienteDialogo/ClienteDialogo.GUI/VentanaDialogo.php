<?php
session_start();

// Está la asesion iniciada? o nos están intentando embaucar??
if( !isset($_SESSION['user_email']) ) {
    
    // Se realiza una redireccion
    header('Location: ../../') ;
}

$user_username = $_SESSION['user_username'];
$user_fullname = $_SESSION['user_fullname'];
$user_email = $_SESSION['user_email'];
$user_gravatar = 'http://www.gravatar.com/avatar/' . md5($user_email) . '/?s=90' ;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sistema para el diálogo remoto</title>
        
        

        <!--Estilos de 960grid-->
        <link rel="stylesheet" href="../CSS/960g_6col/grid.css" type="text/css">
        

        <!--Hoja de estilos jQueryUI-->
        <link rel="stylesheet" href="../CSS/jQueryUI/custom-theme/jquery.ui.all.css" type="text/css">

        <!--Javascript de jQuery-->
        <script src="../Javascript/jQuery/jQuery-1.7.2/jquery-1.7.2.min.js" type="text/javascript"></script>

        <!--Javascript de JqueryUI-->
        <script src="../Javascript/jQuery/jquery-ui-1.8.20.custom-USACH/jquery-ui-1.8.20.custom.min.js" type="text/javascript"></script>

        <!--Imports de jquery.dataTables-->
        <script src="../Javascript/jQuery/DataTables-1.9.1/media/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/DataTables-1.9.1/media/css/jquery.dataTables_themeroller.css" type="text/css"/>

        <!--jQuery contextMenu-->
        <script src="../Javascript/jQuery/jquery.contextMenu/jquery.contextMenu.js" type="text/javascript"></script>

        <!--Import de SOAP CLIENT-->
        <script src="../Javascript/soapclient2.1/soapclient21.js" type="text/javascript"></script>

        <!--Import jWYSIWYG-->
        <script src="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/jwysiwyg/jwysiwyg/jquery.wysiwyg.css" type="text/css">

        <!--Import jqTree -->
        <script src="../Javascript/jQuery/jqTree/tree.jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../Javascript/jQuery/jqTree/jqtree.css" type="text/css">

       <!-- BlockUI -->
       <script src="../Javascript/jQuery/blockUI/jquery.blockUI.js" type="text/javascript"></script>
       
       
        <!--Codebehind de
        VentanaDialogo.php
        controlEscrituraIntervencion.php-->
        <script src="Controls/controlEscrituraIntervencion.js" type="text/javascript"></script>
        <script src="VentanaDialogo.js" type="text/javascript"></script>
        <script src="Controls/NavegadorHilo.js" type="text/javascript"></script>
        <script src="Controls/contextMenus/responderContextMenu.js" type="text/javascript"></script>
        <script src="Controls/ControlNotificacion/ControlNotificacion.js" type="text/javascript"></script>

        <!--Estilos de páginas:
        VentanaMarcadores.css
        encabezado.css
        controlEscrituraIntervencion.css-->
        <link rel="stylesheet" href="VentanaDialogo.css" type="text/css">
        <link rel="stylesheet" href="CSS/encabezado.css" type="text/css">
        <link rel="stylesheet" href="Controls/ControlNotificacion/ControlNotificacion.css" type="text/css">

        <!--        <link rel="stylesheet" href="VentanaDialogo.css" type="text/css">-->
        <!--<link rel="stylesheet" href="Controls/controlEscrituraIntervencion.css" type="text/css"/>-->

        <!--IMPORTS-->
        <script src="datatypes/Intervencion.js" type="text/javascript"></script>
        <script src="datatypes/Acta.js" type="text/javascript"></script>
        <script src="datatypes/Nota.js" type="text/javascript"></script>
        <script src="datatypes/Usuario.js" type="text/javascript"></script>
        <script src="datatypes/Dialogo.js" type="text/javascript"></script>
        <script src="datatypes/Movida.js" type="text/javascript"></script>
        <script src="datatypes/Balance.js" type="text/javascript"></script>
        <script src="datatypes/Regla.js" type="text/javascript"></script>
        <script src="datatypes/CategoriaMovida.js" type="text/javascript"></script>
        <script src="datatypes/Marcador.js" type="text/javascript"></script>
        <script src="datatypes/MovidaCorregida.js" type="text/javascript"></script>
        <script src="Controladores/CDialogo.js" type="text/javascript"></script>
        <script src="Controladores/CNotas.js" type="text/javascript"></script>
        <script src="Controladores/CActa.js" type="text/javascript"></script>
        <script src="Controladores/ConexionManager.js" type="text/javascript"></script>
        <script src="Controladores/CMarcadores.js" type="text/javascript"></script>
        <script src="Controladores/CSesion.js" type="text/javascript"></script>


        <!--controlDisplayTextoIntervencion-->
        <link rel="stylesheet" href="Controls/controlDisplayTextoIntervencion.css" type="text/css"/>
        <script src="Controls/controlDisplayTextoIntervencion.js" type="text/javascript"></script>

        <!--tipsy-->
        <link rel="stylesheet" href="../Javascript/jQuery/tipsy/src/stylesheets/tipsy.css">
        <script src="../Javascript/jQuery/tipsy/src/javascripts/jquery.tipsy.js"></script>  

        <!--DialogBrowser-->
        <link rel="stylesheet" href="Controls/DialogBrowser.css" type="text/css">
        <script src="Controls/DialogBrowser.js" type="text/javascript"></script>

        <!--[if lt IE 9]>
        <script src="../Javascript/ie7/IE9.js" type="text/javascript"></script>
        <![endif]-->
        
        <!-- css -->
        <link rel="stylesheet/less" type="text/css" href="../estilos/style.less">
        <link rel="stylesheet" href="../estilos/css/bootstrap.css" type="text/css" media="screen" />

        <!-- /css-->
    </head>

    <body>
    
        <?php
        $sesionActual = htmlspecialchars($_GET['sesionActual']);
        $idDialogo = $_GET['idDialogo'];

        if ($_GET['idIntervencion'] != null || $_GET['idIntervencion'] != "") {
            $idIntervencion = $_GET['idIntervencion'];
            echo "<input type=\"hidden\" id=\"idIntervencion\" value=\"$idIntervencion\">";
        }

        echo "<input type=\"hidden\" id=\"sesionActual\" value=\"$sesionActual\">";
        echo "<input type=\"hidden\" id=\"idDialogo\" value=\"$idDialogo\">";
        ?>

        <?php
        require_once 'Controls/ControlNotificacion/ControlNotificacion.php';
        ?>
        <!--Menú contextual.-->
        <?php
        include('Controls/contextMenus/responderContextMenu.php');
        ?>


        <!--
        Elemento de ayuda para los tipos de movida.
        -->
        <div id="moves" style="width: 450px; text-align: center; position: fixed; z-index: 9999998">
            <img src="Images/dialogo.jpg">
            <p style="text-align: justify;">
                De esta figura se desprende que en el diálogo cada participante busca darse a 
                entender (mediante el mover y el oponer) y entender (mediante el observar y el 
                seguir). Si estas movidas son hechas en el ambiente de respeto que se ha 
                descrito y el facilitador logra mantener las opiniones dentro de la línea del 
                tema el aprendizaje es casi inevitable.
            </p>
        </div>
        
<div id="page" class="container wide">
    <div id="header" class="row">
        <div id="app-logo" class="span2">
            <img src="../estilos/img/html/app-logo.png" alt="" />
        </div><!-- #app-logo -->
        <div id="app-title" class="span4">
            <h5>Universidad de Santiago de Chile <br>
            Departamento de Ingeniería Informática</h5>
            <h3>Diálogo Remoto</h3>
        </div><!-- #app-title -->

        <div id="user-panel" class="span6">
            <div id="user-img">
                <img src="<?php echo $user_gravatar; ?>" class="img-polaroid">    
            </div><!-- #user-img -->

            <div id="user-options">
                <h4>Hola <?php echo $user_fullname; ?>!</h4>
                <div class="btn-group">
                    <button id="btnAdministrar" class="btn btn-small"><i class="icon-wrench"></i> Administrar</button>
                    <button id="username" class="btn btn-small"><i class="icon-pencil"></i> Editar Perfil</button>
                    <button id="btnCerrarSesion" class="btn btn-small"><i class="icon-off"></i> Cerrar Sesión</button>
                </div>    
            </div><!-- #user-options -->
            <div class="clearfix"></div>
        </div><!-- #user-panel -->                          
    </div><!-- #header -->
    
    <div id="menu-bar" class="row">
        <div class="span12">
            <div class="navbar">
                <div class="navbar-inner">
                    <ul class="nav">
                        <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                        <li class="active"><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
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
          <li><a href="#">Diálogos</a> <span class="divider">/</span></li>
          <li class="active">Diálogos</li>
        </ul>
      </div> <!-- #barra-estado -->
    </div>
        
    <div class="row">
        <div  class="tabbable span12">
            <ul class="nav nav-tabs">
                
                <li class="active"><a href="#tab2" class="active" data-toggle="tab" id="anchor2">Explorador de diálogo</a></li>
                <li><a href="#tab1" data-toggle="tab" id="anchor1">Acerca del diálogo</a></li>
                <!--<li id="todasActas" data-toggle="tab"><a href="#tab3">Actas del diálogo</a></li>-->
            </ul>
            <div class="tab-content">
                <div id="tab1" class="tab-pane">
                    
                    <div class="row">
                        <div class="span12" id="encabezadoTab1">
                            <div id="imagenUsuario" class="grid_1">
                                <img src="Images/no_user_photo-v1.gif" alt="no-user" width="50" height="">
                            </div>
                            <div id="datos" class="span4">
                                <div class="grid_1">Título:</div>
                                <div id="lblTitulo"class="data grid_3">título aquí</div>
                                <div class="grid_1">Nombre del creador:</div>
                                <div id="lblNombreUsuario" class="data grid_3">nombre de usuario aquí</div>
                                <div class="grid_1">Fecha de creación:</div>
                                <div id="lblFechaCreacion" class="data grid_3">fecha de creación aquí</div>
                            </div>
                            <div class="clear"></div>
                            
                            <div>
                                <button class="button" id="btnVerEstadisticas">Ver estadísticas</button>
                            </div>
                            <div class="clear"></div>
                            <div id="btnsRefPar">
                                <button class="btn" id="btnConfigurar">Configurar</button>
                                <button class="btn" id="btnParticipar">Participar</button>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div><!-- .row -->
                    
                    <div class="clear"></div>
                    
                    <table id="dgReglas" class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>Reglas Asociadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>No se han encontrado reglas asociadas al diálogo</th>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="clear"></div>
                    
                    <h3>Acta dialogal</h3>
                    <div id="txtArea">
                        <textarea id="txtActaUsuario" rows="8" cols="110"></textarea>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="container">
                        <button class="btn" id="btnGuardarActa">Guardar acta</button>
                        <button class="btn" id="btnVerTodasActas">Ver todas las actas</button>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div id="listado_actas">
                        <div>
                            <h6>Por favor seleccione un usuario</h6>
                            <div class="clear"></div>
                            <div>
                                <select id="cmbUsuarios">
                                    <option>Usuario 1</option>
                                    <option>Usuario 2</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                            <div id="lblActa">
                                <h6>Acta asociada</h6>
                            </div>
                            <div id="cntndrActaOtroUsuario">
                                <div id="txtActaOtroUsuario" class="ui-corner-all"></div>
                                <!-- <textarea id="txtActaOtroUsuario" rows="8" cols="110"></textarea> -->
                            </div>
                            <div class="clear" style="height: 20px;"></div>
                        </div>
                    </div><!-- #listado_actas -->
                </div><!-- #tab1 -->

                <div id="tab2" class="tab-pane active">
                    <div id="btnRefrescarContainer">
                        <button id="btnRefrescar">Refrescar</button>
                    </div>
                    <div class="clear" style="heigth:10px;"></div>
                    <div id="browserNav">
                        <div class="ui-widget" style="font-size:12px;"><b>Navegador del diálogo:</b></div>
                        <div id="controlHilo">
                            <?php
                                include('./Controls/DialogBrowser.php');
                            ?>
                        </div>

                        <div class="clear" style="height:20px;"></div>
                        <div class="ui-widget" style="font-size:12px;"><b>Árbol de intervenciones:</b></div>
                        <div id="Navegador" class="ui-corner-all">
                            <?php
                                //include('./Controls/controlDisplayTextoIntervencion.php');
                                include('./Controls/NavegadorHilo.php');
                            ?>
                        </div>
                    </div>

                    <div id="controlTab">
                        <ul>
                        </ul>
                    </div>
                </div><!-- #tab2 -->

            </div><!-- .tab-content -->
        </div><!-- .tabbable -->
    </div><!-- .row -->
    
    <a name="final"></a>
    
    <div class="row">
        <div id="footer" class="span12">
            <div class="row">
            <div class="span10">
            <h5>Universidad de Santiago de Chile <br>
            Departamento de Ingeniería Informática</h5>
            <p>Aplicación Web resultado de la Memoria de Título de Cristian Chávez R.<br>
            Usabilidad mejorada por parte de los alumnos de la Asignatura Interacción Humano Computador,<br>
            Segundo Semestre de 2012</p>
            </div>
            <div id="usach-footer" class="span2">
            <a href="http://www.usach.cl/"><img src="../estilos/img/html/usach-white.png" alt="" /></a>
            </div>
            </div>
        </div>
    </div>

</div><!-- #page -->

<div id="agradecimientos">
<div class="container">
<div class="row">
<div class="span12">
<p>
En el desarrollo de esta aplicación se utilizaron herramientas y bibliotecas licenciadas 
bajo código abierto.
</p>

<a href="http://jquery.com/" target="_blank">jQuery</a>

<a href="http://twitter.github.com/bootstrap/" target="_blank">Twitter Bootstrap</a>
<a href="http://valums.com/ajax-upload/" target="_blank">Valums file uploader</a>
<a href="http://javascriptsoapclient.codeplex.com/" target="_blank">Javascript SOAP Client 2.4</a>
<a href="http://onehackoranother.com/projects/jquery/tipsy/" target="_blank">Tipsy</a>
<a href="https://github.com/akzhan/jwysiwyg/" target="_blank">Jwysiwyg</a>
<a href="http://medialize.github.com/jQuery-contextMenu/" target="_blank">JQuery context menu</a>
<a href="http://mbraak.github.com/jqTree/" target="_blank">JqTree</a>
<a href="http://www.appelsiini.net/projects/jeditable" target="_blank">JEditable</a>
<a href="http://datatables.net/" target="_blank">JQuery Data Tables</a>
<a href="http://sourceforge.net/projects/nusoap/" target="_blank">NuSOAP</a>
<a href="http://www.php.net/" target="_blank">PHP</a>
</div>
</div>
</div>
</div>
    
<!-- javascript -->
<script type="text/javascript" src="../estilos/js/bootstrap.js"></script>
<script type="text/javascript" src="../estilos/js/less-1.3.0.min.js"></script>
<!-- /javascript -->
<script type="text/javascript">
    $('#ayuda-index').affix({
        offset: {
          top: 240,
          bottom: 500
        }
    })    
</script>


</body>
</html>
