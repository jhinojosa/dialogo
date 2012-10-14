$(function() {
    $("#tabs").tabs({
        disabled : [1]
    });

    {
        var sesion = JSON.parse($("#sesion").val());
        vAlertas = new VentanaAlertas(sesion);
        vAlertas.cargarDesbalance();
        
    }
}); 


function VentanaAlertas(sesion){
    me = this;
    this.sesionActual = sesion;
    SesionActual = this.sesionActual;
    this.listaDialogos = new controlListaDialogos();
    document.title="Ver alertas";
    
}

VentanaAlertas.prototype.cargarDesbalance = function(){
    try{
        var _controlador = new CDialogo(me.sesionActual);
        var _desb = _controlador.obtenerDialogosDesbalanceados();
        me.listaDialogos.setDialogos(_desb);
    }catch(ex){
        alert(ex);
    }
}

//Ejecuta la función de entrar a un diálogo.
function seleccionarDialogo_Executed(){
        
    //En el dataTable, tal como en el programa original, se debe almacenar el objeto completo.
    //controla que el evento se realice solo cuando se hace click en el boton.
    if(arguments[0].target.className=="boton"){
        //recupera la información de la fila en la que se encuentra el botón.
        //oTable proviene de controlListaDialogos.js
        var dataTr = oTable.fnGetData(this);
            
        //Se abre con los parámetros:
        ///Sesion sesionActual.
        ///int idDialogo
        //se envían parámetros de inicialización por URL.
        //idDialogo se obtiene desde el dialogo seleccionado.
            
        var vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(SesionActual)+"&idDialogo="+dataTr[0]+"&idIntervencion=",'_blank');
        vD.focus();
        try{
            opener.vDialogo.push(vD);
        }catch(ex){}
        
    //document.participar.submit();
            
            
    }
}