$(function() {
    $( "#tabs" ).tabs();
        
    
    /**
 * Inicialización de la clase VentanaEstadísticas.
 */
    {
//        var valor = $("#Controlador").val();
//        var _dialogoActual = JSON.parse($("#idDialogo").val());
         
//        var _controlador = JSON.parse(valor);
//        var _cont = new CDialogo(_controlador);
//        _cont.actualizarDialogoActual(_dialogoActual);
        vdialogo = new VentanaEstadisticas(opener.Controlador);
        vdialogo.cargarEstadisticas();
    }
});

/**
 * Ventana de presentación de estadísticas para un diálogo.
 * @param {CDialogo} controller
 */
function VentanaEstadisticas(controller){
    //CDialogo.
    this.Controlador = controller;
    this.InitializeComponents();
}

VentanaEstadisticas.prototype.InitializeComponents=function(){
    $("#tabs").tabs({
        selected:0,
        show:function(event, ui){
            if(ui.index == 0){
                $("#grillaPorcentajes").dataTable().fnAdjustColumnSizing(true);
            }
            if(ui.index == 1){
                $("#grillaUsuarios").dataTable().fnAdjustColumnSizing(true);
            }
            if(ui.index == 2){
                $("#grillaEje").dataTable().fnAdjustColumnSizing(true);
            }
        }
    });
}

/**
 * Carga y muestra las estadísticas para el diálogo actual.
 */
VentanaEstadisticas.prototype.cargarEstadisticas=function(){
    try{
        //DataSet
        //Arreglo de tablas.
        //Cada tabla tiene el objeto Header y Data
        //Header es un arreglo que contiene los títulos de las columnas.
        //Data es un arreglo de arreglos que contiene los datos.
        var _ds=this.Controlador.obtenerEstadisticas(this.Controlador.dialogoActual);
        _ds.pop();
        for(var i=0;i<_ds.length; i++){
            _ds[i].columnas.pop();
            _ds[i].datos.pop();
        }

        //limpia las columnas de grillaPorcentaje.
        //define el origen de datos de grillaPorcentaje.
        //usuario no puede agregar filas.
        
        //se repite para las otras 2 tablas.
        document.title = "Estadísticas para el diálogo "+this.Controlador.dialogoActual.Titulo;
        var gp = $("#grillaPorcentajes");
        if($.fn.DataTable.fnIsDataTable(gp)){
            $("#grillaPorcentajes").dataTable().fnClearTable();
        }
        $("#grillaPorcentajes").dataTable({
        
            "bJQueryUI" : true,
            "bPaginate" : false,
            "bScrollInfinite" : true,
            "bScrollCollapse" : true,
            "bAutoWidth":false,
            "sScrollY" : "300px",
            "bServerSide" : false,
            "bFilter":false,
            "aoColumns":_ds[0].columnas,
            "aaData":_ds[0].datos
        });
        
        gp = $("#grillaUsuarios");
        if($.fn.DataTable.fnIsDataTable(gp)){
            $("#grillaUsuarios").dataTable().fnClearTable();
        }
        $("#grillaUsuarios").dataTable({
            "bJQueryUI" : true,
            "bPaginate" : false,
            "bScrollInfinite" : true,
            "bScrollCollapse" : true,
            "bAutoWidth":false,
            "sScrollY" : "300px",
            "bServerSide" : false,
            "bFilter":false,
            "aoColumns":_ds[1].columnas,
            "aaData": _ds[1].datos
        });
        
        gp = $("#grillaEje");
        if($.fn.DataTable.fnIsDataTable(gp)){
            $("#grillaEje").dataTable().fnClearTable();
        }
        $("#grillaEje").dataTable({
            "bJQueryUI" : true,
            "bPaginate" : false,
            "bScrollInfinite" : true,
            "bScrollCollapse" : true,
            "bAutoWidth":false,
            "sScrollY" : "300px",
            "bServerSide" : false,
            "bFilter":false,
            "aoColumns":_ds[2].columnas,
            "aaData": _ds[2].datos
        });
        
        
    }catch(ex){
        if(_ds == null)
//            alert("No se pudieron obtener los datos desde el servidor\n\n" + ex);
            notificar("No se pudieron obtener los datos desde el servidor<br><br>" + ex);
        else
            alert(ex);
    }
}