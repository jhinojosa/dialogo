$(function() {

    $('#registrar').button();
/*
    //dialogForm
    $("#dialog-form").dialog({
        title: "Registro de un nuevo usuario",
        autoOpen : false,
        height : 620,
        width : 400,
        modal : true,
        draggable : false,
        resizable : false,
        zIndex: 3000,
        buttons : {
            "Registrar" : function() {
                my.btnRegistrar_Click();
                
            },
            "Volver" : function() {
                $("#contrasegna").focus();
                $("#dialog-form").dialog("close");
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
   */
    //Instancia VentanaRegistro..
    {
        _vtn = new VentanaRegistro();
    }
    
});

function VentanaRegistro(){
    my = this;
    this.InitializeComponents();
    this.resetUploader();
}

VentanaRegistro.prototype.InitializeComponents = function(){
    $("#registrar").click(function(){
        my.btnRegistrar_Click();
    });
}

VentanaRegistro.prototype.resetUploader = function(){
    /*$("#ultimoArchivoSubido").text("");
    
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
    });*/
}

VentanaRegistro.prototype.enviarImagen = function(nomUsuario){
    /*if(uploader._handler._files[uploader._handler._files.length - 1] != null){
        uploader.setParams({
            nombre: JSON.stringify(nomUsuario)
        });
        uploader.submit(uploader._handler._files[uploader._handler._files.length - 1]);
    }
    
    my.resetUploader();*/
}

VentanaRegistro.prototype.btnRegistrar_Click = function() {
    
    try {
        //document.body.style.cursor = "wait";
        var _controladorRegistro = new CValidacionUsuario();
        
        var _usuario = $("#name").val().replace(/^(\s|\&nbsp;)*|(\s|\&nbsp;)*$/g, "").toLowerCase();
        for(var i=0;i<_usuario.length ; i++)
            if(_usuario[i] == " "){
                my.mostrarError("Nombre de usuario no debe contener espacios.");
                $("#name").focus();
                $("#name-form").addClass("error");
                return;
            }

        if(_usuario.length == 0) {
            my.mostrarError("Ingrese un nombre de usuario (login).");
            $("#name").focus();
            $("#name-form").addClass("error");
            return;
        } else {
            //my.restablecerError("Campos con * son obligatorios.");
            $("#name-form").removeClass("error");
        }

        if(_usuario.length > 10) {
            my.mostrarError("El nombre usuario debe ser inferior a 10 caracteres.");
            $("#name").focus();
            $("#name-form").addClass("error");
            return;
        } else {
            //my.restablecerError("Campos con * son obligatorios.");
            $("#name-form").removeClass("error");
        }
        
        var _nombreCompleto = $.trim($("#fullname").val());

        if(_nombreCompleto.length == 0){
            my.mostrarError("Ingrese su nombre completo.");
            $("#fullname").focus();
            $("#fullname-form").addClass("error");
            return;
        } else {
            //my.restablecerError("Campos con * son obligatorios.");
            $("#fullname-form").removeClass("error");
        }
        


        var _email = $("#email").val();

        if(_email == "") {
            my.mostrarError("Debe ingresar una dirección de correo electrónico.");
            $("#email-form").addClass("error");
            $("#email").focus();
            return;
        }else {
            var _regExp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            if(!_email.match(_regExp)) {
                my.mostrarError("Ingrese un e-mail válido.");
                $("#email-form").addClass("error");
                $("#email").focus();
                return;
            } else {
                //my.restablecerError("Campos con * son obligatorios.");
                $("#email-form").removeClass("error");
            }
        }

        var _pass = $("#password").val();
        var _pass2 = $("#password2").val();
        
        
        if(_pass == "") {
            my.mostrarError("Debe ingresar una contraseña.");
            $("#pass-form").addClass("error");
            $("#pass").focus();
            return;
        } else {
            //my.restablecerError("Campos con * son obligatorios.");
            $("#pass-form").removeClass("error");
        }

        if(_pass != _pass2) {
            my.mostrarError("Las contraseñas no coinciden.");
            $("#pass2-form").addClass("error");
            $("#pass2").focus();
            return;
        } else {
            //my.restablecerError("Campos con * son obligatorios.");
            $("#pass2-form").removeClass("error");
        }



        var _archivoImagen = $("#txtUbicacionArchivo").val();

        var _err = "";

        //_resp booleano
        
        var _resp = _controladorRegistro.registrar(_nombreCompleto, _usuario, _pass, _archivoImagen, _email, _err);
        
        //Envía la imagen de avatar de usuario al servidor, y lo almacena en la dirección 
        //especificada por la variable global 
        //línea 173.
        //  document.body.style.cursor = "default";
        

        if(_resp[0]) {
            //Envío de imagen al servidor.
            //my.enviarImagen(_usuario.toLowerCase());
            
            //ventanaPadre.setUsuario(_usuario);
            //MessageBox.Show(this, "Se registró el usuario. Ingrese sus datos para ingresar al sistema");
            //this.Close();
            var _lblMensajeError = $("#lblMensajeError");
            _lblMensajeError.removeClass("alert-warning");
            _lblMensajeError.removeClass("alert-error");
            _lblMensajeError.addClass("alert-success");
            _lblMensajeError.show("slide", null, "500", null);
            /*_lblMensajeError.css({
                'color' : 'green',
                'font-weight' : 'bold'
            });*/
            _lblMensajeError.text("Se registró el usuario.");

            $("#usuario").val(_usuario.toLowerCase());
            $("#contrasegna").val("");
            $("#contrasegna").focus();
            $('html,body').animate({scrollTop: '0px'}, 400);
        } else {
            alert(_resp[1]);
            mostrarError(_resp[1]);
        }
        
        

    } catch(err) {
    //document.body.style.cursor = "default";
    }
}

VentanaRegistro.prototype.mostrarError = function(mensaje) {
    var _lblMensajeError = $("#lblMensajeError");
    _lblMensajeError.removeClass("alert-warning");
    _lblMensajeError.addClass("alert-error");
    _lblMensajeError.show("slide", null, "500", null);
    /*_lblMensajeError.css({
        'color' : 'red',
        'font-weight' : 'bold'
    });*/

    _lblMensajeError.text(mensaje);
}

/*Procedimiento que restaura el mensaje en pantalla a su valor original.*/
//[NUEVO]
VentanaRegistro.prototype.restablecerError = function(mensaje) {
    /*$("#lblMensajeError").css({
        'color' : 'inherit',
        'font-weight' : 'inherit'
    });*/
    _lblMensajeError.removeClass("alert-error");
    _lblMensajeError.addClass("alert-warning");
    $("#lblMensajeError").text(mensaje);
}