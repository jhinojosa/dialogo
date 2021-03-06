$(function() {
    $('#ingresar').button();
    $("#limpiar").button();
   
    

    $(".menu").show('slide', null, 'slow', null);
   
    $("#isInternetExplorer").dialog({
        autoOpen:false,
        draggable: false,
        resizable: false,
        modal: true,
        title: "Navegador no compatible"
    });

    
    {
        _vtn = new InicioSesion();
    }
});



function InicioSesion(){
    me=this;
    
    this.usuario;
    this.sesion;
    this.InitializeComponents();
    
}

InicioSesion.prototype.InitializeComponents=function(){
    $("#usuario").val("");
    $("#contrasegna").val("");
    
    $("#usuario").focus();
    
    $("#ingresar").click(function(){
        me.btnEntrar_Click();
    });
    $("#limpiar").click(function(){
        me.btnLimpiar_Click();
    });
    $("#contrasegna").keyup(function(event){
        if(event.keyCode == 13){
            $("#ingresar").trigger('click');
        }
    });
    $("#registrar").click(function(){
        //Abre el diálogo de registro de usuario.
        $("#dialog-form").dialog("open");
    });
    
    $("#forgotPassword").click(function(){
        //Abre el diálogo de registro de usuario.
        $("#passwordRecoveryForm").dialog("open");
    });
    
}

InicioSesion.prototype.btnLimpiar_Click=function(){
    $("#usuario").val("");
    $("#contrasegna").val("");
}

InicioSesion.prototype.btnEntrar_Click=function(){
    
    this.usuario = $("#usuario").val().toLowerCase();
    
    var password = $("#contrasegna").val();
    
    $("body").css("cursor","wait");
    $("#ingresar").button({
        disabled: true
    });
    
    var _controlador = new CValidacionUsuario();
    //Sesion
    this.sesion = _controlador.iniciarSesion(JSON.stringify(this.usuario), JSON.stringify(password));
    
    $("body").css("cursor","default");
    $("#ingresar").button({
        disabled: false
    });
    
    if(this.sesion != null && this.sesion.MensajeError != null){
        //Notificar sesion.MensajeError.
        notificar(this.sesion.MensajeError);
    }else{
        //Entrar al programa.
        $("#usuario").val("");
        $("#contrasegna").val("");
        if(typeof(this.sesion) == "undefined"){
            notificar("Error al establecer la conexión");
        }else
            window.open("../ClienteDialogo.GUI/VentanaPrincipal.php?usuario="+JSON.stringify(this.usuario)+"&idsesion="+JSON.stringify(this.sesion.idSesion) ,"_self" );
        
    }
}




