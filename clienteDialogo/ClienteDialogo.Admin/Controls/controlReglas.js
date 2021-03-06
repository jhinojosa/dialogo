$(function(){
    
    $("#grillaReglas").dataTable({
        
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : false,
        "sScrollY" : "160px",
        "bServerSide" : false,
        "bFilter":false,
        "bAutoWidth":false,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar entre las reglas: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay reglas disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[{
            sTitle: "Reglas disponibles"
        }]
            
    });
    $(".btnAgregarRegla").button();
    $(".btnGuardarReglas").button();
});
    
function ControlReglas(){
    my = this;
    this.sesionActual;
    this.controlador;
    this.initializeComponents();
}

ControlReglas.prototype.initializeComponents=function(){
    $(".btnAgregarRegla").click(function(){
        my.btnAgregarRegla_Click();
    });
    
    $(".btnGuardarReglas").click(function(){
        my.btnGuardarReglas_Click();
    });
}
    
ControlReglas.prototype.cargarReglas=function(sesionActual){
    my.sesionActual = sesionActual;
    my.controlador = new CRegla(my.sesionActual);
        
    var reglas = my.controlador.listarReglas();
    reglas.pop();
    //Cargar las reglas en la tabla.
    for(var i=0;i<reglas.length;i++)
        $("#grillaReglas").dataTable().fnAddData([reglas[i].textoRegla]);
}

ControlReglas.prototype.btnAgregarRegla_Click=function(sender){
    var texto = $(".txtTextoRegla").val();
    if(texto.length == 0)
        return;
    var nueva = my.controlador.agregarRegla(texto);
    $("#grillaReglas").dataTable().fnClearTable();
    
    for(var i=0;i<my.controlador.reglasActuales.length;i++)
        $("#grillaReglas").dataTable().fnAddData([my.controlador.reglasActuales[i].textoRegla]);
    
    $(".txtTextoRegla").val("");
}

ControlReglas.prototype.btnGuardarReglas_Click=function(){
    
    var _exito = my.controlador.guardarReglas();
    $(".txtTextoRegla").val("");
    if(_exito){
        notificar("Las reglas fueron guardadas");
    }
}