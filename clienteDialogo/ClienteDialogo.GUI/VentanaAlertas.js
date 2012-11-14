
/* Grupo 4: Se ha incluido directamente el archivo control lista dialogo . JS */
$(function() {
    $("#grilla").dataTable({
        "bJQueryUI" : false,
        "bPaginate" : false,
        "bScrollInfinite" : false,
        "bScrollCollapse" : false,
        "sScrollY" : "650px",
        "bServerSide" : false,
        "bFilter":true,
        "bAutoWidth":false,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar diálogo: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay diálogos disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[
        {
            //"sTitle":"idDialogo",
            "bVisible":false
        }, null, null, null, null, null, {"bVisible":false},

        
        ]
    });
    

    oTable = $("#grilla").dataTable();

    oTable.on("click","tr",seleccionarDialogo_Executed);
});

function controlListaDialogos(){
    
}

controlListaDialogos.prototype.setDialogos=function(lista) {
    var gr = document.getElementById("grilla");
    if($.fn.DataTable.fnIsDataTable(gr)){
        $("#grilla").dataTable().fnClearTable()
    }
    
    //alert(lista[0].Titulo);
    var encabezados = new Array();
    for(var i=0; i<lista.length;i++){
        var p = JSON.parse(lista[i]);
        var val = new Array();
        //Por temas de compatibilidad con WebKit (Chrome, safari) se hace push por separado.
        val.push(p.idDialogo);
        val.push("<a href=\"#\" class=\"boton\">"+p.Titulo+"</a>");
        val.push(p.usuarioCreador.nombreUsuario);
        val.push(p.FechaCreacion);
        val.push(p.FechaUltimaIntervencion);
       
        if(p.estaDialogoDesbalanceado)
            val.push("<span class=\"label label-important\">Desbalanceado</span>");
        else
            val.push("<span class=\"label label-success\">Balanceado</span>");
        val.push("<button class=\"btn btn-block btn-small btn-danger\"> Eliminar</button>");
        encabezados.push(val);
    }
    
    $("#grilla").dataTable().fnAddData(encabezados);

}


/////////////////////////////////////////////////////////////////////////////////

$(function() {

    $('.dataTables_scrollBody').css('position', 'static').css('margin-top', '-22px');
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

            
        var vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(SesionActual)+"&idDialogo="+dataTr[0]+"&idIntervencion=",'_blank');
        vD.focus();
        try{
            opener.vDialogo.push(vD);
        }catch(ex){}
   
    }
}
