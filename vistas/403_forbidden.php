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
    <link rel="stylesheet/less" type="text/css" href="static_files/style.less">
    <link rel="stylesheet" href="static_files/bootstrap.css" type="text/css" media="screen" />
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
                <img src="static_files/app-logo.png" alt="" />
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
                                    </div>
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

        <div id="1st-col-home" class="span12">
            <div class="hero-unit">

                <h1>Página Prohibida</h1>
                <p><br>Lo sentimos, no posee suficentes permisos para acceder al contenido que solicita.<br>
                    Para mayor información, le recomendamos visitar la
                    <a class="btn" href="#"><i class="icon-question-sign"></i> Ayuda</a>
                </p>
                
            </div>
        </div>
    </div><!-- #content -->

    <?php include_once('static_files/footer.php'); ?>