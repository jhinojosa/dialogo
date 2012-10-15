<?php include_once('header.php'); ?>

	<div id="barra-estado" class="row">
        <div class="span12">
            <ul class="breadcrumb">
                <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
                <li class="active">Nuevo Diálogo</li>
            </ul>
        </div> <!-- #barra-estado -->
    </div>

    <div class="row" id="content">

    </div><!-- #content -->

	<div id="main-content" class="container">
	    <h1>Nuevo Diálogo</h1>         
        <!--inicio de pestañas-->
             
        <div class="tabbable">
        	<ul class="nav nav-tabs">
           		<li class="active"><a href="#1">Nuevo Diálogo</a></li> 
        	</ul>
    		<div class="tab-content">
    			<div id="nuevo-dialogo-pane" class="tab-pane active" id="1">
                    
                    <!-- Grupo 4 Diálogo de advertencia para inputs vacio ver scripts.js -->
                    <div id="nuevo-dialogo-alert" class="alert alert-warning">  
                        <a class="close" data-dismiss="alert">×</a>  
                        <strong>Advertencia:</strong> <p>Debe completar todos los campos</p> 
                    </div>

    				<h3>Nuevo Diálogo</h3>
    				<h5>Título del Diálogo</h5>
    				<input type="text" class="input-large" placeholder="">
    				<h5>Texto de la Intervención</h5>
    				<textarea class="span12" rows="3"></textarea>
    				<h5>Tipo de Intervención</h5>
    				<select>
            			<option>Mover</option>
            			<option>Seguir</option>
            			<option>Oponer</option>
                   	</select>
    				 <span class="help-inline">Descripción breve</span>
    				<!--cambian segun karton burbules etc-->
    				<div class="row-fluid">
    					<div class="span2">Perfil de Movidas</div>
    					<div class="span3"><strong>kantor</strong></div>
    	     		</div>
             		<div class="row-fluid">
    					<div class="span2">Reglas</div>
    					<div class="span3"><strong>0 Reglas</strong></div>
        	     	</div>
    				<div class="row-fluid ">
                  		<div class="span2">Restricciones</div>
                  		<div class="span3"><strong>0 Restricciones</strong></div>
                        <button id="publicar-dialogo" class="btn btn-small pull-right">Publicar</button>
                   		<a class="btn btn-small pull-right "href="configuracion_dialogo.php"> Cambiar Configuración</a>
        		 	</div>
    			</div>
    		</div>
		</div>
    </div><!-- #main-content -->

<?php include_once('footer.php'); ?>
