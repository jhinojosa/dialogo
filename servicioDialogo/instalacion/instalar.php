<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Instalación del sistema para el diálogo remoto</title>
        <link rel="stylesheet" href="960g_6col/reset.css">
        <link rel="stylesheet" href="960g_6col/text.css">
        <link rel="stylesheet" href="960g_6col/grid.css">
        <link rel="stylesheet" href="instalar/instalacion.css">
        <script type="text/javascript" src="javascript/jQuery-1.7.2/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="instalar/instalacion.js"></script>
        <script type="text/javascript" src="javascript/blockUI/jquery.blockUI.js"></script>
    </head>
    <body>
        <div class="container_6">
            <div class="grid_6" id="titulo">Instalación de datos iniciales en la base de datos</div>
            
            <div id="form" class="push_1 grid_3 prefix_1">
               
                    <div class="row"><div class="grid_1 campo">Servidor: </div><div class="grid_1"><input name="servidor" id="servidor" type="text"></div></div>
                    <div class="row"><div class="grid_1 campo">Puerto: </div><div class="grid_1"><input name="puerto" id="puerto" type="text"></div></div>
                    <div class="row"><div class="grid_1 campo">Base de datos: </div><div class="grid_1"><input name="basededatos" id="basededatos" type="text"></div></div>
                    <div class="row"><div class="grid_1 campo">Usuario: </div><div class="grid_1"><input name="usuario" id="usuario" type="text"></div></div>
                    <div class="row"><div class="grid_1 campo">Contraseña: </div><div class="grid_1"><input name="contrasegna" id="contrasegna" type="password"></div></div>
<!--                    <div class="row"><div class="grid_1 campo">Repetir contraseña: </div><div class="grid_1"><input name="contrasegna2" id="contrasegna2" type="text"></div></div>-->
                    <div class="row botones"><div class="grid_1 boton"><button id="instalar">Instalar</button></div><div class="grid_1 boton"><input type="reset" value="Limpiar"></div></div>
               
            </div>
            <div id="mensaje" class="grid_6"></div>
        </div>
        

    </body>
</html>