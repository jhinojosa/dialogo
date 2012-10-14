$(function() {
    $("#btnCerrarSesion").button();
    
    $("#btnAdministrar").button();
    
    $("#cambiarDatos").dialog({
        title: "Cambiar datos de usuario",
        autoOpen : false,
        height : 620,
        width : 400,
        modal : true,
        draggable : false,
        resizable : false,
        zIndex: 3000,
        buttons : {
            "Modificar datos" : function() {
                me.btnModificar_Click();
                
            },
            "Volver" : function() {
                $("#cambiarDatos").dialog("close");
                $("#lblMensajeError").css({
                    'color' : 'inherit',
                    'font-weight' : 'inherit'
                });
                $("#lblMensajeError").text("Campos con * son obligatorios.");
                
            }
        },
        close : function() {
            $("#lblMensajeError").css({
                'color' : 'inherit',
                'font-weight' : 'inherit'
            });
            $("#lblMensajeError").text("Campos con * son obligatorios.");
        }
    });
    
});

function DatosUsuario(){
    me = this;
    try{
        this.resetUploader();
    }catch(ex){
        alert(ex);
    }
    this.usuario;
    
    this.InitializeComponents();
    
}

DatosUsuario.prototype.btnModificar_Click=function(){
    try {
        var _controladorRegistro = new CValidacionUsuario();
        
        var _usuario = $("#name").val().replace(/^(\s|\&nbsp;)*|(\s|\&nbsp;)*$/g, "").toLowerCase();

        for(var i=0;i<_usuario.length ; i++)
            if(_usuario[i] == " "){
                me.mostrarError("Nombre de usuario no debe contener espacios.");
                $("#name").focus();
                return;
            }
        
        var _nombreCompleto = $.trim($("#fullname").val());
        
        if(_nombreCompleto.length == 0){
            me.mostrarError("Ingrese su nombre completo.");
            $("#fullname").focus();
            return;
        } else {
            me.restablecerError("Campos con * son obligatorios.");
        }
        
        if(_usuario.length == 0) {
            me.mostrarError("Ingrese un nombre de usuario (login).");
            $("#name").focus();
            return;
        } else {
            me.restablecerError("Campos con * son obligatorios.");
        }

        if(_usuario.length > 10) {
            me.mostrarError("El nombre usuario debe ser inferior a 10 caracteres.");
            $("#name").focus();
            return;
        } else {
            me.restablecerError("Campos con * son obligatorios.");
        }

        var _email = $("#email").val();
        
        if(_email == "") {
            me.mostrarError("Debe ingresar una dirección de correo electrónico.");
            return;
        }else {
            var _regExp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            if(!_email.match(_regExp)) {
                me.mostrarError("Ingrese un e-mail válido.");
                return;
            } else {
                me.restablecerError("Campos con * son obligatorios.");
            }
        }

        var _oldpass = $("#oldpassword").val();
        var _pass = $("#password").val();
        var _pass2 = $("#password2").val();

        
        if(_oldpass != ""){
            
            if(_pass == "") {
                me.mostrarError("Debe ingresar su nueva contraseña.");
                return;
            } else {
                me.restablecerError("Campos con * son obligatorios.");
            }

            if(_pass != _pass2) {
                me.mostrarError("Las contraseñas no coinciden.");
                return;
            } else {
                me.restablecerError("Campos con * son obligatorios.");
            }
            
        }
        var _archivoImagen = $("#txtUbicacionArchivo").val();

        var _err = "";

        //_resp booleano
        
        var _resp = _controladorRegistro.modificar(_nombreCompleto, _usuario, _oldpass, _pass, _archivoImagen, _email, _err);
        
        //Envía la imagen de avatar de usuario al servidor, y lo almacena en la dirección 
        //especificada por la variable global 
        //línea 173.
        //  document.body.style.cursor = "default";
        

        if(_resp) {
            //Envío de imagen al servidor.
            me.enviarImagen(_usuario.toLowerCase());
            
            //Actualización de los datos en pantalla.
            var nuevo = new Usuario();
            nuevo.nombreCompleto = _nombreCompleto;
            nuevo.nombreUsuario = _usuario;
            nuevo.email = _email;
            me.setUsuario(nuevo);
            
            //ventanaPadre.setUsuario(_usuario);
            //MessageBox.Show(this, "Se registró el usuario. Ingrese sus datos para ingresar al sistema");
            //this.Close();
            var _lblMensajeError = $("#lblMensajeError");
            _lblMensajeError.show("slide", null, "500", null);
            _lblMensajeError.css({
                'color' : 'green',
                'font-weight' : 'bold'
            });
            _lblMensajeError.text("Datos modificados.");
            $("#usuario").val(_usuario.toLowerCase());
            $("#contrasegna").val("");
        } else {
            
            mostrarError(_resp[1]);
        }
        
        

    } catch(err) {
    //document.body.style.cursor = "default";
    }
}

DatosUsuario.prototype.enviarImagen = function(nomUsuario){
    if(uploader._handler._files[uploader._handler._files.length - 1] != null){
        uploader.setParams({
            nombre: JSON.stringify(nomUsuario)
        });
        uploader.submit(uploader._handler._files[uploader._handler._files.length - 1]);
    }
    
    me.resetUploader();
}


DatosUsuario.prototype.InitializeComponents=function(){
    $("#btnCerrarSesion").click(function(){
        me.btnCerrarSesion_Click(this);
    });
    $("#btnAdministrar").hide();
    
    $("#btnAdministrar").click(function(){
        me.btnAdministrar_Click();
    });
    $("#username").click(function(event){
        //        event.preventDefault();
        
        $("#cambiarDatos").dialog("open");
    });
}

DatosUsuario.prototype.resetUploader = function(){
    $("#ultimoArchivoSubido").text("");
    
    uploader = new qq.FileUploader({
        element: $("#subirarchivo")[0],
        action: '../../servicioDialogo/uploads/script/valums-file-uploader/server/php.php',
        allowedExtensions: ["jpeg", "jpg", "gif", "png"],
        sizeLimit: 2097152,  //VALOR DEBE COINCIDIR CON post_max_size Y upload_max_size DE PHP 5
        autoSubmit: false,
        onSubmit: function(id, fileName){
            var file = uploader._handler._files.pop();
            $("#ultimoArchivoSubido").text(file.name);
            uploader._handler._files.push(file);
            return false;
        },
        debug:true,
        multiple: false,
        messages: {
            typeError: "La extensión del archivo {file} es inválida.\nSólo se permiten archivos tipo {extensions}.",
            sizeError: "El archivo {file} es muy grande,\nel tamaño máximo es {sizeLimit}.",
            minSizeError: "El archivo {file} es muy pequeño,\nEl tamaño mínimo es de {minSizeLimit}.",
            emptyError: "El archivo {file} está vacío.\nSeleccione otro archivo.",
            onLeave: "Los archivos están siendo subidos,\nsi abandonas la página se cancelará la subida." 
        },
        showMessage: function(message){
            alert(message);
        }
    });
}

DatosUsuario.prototype.btnCerrarSesion_Click=function(sender){
    //Función no implementada en aplicación original.
    window.open("../ClienteDialogo/InicioSesion.php", "_self");
   
}
DatosUsuario.prototype.btnAdministrar_Click=function(){
    
    window.open("../ClienteDialogo.Admin/VentanaAdministracion.php?idsesion=" + JSON.stringify(window.my.sesionActual.idSesion) + "&usuario=" + JSON.stringify(me.usuario.nombreUsuario));
}

DatosUsuario.prototype.setUsuario=function(usuario) {
    var _csesion = new CSesion();
    me.usuario = usuario;
    usuario.imagen = _csesion.obtenerArchivoUsuario(SesionActual, usuario.nombreUsuario);
    
    var attrib = usuario.imagen + "?nocache=" + new Date().getTime();
    $("#avatar").attr("src", attrib);
    
    //setear <a> con el nombre
    $(".lblNombreUsuario a").html(usuario.nombreCompleto + " (" + usuario.nombreUsuario + ")");

    //setear imagen.

    if(usuario.ROL_ADMINISTRADOR == usuario.Rol) {
        //poner como visible el botón administrar.
        $("#btnAdministrar").show();
    }
    
    /**
     * Configura los valores del cuadro cambiar datos de usuario.
     */
    $("#fullname").val(usuario.nombreCompleto);
    $("#name").attr("disabled","disable").val(usuario.nombreUsuario);
    
    $("#email").val(usuario.email);
    
}       


DatosUsuario.prototype.mostrarError = function(mensaje) {
    var _lblMensajeError = $("#lblMensajeError");
    _lblMensajeError.show("slide", null, "500", null);
    _lblMensajeError.css({
        'color' : 'red',
        'font-weight' : 'bold'
    });

    _lblMensajeError.text(mensaje);
}

/*Procedimiento que restaura el mensaje en pantalla a su valor original.*/
//[NUEVO]
DatosUsuario.prototype.restablecerError = function(mensaje) {
    $("#lblMensajeError").css({
        'color' : 'inherit',
        'font-weight' : 'inherit'
    });
    $("#lblMensajeError").text(mensaje);
}