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

            <div id="user-panel" class="span6">
                <div id="user-img">
                    <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( "camilo.farfan@usach.cl" ) ) );?>=100" class="img-polaroid">    
                </div><!-- #user-img -->

                <div id="user-options">
                    <h4>Hola Camilo!</h4>
                    <div class="btn-group">
                      <button class="btn btn-small"><i class="icon-wrench"></i> Administrar</button>
                      <button class="btn btn-small"><i class="icon-pencil"></i> Editar Perfil</button>
                      <button class="btn btn-small"><i class="icon-off"></i> Cerrar Sesión</button>
                    </div>    
                </div><!-- #user-options -->
                <div class="clearfix"></div>
            </div><!-- #user-panel -->                          
        </div><!-- #header -->