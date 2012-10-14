<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--[if lt IE 7]> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" class="no-js"> <!--<![endif]-->

<head>

<title>XHTML</title>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Description" />
<meta name="keywords" content="" />
<meta name="robots" content="all" />
<meta name="author" content="Author"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css-->
<link rel="stylesheet/less" type="text/css" href="style.less">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<!-- /css-->

<!-- modernizr -->
<!--<script type="text/javascript" src="js/modernizr.js"></script>-->
<!-- /modernizr -->

</head>
<body>

    <div id = "warning">
        
        <!--[if IE 6]>
        <p>
            La versión de Internet Explorer que est&aacute;s utilizando
            no está actualizada. <br />
            Este sitio funcionar&aacute; mejor si actualizas tu navegador.
            <a href="http://www.microsoft.com/latam/windows/internet-explorer/">Actualizar Internet Explorer</a>
        </p>
        <![endif]-->
        
        <noscript>
            <p>
                Es necesario que tengas activado Javascript en su navegador 
                para utilizar todas las funciones de este sitio.
                <a href="#">
                    &iquest;C&oacute;mo activar Javascript?
                </a>
            </p>
        </noscript>
    </div><!-- #warning -->
    

    <div id="page" class="container">
        <div id="header" class="row">

            <div id="app-logo" class="span2">
                <img src="img/html/app-logo.png" alt="" />
            </div><!-- #app-logo -->

            <div id="app-title" class="span4">
                <h5>Universidad de Santiago de Chile <br>
                    Departamento de Ingeniería Informática</h5>
                <h3>Diálogo Remoto</h3>
            </div><!-- #app-title -->

            <div id="top-login" class="span6">

                <form id="login" class="form-inline">
                    <legend>Iniciar Sesión</legend>
                    <div id="top-user">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" class="input-medium" placeholder="Nombre de Usuario">
                        </div>
                    </div>        
                    <div id="top-password">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input type="password" class="input-small" placeholder="Contraseña">
                        </div>
                        <a href="#olvido-contrasena" data-toggle="modal">¿Olvido su Contraseña?</a>                
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form><!-- form #login -->

                <div class="modal hide fade in" id="olvido-contrasena" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Recuperación de Contraseña</h3>
                    </div>
                    <div class="modal-body">
                        <form id="" class="form-horizontal">
                            <div class="control-group">
                                <label for="" class="control-label">Ingrese Usuario <i class="icon-user"></i></label>
                                <div class="controls">
                                    <input type="text" placeholder="ej: jperez">
                                    <span class="help-block">Ingrese el nombre de usuario del cual desea recuperar la contraseña</span>
				    <span class="help-block">ó</span>
                                </div>
                            </div>
			    <div class="control-group">
                                <label for="" class="control-label">Ingrese dirección de correo electrónico  <i class="icon-user"></i></label>
                                <div class="controls">
                                    <input type="text" placeholder="ej: jperez@helloworld.com">
                                    <span class="help-block">Ingrese la dirección de correo electrónico del usuario del cual desea recuperar la contraseña</span>				
                                </div>
				<p></p>
				<p># Le será enviado un mail con las instrucciones para recuperar la contraseña</p>
                            </div>
                        </form>    
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Volver</button>
                        <button class="btn btn-primary">Recuperar Contraseña</button>
                    </div>
                </div><!-- #olvido-contrasena --> 

            </div><!-- #top-login -->
                               
        </div><!-- #header -->
        

        <div id="menu-bar" class="row">
            <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
                        <ul class="nav">
                            <li class="active"><a href="#"><i class="icon-home"></i> Portada</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="#"><i class="icon-question-sign"></i> Ayuda</a></li>
                            <li><a href="#">Acerca de</a></li>
                        </ul>
                    </div>
                </div>    
            </div>  
        </div><!-- #menu-bar -->

        <div id="barra-estado" class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li class="active"><i class="icon-home"></i> Portada</li>
            </ul>
          </div> <!-- #barra-estado -->
        </div>

        <div class="row" id="content">

            <div id="1st-col-home" class="span6">
                <div class="hero-unit">
                    
                    <h3>¿Qué es...</h3>
                    <h1>Diálogo Remoto?</h1>
                    <p><br>Diálogo Remoto es una aplicación de código abierto desarrollada como producto de un proyecto de migración, en el contexto del trabajo de titulación del alumno Cristian Alberto Chávez Ramos, para la carrera de Ingeniería de Ejecución en Computación e Informática de la Universidad de Santiago de Chile.</p>
                    <p>
                        <a class="btn btn-info btn-large">
                            Saber más
                        </a>
                    </p>
                </div>
            </div>

            <div id="2nd-col-home" class="span6" >
                <form id="register-form" class="form-horizontal">
                    <legend>Regístrate</legend>
                    <div class="control-group">
                        <label for="" class="control-label">Nombre de Usuario <i class="icon-user"></i></label>
                        <div class="controls">
                            <input type="text" placeholder="ej: jperez">
                            <span class="help-block">Solo letras y números sin caracteres especiales</span>
                            <span class="help-block">Este será tu usuario para iniciar sesión</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="" class="control-label">Nombre Completo <i class="icon-leaf"></i></label>
                        <div class="controls">
                            <input type="text" placeholder="ej: Juan Pérez"/>
                            <span class="help-block">Ingresa tu Nombre y Apellido</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email <i class="icon-envelope"></i></label>
                        <div class="controls">
                            <input type="text" id="inputEmail" placeholder="ej: jperez@helloworld.com">
                            <span class="help-block">Ingresar un e-mail válido que se usará para confirmar tu registro</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Contraseña <i class="icon-lock"></i></label>
                        <div class="controls">
                            <input type="password" id="inputPassword" placeholder="">
                            <span class="help-block">La contraseña debe tener entre 6 a 10 caracteres</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Confirme Contraseña <i class="icon-lock"></i></label>
                        <div class="controls">
                            <input type="password" id="inputPassword" placeholder="">
                            <span class="help-block">Repita la contraseña para asegurar que se ingresará correctamente</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- #content -->

<?php include_once('footer.php'); ?>
