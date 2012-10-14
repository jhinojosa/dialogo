<div class="imgUsuario">
    <img id="avatar" src="Images/no_user_photo-v1.gif" alt="avatar de usuario" width="50" height="">
</div>
<div class="lblNombreUsuario">
    <a id="username" href="#">Nombre de usuario</a>
</div>
<div id="botonesSesion">

    <button id="btnAdministrar" >Administrar</button>
    <button id="btnCerrarSesion">Cerrar sesión</button>

</div>


<div id="cambiarDatos">
    <p id="lblMensajeError" >
        Campos con * son obligatorios.
    </p>
    
    <form>
        <fieldset>
            <label for="fullname">Nombre completo *</label>
            <input type="text" name="fullname" id="fullname" class="text ui-widget-content ui-corner-all" >
            <label for="name">Login *</label>
            <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" >
            <label for="email">E-mail *</label>
            <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" >
            <label for="oldpassword">Contraseña anterior °</label>
            <input type="password" name="oldpassword" id="oldpassword" value="" class="text ui-widget-content ui-corner-all" >
            <label for="password">Nueva contraseña °</label>
            <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" >
            <label for="password2">Repita la nueva contraseña °</label>
            <input type="password" name="password2" id="password2" value="" class="text ui-widget-content ui-corner-all" >
            <label for="">Seleccione una imagen</label>
            <div>
<!--                <div id="avatarSeleccionadoContainer" style="background-image: url('file:///D:/Mis Documentos/University/Seminario/material/Proyecto de titulo/Program/servicioDialogo/uploads/b.jpg'); ">
                    <img id="avatar" src="http://dialogo/servicioDialogo/uploads/b.jpg" alt="UsrImg" width="50" height="60">
                </div>-->

                <div id="subirarchivo"></div>
                <div id="labelUpload">Tamaño máximo de archivo: 2MB</div>
                <div class="clear"></div>
                <div style="font-size: 11px; text-align: right; font-weight: bold; ">
                    Archivo seleccionado:
                </div>
                <div id="ultimoArchivoSubido">
                </div>
                <!--                    <input type="file" name="txtUbicacionArchivo" id="txtUbicacionArchivo" value="" class="examinar" >-->

            </div>

        </fieldset>
    </form>
</div>