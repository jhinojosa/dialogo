<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Instalación del sistema para el diálogo remoto</title>
        <link rel="stylesheet" href="960g_6col/reset.css">
        <link rel="stylesheet" href="960g_6col/text.css">
        <link rel="stylesheet" href="960g_6col/grid.css">
        <link rel="stylesheet" href="configurar/configuracion.css">
        <script type="text/javascript" src="javascript/jQuery-1.7.2/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="configurar/configuracion.js"></script>
        <script type="text/javascript" src="javascript/blockUI/jquery.blockUI.js"></script>
    </head>
    <body>
        <div class="container_6">
            <div class="grid_6 titulo">Configuración de la base de datos</div>

            <div class="push_1 grid_3 prefix_1 form">

                <div class="row"><div class="grid_1 campo">Servidor: </div><div class="grid_1"><input name="servidor" id="servidor" type="text"></div></div>
                <div class="row"><div class="grid_1 campo">Puerto: </div><div class="grid_1"><input name="puerto" id="puerto" type="text"></div></div>
                <div class="row"><div class="grid_1 campo">Base de datos: </div><div class="grid_1"><input name="basededatos" id="basededatos" type="text"></div></div>
                <div class="row"><div class="grid_1 campo">Usuario: </div><div class="grid_1"><input name="usuario" id="usuario" type="text"></div></div>
                <div class="row"><div class="grid_1 campo">Contraseña: </div><div class="grid_1"><input name="contrasegna" id="contrasegna" type="password"></div></div>
<!--                    <div class="row"><div class="grid_1 campo">Repetir contraseña: </div><div class="grid_1"><input name="contrasegna2" id="contrasegna2" type="text"></div></div>-->
                <div class="row botones"><div class="grid_1 boton"><button id="configurarbd">Configurar BD</button></div><div class="grid_1 boton"><button id="Limpiar">Limpiar</button></div></div>

            </div>
            <div id="mensaje" class="grid_6 mensaje"></div>
        </div>
        <div class="clear"></div>
        <div class="container_6">
            <div class="grid_6 titulo" id="tituloConfigBdArchivos">Configuración de la base de datos para archivos</div>

            <div class="push_1 grid_3 prefix_1 form">

                <div class="row botones"><div class="grid_2 boton"><button id="configurarbdarchivos">Crear base de datos para archivos</button></div></div>

            </div>
            <div id="mensaje2" class="grid_6 mensaje"></div>
        </div>

        <div class="clear"></div>
<!--        <div class="container_6">
            <div class="grid_6 titulo" id="tituloConfigServicio">Configuración de parámetros de servicioDialogo</div>

            <div class="grid_5 prefix_1 form">

                <div class="row"><div class="grid_2 campo">Zona horaria: </div><div class="grid_2"><input name="zonahoraria" id="zonahoraria" type="text"></div></div>
                <div class="row"><div class="grid_2 campo">Carpeta de imágenes: </div><div class="grid_2"><input name="imagenes" id="imagenes" type="text"></div></div>
                <div class="row"><div class="grid_2 campo">Directorio de archivos sqlite: </div><div class="grid_2"><input name="sqlite" id="sqlite" type="text"></div></div>
                <div class="row"><div class="grid_2 campo">Imagen de usuario por defecto: </div><div class="grid_2"><input name="defaultavatar" id="defaultavatar" type="text"></div></div>
                
                <div class="row botones"><div class="grid_2 boton"><button id="cambiarParametros">Modificar</button></div></div>

            </div>
            <div id="mensaje3" class="grid_6 mensaje"></div>
        </div>-->


    </body>
</html>
