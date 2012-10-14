$(function(){
    $("#passwordRecoveryForm").dialog({
        title: "Recuperación de contraseña",
        autoOpen : false,
        height : 250,
        width : 450,
        modal : true,
        draggable : false,
        resizable : false,
        zIndex: 3000,
        buttons : {
            "Recuperar contraseña" : function() {
                mee.btnRecuperar_Click();
                
            },
            "Volver" : function() {
                
                $("#correo").val("").focus();
                $("#passwordRecoveryForm").dialog("close");
                $("#errorLabel").css({
                    'color' : 'inherit',
                    'font-weight' : 'inherit'
                }).text("Campos con * son obligatorios.");
                
            }
        },
        close : function() {
            $("#errorLabel").css({
                'color' : 'inherit',
                'font-weight' : 'inherit'
            }).text("Campos con * son obligatorios.");
        }
    });
    
    {
        _vntn = new RecuperacionContrasena();
    }
});


function RecuperacionContrasena(){
    mee = this;
    
}

RecuperacionContrasena.prototype.btnRecuperar_Click=function(){
    var controladorRegistro = new CValidacionUsuario();
    
    var usuario = $("#usr").val();
        
    if(usuario == "") {
        mee.mostrarError("Debe ingresar su nombre de usuario (login).");
        return;
    }
    
    //Consultar a la base de datos por el email.
    //par: email.
    var _exito = controladorRegistro.verificarUsuario(usuario);
    
    if(_exito){
        var _lblMensajeError = $("#errorLabel");
        _lblMensajeError.show("slide", null, "500", null);
        _lblMensajeError.css({
            'color' : 'green',
            'font-weight' : 'bold'
        });

        _lblMensajeError.text("Datos enviados a la dirección registrada.");
    }else{
        mee.mostrarError("El usuario registrado no existe en el sistema.");
    }
}

RecuperacionContrasena.prototype.mostrarError = function(mensaje) {
    var _lblMensajeError = $("#errorLabel");
    _lblMensajeError.show("slide", null, "500", null);
    _lblMensajeError.css({
        'color' : 'red',
        'font-weight' : 'bold'
    });

    _lblMensajeError.text(mensaje);
}

/*Procedimiento que restaura el mensaje en pantalla a su valor original.*/
//[NUEVO]
RecuperacionContrasena.prototype.restablecerError = function(mensaje) {
    $("#errorLabel").css({
        'color' : 'inherit',
        'font-weight' : 'inherit'
    });
    $("#errorLabel").text(mensaje);
}
