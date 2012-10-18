<?php include_once('header.php'); ?>
		<div id="menu-bar" class="row">
            <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
                        <ul class="nav">
                            <li ><a href="#"><i class="icon-home"></i> Portada</a></li>
                            <li ><a href="#"><i class="icon-comment"></i> Nuevo Diálogo</a></li>
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
              <li class="active">Editar Perfil</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

<div class="row" id="content">
	<div id="main-content" class="span12">

	  <h1>Editando perfil Camilo Farfán</h1>
<!-- ----------------------------------- Inicio Pestañas ---------------------------------------------- -->
		    <div class="tabbable">
			    <ul class="nav nav-tabs">
				    <li class="active"><a href="#1" data-toggle="tab">Cambiar Nombre</a></li>
				    <li><a href="#2" data-toggle="tab">Cambiar Email</a></li>
 				    <li><a href="#3" data-toggle="tab">Cambiar Contraseña</a></li>
				    
			    </ul>
			    <div class="tab-content">
				    <div class="tab-pane active" id="1">
						 <h3>Cambiar Nombre</h3>
						<form class="form-horizontal">
						    <div class="control-group">
							<label class="control-label" for="nom_a">Nombre Actual</label>
							<div class="controls">
							    <input type="text" id="nom_a" value="Camilo Farfán" disabled="disabled">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Nuevo Nombre</label>
							<div class="controls">
							    <input type="text" id="nom_n" placeholder="Camila Farfána">
							</div>
						  </div>
		 				<div class="control-group">
							<div class="controls">
								<button id="confirmar" class="btn btn-large btn-primary" type="button">Confirmar</button>
							</div>
					    </div>
						  
						</form>

				    </div>
				    <div class="tab-pane" id="2">
						 <h3>Cambiar Email</h3>
						<form class="form-horizontal">
						    <div class="control-group">
							<label class="control-label" for="email_a">Email Actual</label>
							<div class="controls">
							    <input type="text" id="email_a" value="camilo.farfan@usach.cl" disabled="disabled">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Nuevo Email</label>
							<div class="controls">
							    <input type="text" id="nom_n" placeholder="X_CamiloxHx@udla.cl">
							</div>
						  </div>
		 				<div class="control-group">
							<div class="controls">
								<button id="confirmar" class="btn btn-large btn-primary" type="button">Confirmar</button>
							</div>
						    </div>
						  
						</form>
				    </div>
                    <div class="tab-pane" id="3">
				    	 <h3>Cambiar Contraseñal</h3>
						<form class="form-horizontal">
						    <div class="control-group">
							<label class="control-label" >Contraseña actual</label>
							<div class="controls">
							    <input type="password"  placeholder="Contraseña actual">
							</div>
						    </div>
						    <div class="control-group">
							<label class="control-label" >Nueva contraseña</label>
							<div class="controls">
							    <input type="password" placeholder="Nueva contraseña">
							</div>
						    </div>
						 <div class="control-group">
							<label class="control-label" for="nom_n">Repita nueva contraseña</label>
							<div class="controls">
							    <input type="password" id="nom_n" placeholder="Nueva contraseña">
							</div>
						  </div>
						 
		 				<div class="control-group">
							<div class="controls">
								<button id="confirmar" class="btn btn-large btn-primary" type="button">Confirmar</button>
							</div>
					    </div>
						  
						</form>
				    </div>
				    
			    </div>
		    </div>
<!-- ----------------------------------- Fin Pestañas ------------------------------------------------- -->

        </div><!-- #main-content -->
    </div><!-- #content -->

<?php include_once('footer.php'); ?>
