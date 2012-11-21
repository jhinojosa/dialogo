<?php include_once('../header.php'); ?>
<script src="VentanaRegistro.js" type="text/javascript"></script>
        <div id="menu-bar" class="row">
            <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
                        <ul class="nav">
                            <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                            <li ><a href="#"><i class="icon-comment"></i> Diálogos</a></li>
                            <li ><a href="#" id="btnVerMarcadores"><i class="icon-star"></i> Marcadores</a></li>
                            <li ><a href="#" id="btnBuscarIntervencioness"><i class="icon-eye-open"></i> Intervencionesss</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="#"><i class="icon-question-sign"></i> Ayuda</a></li>
                            <li><a href="VentanaAcercaDe.php" id='btnAcercaDe'><i class="icon-info-sign"></i> Acerca de</a></li>
                        </ul>
                    </div>
                </div>    
            </div>  
        </div><!-- #menu-bar -->

        <div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i> Portada</a> <span class="divider">/</span></li>
              <li class="active">Editar Perfil</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

<div class="row" id="content">
	<div id="main-content" class="span12">


<?php include_once('../../servicioDialogo/editarusuario/usuario.php');?>
<!-- ----------------------------------- if post, guardamos-------------------------------------------- -->
<?php
$c=new usuario();
if(array_key_exists('id_nombre', $_POST)){
	if ($_POST['id_nombre']){
	$info=$c->update_nombre($usuario,$_POST['id_nombre']);

	if($info==1) {

?>
	<div class="alert alert-warninGg alert-success">
	<strong></strong> <span>Se ha modificado el nombre</span>
	</div>

<?php
}
	}
}

if(array_key_exists('id_mail', $_POST)){
	if ($_POST['id_mail']){

	$info=$c->update_mail($usuario,$_POST['id_mail']);
	if($info==1) {

?>
	<div class="alert alert-warninGg alert-success">
	<strong></strong> <span>Se ha modificado el email</span>
	</div>

<?php
}
	if($info==-1) {

?>
	<div id="lblMensajeError" class="alert alert-warninGg alert-error">
	<strong>Error!</strong> <span>El email ingresado no es correcto</span>
	</div>

<?php
}
	}
}

if(array_key_exists('id_clave', $_POST)){
	if ($_POST['id_clave']){

	$info=$c->update_clave($usuario,$_POST['id_clavea'],$_POST['id_clave'],$_POST['id_clave1']);
	if($info==-1) {

?>
	<div id="lblMensajeError" class="alert alert-warninGg alert-error">
	<strong>Error!</strong> <span>Ambas contraseñas deben coincidir</span>
	</div>

<?php
}
	if($info==-2) {

?>
	<div id="lblMensajeError" class="alert alert-warninGg alert-error">
	<strong>Error!</strong> <span>La contraseña ingresada no es correcta</span>
	</div>

<?php
}

	if($info==1) {

?>
	<div class="alert alert-warninGg alert-success">
	<strong></strong> <span>Se ha modificado la contraseña</span>
	</div>

<?php
}

	}
}
?>
<!-- ----------------------------------- datos para poblar email y nombre------------------------------ -->
<?php $c=new usuario();
$usuario = htmlspecialchars($_GET['usuario']);
$info=$c->get_user($usuario);
$idsesion = htmlspecialchars($_GET['idsesion']);

?> 
<!-- ----------------------------------- Inicio Pestañas ---------------------------------------------- -->
	  <h1>Editando perfil <?php echo $info['x_nombre_completo']; ?> </h1>

    <div class="tabbable">
			    <ul class="nav nav-tabs">
				    <li class="active"><a href="#1" data-toggle="tab">Cambiar Nombre</a></li>
				    <li><a href="#2" data-toggle="tab">Cambiar Email</a></li>
 				    <li><a href="#3" data-toggle="tab">Cambiar Contraseña</a></li>
				    
			    </ul>
			    <div class="tab-content">
				    <div class="tab-pane active" id="1">
						 <h3>Cambiar Nombre</h3>
						<form action ="<?php echo 'EditarPerfil.php?idsesion='.$idsesion .'&usuario='.$usuario ?>" METHOD  ='POST' class="form-horizontal">






						    <div class="control-group">
							<label class="control-label" for="nom_a">Nombre Actual</label>
							<div class="controls">
							    <input type="text" id="idk" value="<?php echo $info['x_nombre_completo']; ?>" disabled="disabled">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Nuevo Nombre</label>
							<div class="controls">
							    <input type="text" name="id_nombre" id="id_nombre" placeholder="Camila Farfána">
							</div>
						  </div>
		 				<div class="control-group">
							<div class="controls">
								
<input type="SUBMIT" id="confirmar" class="btn btn-large btn-primary" value="Confirmar">
							</div>
					    </div>
						  
						</form>

				    </div>
				    <div class="tab-pane" id="2">
						 <h3>Cambiar Email</h3>
						<form action ="<?php echo 'EditarPerfil.php?idsesion='.$idsesion .'&usuario='.$usuario ?>" METHOD  ='POST' class="form-horizontal">
						    <div class="control-group">
							<label class="control-label" for="email_a">Email Actual</label>
							<div class="controls">
							    <input type="text" id="email_a" value="<?php echo $info['x_email_usuario']; ?>" disabled="disabled">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Nuevo Email</label>
							<div class="controls">
							    <input type="text" id="id_mail" name="id_mail" placeholder="X_CamiloxHx@udla.cl">
							</div>
						  </div>
		 				<div class="control-group">
							<div class="controls">
								<input type="SUBMIT" id="confirmar" class="btn btn-large btn-primary" value="Confirmar">

							</div>
						    </div>
						  
						</form>
				    </div>
                    <div class="tab-pane" id="3">
				    	 <h3>Cambiar Contraseñal</h3>
						<form action ="<?php echo 'EditarPerfil.php?idsesion='.$idsesion .'&usuario='.$usuario ?>" METHOD  ='POST' class="form-horizontal">
						    <div class="control-group">
							<label class="control-label" >Contraseña actual</label>
							<div class="controls">
							    <input type="password"  name="id_clavea" placeholder="Contraseña actual">
							</div>
						    </div>
						    <div class="control-group">
							<label class="control-label" >Nueva contraseña</label>
							<div class="controls">
							    <input type="password" name="id_clave" placeholder="Nueva contraseña">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Repita nueva contraseña</label>
							<div class="controls">
							    <input type="password" name="id_clave1" placeholder="Nueva contraseña">
							</div>
						  </div>
						 
		 				<div class="control-group">
							<div class="controls">
								<input type="SUBMIT" id="confirmar" class="btn btn-large btn-primary" value="Confirmar">
							</div>
					    </div>
						  
						</form>
				    </div>
				    
			    </div>
		    </div>
<!-- ----------------------------------- Fin Pestañas ------------------------------------------------- -->

        </div><!-- #main-content -->
</div><!-- #content -->
<!--</div>-->

<?php include_once('../footer.php'); ?>
