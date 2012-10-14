$(function() {
    $("#btnBuscar").button();
 
        
    {
        var valor = $("#sesion").val();
        var sesion = JSON.parse(valor);
        //sesion = new Sesion(sesion);
        _vtn = new VentanaBusqueda(sesion);
    }   
});

/**
 * Ventana que permite buscar intervenciones realizadas por otros usuarios.
 * @param {Sesion} sesionActual
 */
function VentanaBusqueda(sesionActual){
    me=this;
    //Sesion
    this.sesionActual = sesionActual;
    this.initializeComponents();
    document.title="Búsqueda de intervenciones.";
}

VentanaBusqueda.prototype.initializeComponents = function(){
    $("#txtNombreUsuario").focus();
    $("#txtNombreUsuario").val("");
    
    $("#btnBuscar").click(function(){
        me.btnBuscar_Click(this);
    });
    $("#txtNombreUsuario").keyup(function(event){
        if(event.keyCode == 13){
            $("#btnBuscar").trigger('click');
        }
    });
    
    me.crearTablaMarcadores();
}

VentanaBusqueda.prototype.btnBuscar_Click=function(sender){
    var nombreUsuario = $("#txtNombreUsuario").val();
    
    if(!me.validar()){
        return;
    }
    
    var _controlador = new CMarcadores();
    var _err = "";
    var _searched = _controlador.buscarIntervenciones(me.sesionActual, nombreUsuario, _err);
    if(_searched != null)
        _searched.pop();
    
    $("#dgResultado").dataTable().fnDestroy();
    $("#dgResultado tbody").empty();
    me.crearTablaMarcadores();
    //llenar la tabla con un ciclo.
    if(_searched != null){
        for(var i=0;i<_searched.length;i++){
            var _nueva = new Array();
            _nueva[0] = _searched[i].dondeApunto.Texto;
        
            _nueva[1] = _searched[i].dialogoAsociado.Titulo;
            _nueva[2] = _searched[i].dialogoAsociado.idDialogo;
            _nueva[3] = _searched[i].dondeApunto.idIntervencion;
        
        
            _nueva[4] = "<button class=\"verContexto\" style=\"width: 150px;\">Ver contexto</button>";
        
            $("#dgResultado").dataTable().fnAddData([_nueva]);
        }
        
        $(".verContexto").click(function(){
            me.btnVerContexto_Executed(this);
        });
    }else{
        
    }
    
}

VentanaBusqueda.prototype.btnVerContexto_Executed=function(sender){
    var dataRow = $("#dgResultado").dataTable().fnGetData(sender.parentElement.parentElement);
    var idDialogo = dataRow[2];
    var idIntervencion = dataRow[3];
    
    //Abrir la ventana con sesionActual, idDialogo y idIntervencion
    vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(me.sesionActual)+"&idDialogo="+idDialogo+"&idIntervencion="+idIntervencion, "vD" + Math.random());
    vD.focus();
    try{
        opener.vDialogo.push(vD);
    }catch(ex){}
}


VentanaBusqueda.prototype.crearTablaMarcadores=function(){

    $("#dgResultado").dataTable({
        
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : true,
        "sScrollY" : "300px",
        "bServerSide" : false,
        "bAutoWidth":true,
        "bFilter":true,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar en estas intervenciones: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay intervenciones disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[{
            sTitle: "Texto intervención"
        },{
            sTitle: "Dialogo"
        },{
            sTitle: "idDialogo",
            bVisible: false
        },{
            sTitle: "idIntervencion",
            bVisible: false
        },{
            sTitle: "",
            bSortable: false,
            bWidth: "30px"
        }]
            
    });
//    $("#dgResultado").dataTable().fnClearTable();
}


VentanaBusqueda.prototype.validar = function(){
    var nombreUsuario = $("#txtNombreUsuario").val();
    return (nombreUsuario != null && $.trim(nombreUsuario).length > 0);
}