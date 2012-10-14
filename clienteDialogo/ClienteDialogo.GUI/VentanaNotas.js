$(function(){
    $("#btnGuardar").button();
    $("#btnEliminar").button();
   
    
    {
        //var _sesionActual = JSON.parse($("#sesionActual").val());
        idIntervencion = JSON.parse($("#intervencion").val());
        
        //Obtiene el objeto sesión desde la ventana anterior.
        _sesionActual = opener.me.sesion;
        var _intervencion=null;
        var intervencionesDisponibles = opener.Navegador.nodosAgregados;
        for(var i=0;i<intervencionesDisponibles.length; i++){
            if(intervencionesDisponibles[i].intervencion.idIntervencion == idIntervencion){
                var _intervencion = intervencionesDisponibles[i].intervencion;
            }
        }
            
        _ventana = new VentanaNotas(_sesionActual);
        if(_intervencion.Notas == null || _intervencion.Notas.length == 0){
            var _controlador = new CNotas(_sesionActual);
            //Nota
            var _n = _controlador.crearNota();
            _n.Autor = _sesionActual.usuario;
            _intervencion.Notas = new Array();
            _intervencion.Notas[0] = _n;
            _n.intervencionPadre = _intervencion;
        }
        _ventana.mostrarNota(_intervencion.Notas[0]);
    }
});

/**
 * Ventana de presentación y manipulación de notas asociadas a una intervención.
 * @param {Sesion} sesion
 */
function VentanaNotas(sesion){
    me =this;
    this.SesionActual;
    this.notaActual;
    
    this.sesionActual = sesion;
    this.initializeComponents();
}

VentanaNotas.prototype.initializeComponents = function(){
    $("#btnEliminar").click(function(){
        me.btnEliminarNota_Click(this);
    });
    
    $("#btnGuardar").click(function(){
        me.btnGuardarNota_Click(this);
    });
}

VentanaNotas.prototype.btnEliminarNota_Click=function(sender){
    var _err="";
    var _exito = false;
    try{
        var _controlador = new CNotas(me.SesionActual);
        
        $("#txtNotas").val("");
        me.notaActual.Texto = $("#txtNotas").val();
        
        //setear cursor
        _exito = _controlador.eliminarNota(me.notaActual, _err);
        
    }catch(ex){
//        alert(ex);
    }
}

VentanaNotas.prototype.btnGuardarNota_Click=function(sender){
    var _err="";
    var _exito = false;
    try{
        var _controlador = new CNotas(me.SesionActual);
        me.notaActual.Texto=$("#txtNotas").val();
        
        if($.trim(me.notaActual.Texto)==""){
            return;
        }
        //sender.css("cursor","wait");
        _exito = _controlador.guardarNota(me.notaActual.intervencionPadre, me.notaActual, _err);
    //sender.css("cursor","default");
    }catch(ex){}
    if(!_exito || (_err != null && _err.length > 0)){
        //notificar "No se pudo guardar la nota"
        notificar("No se pudo guardar la nota");
        
    }
    else{
        //notificar "Nota guardada con éxito"
        notificar("Nota guardada con éxito");
    }
    
    
}
/**
 * @param {Nota} nota
 */
VentanaNotas.prototype.mostrarNota=function(nota){
    try{
        this.notaActual = nota;
        if(nota.Texto.length>0){
            $("#txtNotas").val(nota.Texto);
            $("#btnEliminar").button("enabled");
        //$("#dialogoNotas").dialog("option","buttons", [{},{text:Eliminar, disabled:false}]);
        }
        else{
            $("#txtNotas").val(nota.Texto);
        }
    }catch(ex){}
}


