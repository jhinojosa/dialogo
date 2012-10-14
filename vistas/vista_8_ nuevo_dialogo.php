<?php include_once('header.php'); ?>

<div id="menu-bar" class="row">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                    <li class="active" ><a href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
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
	        <li class="active">Nuevo Diálogo</li>
        </ul>
  	</div> <!-- #barra-estado -->
</div>

<div class="row" id="content">

	<div id="main-content" class="span12">
		<div class="row">
			<div class="span10">
				<h1>Nuevo Diálogo</h1>
			</div>
			<div class="span2">
				<button class="btn btn-primary pull-right">Publicar</button>
			</div>
		</div>
		<div class="row">
			<div class="span8">
				<h5>Título del Diálogo</h5>
				<input type="text" class="input-xxlarge" placeholder="">
			</div>

			<div class="span4">
				<h5>Tipo de Intervención</h5>
				<select class="span3">
					<option>Mover</option>
					<option>Seguir</option>
					<option>Oponer</option>
		       	</select>
		       	<span class="help-inline">Descripción breve</span>
			</div>
		</div>
		<div class="row">
			<div class="span8">
		        <h5>Texto de la Intervención</h5>
				<textarea class="span8" rows="3"></textarea>
			</div>
			<div id="dialogo-config"class="span4">
				<h5>Configuración del diálogo</h5>
				<p class="text-success">Perfil de Movidas: <strong>kantor</strong></p>
				<p class="text-success">Reglas: <strong>0 Reglas</strong></p>
				<p class="text-success">Restricciones: <strong>0 Restricciones</strong></p>
				<a class="btn btn-small" href="configuracion_dialogo.php"> Cambiar Configuración</a>	
			</div>
		</div>


    </div><!-- #main-content -->
</div><!-- #content -->

<?php include_once('footer.php'); ?>
