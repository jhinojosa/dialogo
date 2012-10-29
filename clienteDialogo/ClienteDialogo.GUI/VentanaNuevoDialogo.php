<?php include_once('../header.php'); ?>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li class="active" ><a id="btnNuevoDialogo" href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
                    <li ><a id="btnVerMarcadores" href="#"><i class="icon-star"></i> Marcadores</a></li>
                    <li ><a id="btnBuscarIntervenciones" href="#"><i class="icon-eye-open"></i> Intervenciones</a></li>
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
	        <li class="active">Nuevo Diálogo</li>
        </ul>
  	</div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">
		<div class="row" id="titulo-nuevo-dialogo">
			<div class="span10">
				<h1>Nuevo Diálogo</h1>
			</div>
		</div><!-- #titulo-nuevo-dialogo -->
		<div class="row" id="fila1-nuevo-dialogo">
			<div class="span8">
				<h5>Título del Diálogo</h5>
				<input id="txtTitulo" type="text" class="input-xxlarge" placeholder="">
			</div>
			<?php
                include('Controls/controlEscrituraIntervencion.php');
            ?>
            <div id="dialogo-config" class="span4">
                <h5>Configuración del diálogo</h5>
                <p class="text-info">Perfil de Movidas: <strong><a id="txtPerfilMovidasSeleccionado">perfiles de movidas aquí</a></strong></p>
                <p class="text-info">Reglas: <strong><a id="txtReglasSeleccionadas">reglas aquí</a></strong></p>
                <p class="text-info">Restricciones: <strong><a id="txtRestriccionesSeleccionadas">restricciones aquí</a></strong></p>
                <a id="btnAbrirConfiguracion" class="btn btn-small" href="#"> Cambiar Configuración</a>
            </div>
        </div><!-- #fila2-nuevo-dialogo -->

    </div><!-- #main-content -->
</div><!-- #content -->

<?php include_once('../footer.php'); ?>