$(function() {
    
    $("#btnEditarPerfil").button();	
    /*$("#btnNuevoDialogo").button({
        icons : {
            primary : 'ui-icon-plusthick'
        }
    });*/
    /*$("#btnVerMarcadores").button({
        icons : {
            primary : 'ui-icon-star'
        }
    });

    $("#btnBuscarIntervenciones").button({
        icons : {
            primary : 'ui-icon-search'
        }
    });

    $("#btnVerAlertas").button({
        icons : {
            primary : 'ui-icon-alert'
        }
    });

    $("#btnRefrescar").button({
        icons : {
            primary : 'ui-icon-refresh'
        }
    });*/
    
    //parámetros usuario e idSesion vienen de inicioSesion.
    //valores obetnidos desde servicio web.
    //    var inicioSesion = opener.InicioSesion;
    //    if(inicioSesion != null){
    //        
    //        _ventanaPrincipal = new VentanaPrincipal(opener.me.usuario, opener.me.sesion.idSesion);
    //        
    //    }

    {
        var usuario = JSON.parse($("#usuarioM").val());
        var idsesion = JSON.parse($("#idsesion").val());
        _ventanaPrincipal = new VentanaPrincipal(usuario, idsesion);
    }
});


// Ventana principal, permite ingresar a los diálogos.
//  definición de clase y constructor.
//string usuario, string idSesion.
function VentanaPrincipal(usuario, idSesion) {
    my = this;
    
    //Sesion
    this.sesionActual = new Sesion();
    try {
        controller = new CSesion();
        
        this.sesionActual = controller.obtenerSesion(usuario, idSesion);
        SesionActual = this.sesionActual;
        //_sesionAct = sesionActual;
        _controlador = new CDialogo(this.sesionActual);
        
        //setUsuario del control DatosUsuario
        var controlDatosUsuario = new DatosUsuario();
        controlDatosUsuario.setUsuario(this.sesionActual.usuario);
        
       
        
        controlListaDialogos = new controlListaDialogos(this.sesionActual.usuario);
        
        this.actualizarListaDialogos1(this.sesionActual);
        
        this.InitializeComponents();
        
        if(_controlador.hayDialogosDesbalanceados()){
        //boton ver alertas BOLD
        //btnVer alertas tooltip: Atención: Hay diálogos desbalanceados.
        }else{//
            $("#btnVerAlertas").hide();
        }
    } catch(ex) {
    }
    vNuevoDialogo = new Array();
    vDialogo = new Array();
    
    document.title="Sistema para el diálogo remoto - " + this.sesionActual.usuario.nombreCompleto;
    
}

/**
 * Actualización automática de la lista de diálogos.
 */
window.setInterval(function update(){
    my.actualizarListaDialogos();
    }, 30000);



window.onbeforeunload=function(){
    try{
        vAlertas.close();
    }catch(ex){}
    try{
        vBusqueda.close();
    }catch(ex){}
    try{
        vMarcadores.close();
    }catch(ex){}
    try{
        for(var i=0;i<vNuevoDialogo.length;i++){
            vNuevoDialogo[i].close();
        }
    }catch(ex){}
    try{
        for(i=0;i<vDialogo.length;i++){
            vDialogo[i].close();
        }
    }catch(ex){}
}

VentanaPrincipal.prototype.InitializeComponents=function(){
    $("#btnRefrescar").prop("title","Recargar la lista de diálogos");
    
    $("#btnRefrescar").click(function(){
        my.btnRefresh_Click();
    });
    
    $("#btnNuevoDialogo").click(function(){
        my.btnNuevoDialogo_Click(this);
    });
    
    $("#btnVerMarcadores").click(function(){
        my.btnVerMarcadores_Click(this);
    });
    
    $("#btnBuscarIntervenciones").click(function(){
        my.btnBuscarIntervenciones_Click(this);
    });
    
    $("#btnVerAlertas").click(function(){
        my.btnVerAlertas_Click(this);
    });
    $("#btnAcercaDe").click(function(){
        my.btnAcercaDe_Click(this);
    });
    $("#btnEditarPerfil").show();

    $("#btnEditarPerfil").click(function(){
    window.location.href ="EditarPerfil.php?idsesion=" + JSON.stringify(window.my.sesionActual.idSesion) + "&usuario=" + JSON.stringify(me.usuario.nombreUsuario);
    });
    
}

VentanaPrincipal.prototype.btnVerAlertas_Click=function(sender){
    var sesion = JSON.stringify(my.sesionActual);
    vAlertas = window.open("VentanaAlertas.php?sesionactual="+sesion, "vAlertas");
    vAlertas.focus();
}

VentanaPrincipal.prototype.btnBuscarIntervenciones_Click=function(sender){
    var sesion = JSON.stringify(my.sesionActual);
    vBusqueda = window.open("VentanaBusqueda.php?sesionactual="+sesion, "vBusqueda");
    vBusqueda.focus();
}

VentanaPrincipal.prototype.btnVerMarcadores_Click=function(sender){
    //var _vtn = new VentanaMarcadores(me.sesionAc)
    var sesion = JSON.stringify(my.sesionActual);
    vMarcadores = window.open("VentanaMarcadores.php?sesionactual="+sesion, "vMarcadores");
    vMarcadores.focus();
}

VentanaPrincipal.prototype.btnAcercaDe_Click=function(sender){
    var sesion = JSON.stringify(my.sesionActual);
    vMarcadores = window.open("VentanaAcercaDe.php?sesionactual="+sesion, "vMarcadores");
    vMarcadores.focus();
}

VentanaPrincipal.prototype.btnNuevoDialogo_Click=function(sender){
    var sesion = JSON.stringify(my.sesionActual);
    var vND = window.open("VentanaNuevoDialogo.php", "vNuevoDialogo" + Math.random());
    vND.focus();
    vNuevoDialogo.push(vND);
}

VentanaPrincipal.prototype.btnRefresh_Click = function(sender){
    my.actualizarListaDialogos(my.sesionActual);
}

VentanaPrincipal.prototype.btnEditarPerfil_Click=function(){
    
    window.open("/xxEditarPerfil.php?idsesion=" + JSON.stringify(window.my.sesionActual.idSesion) + "&usuario=" + JSON.stringify(me.usuario.nombreUsuario));
}

VentanaPrincipal.prototype.actualizarListaDialogos = function(sesionActual) {
    //alert("actualizarListaDialogos");
    $("body").css("cursor", "wait");
    //ventana de espera, o cursor en espera.
    try {
        var _err="";
        //_encabezados es un arreglo de Dialogo
        var _encabezados = _controlador.listarDialogos(this.sesionActual, 1, _err);
        
        
        //carga de los diálogos luego de cargar la pagina completamente.
        if(_encabezados[0].length > 0)
            controlListaDialogos.setDialogos(_encabezados[0]);
        else
        if(_encabezados[1]!= ""){
        //            $("#notificar").dialog("open");
        //            $("#textoNotificar").html(_encabezados[1]);
        }
        
    } catch(ex) {
        $("body").css("cursor", "default");
        notificar("Error al obtener los datos desde el servidor");
    }
    
    $("body").css("cursor", "default");
}

VentanaPrincipal.prototype.actualizarListaDialogos1 = function(sesionActual) {
    //alert("actualizarListaDialogos");
    $("body").css("cursor", "wait");
    //ventana de espera, o cursor en espera.
    try {
        var _err="";
        //_encabezados es un arreglo de Dialogo
        var _encabezados = _controlador.listarDialogos(this.sesionActual, 1, _err);
        
        
        //carga de los diálogos luego de cargar la pagina completamente.
        if(_encabezados[0].length > 0)
            controlListaDialogos.setDialogos1(_encabezados[0]);
        else
        if(_encabezados[1]!= ""){
        //            $("#notificar").dialog("open");
        //            $("#textoNotificar").html(_encabezados[1]);
        }
        
    } catch(ex) {
        $("body").css("cursor", "default");
        notificar("Error al obtener los datos desde el servidor");
    }
    
    $("body").css("cursor", "default");
}


//Ejecuta la función de entrar a un diálogo.
function seleccionarDialogo_Executed(){
        
    //En el dataTable, tal como en el programa original, se debe almacenar el objeto completo.
    //controla que el evento se realice solo cuando se hace click en el boton.
    if(arguments[0].target.className=="btn btn-block btn-small btn-danger"){
            //Eliminar diálogo
            var dataTr = oTable.fnGetData(this);
            if(confirm("¿Está seguro de que desea eliminar el diálogo del sistema?")){
                var retorno;
                this.controladorDialogo=new CDialogo(this.sesionActual);
                retorno = this.controladorDialogo.eliminarDialogo(dataTr[0]);
                if(retorno){
                    alert("Diálogo eliminado");
                    //$("#grilla").load("VentanaPrincipal.php");
                    //location.reload();
                    my.actualizarListaDialogos(my.sesionActual);
                }
            }
    }
    if(arguments[0].target.className=="boton"){
        //recupera la información de la fila en la que se encuentra el botón.
        //oTable proviene de controlListaDialogos.js
        var dataTr = oTable.fnGetData(this);
            
        //Se abre con los parámetros:
        ///Sesion sesionActual.
        ///int idDialogo
        //se envían parámetros de inicialización por URL.
        //idDialogo se obtiene desde el dialogo seleccionado.
            
        var vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(SesionActual)+"&idDialogo="+dataTr[0]+"&idIntervencion=", "vDialogo" + Math.random());
        vD.focus();
        vDialogo.push(vD);
    //document.participar.submit();
            
            
    }
}


