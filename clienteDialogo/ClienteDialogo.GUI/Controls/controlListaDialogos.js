
$(function() {
    //alert("uno");
    
    $("#grilla").dataTable({
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : true,
        "sScrollY" : "250px",
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
            "sTitle":"idDialogo",
            "bVisible":false
        },

        {
            "sTitle":"Título"
        },

        {
            "sTitle":"Autor"
        },

        {
            "sTitle":"Publicación"
        },

        {
            "sTitle":"Última intervención"
        },

        {
            "sTitle":"<br>",
            "bSortable":false
        },

        {
            "sTitle":"<br>",
            "bSortable":false
        },
        ]
    });
    
    //$("#grilla").attr("title","HOLA");
    
    //oTable = datatable de id=grilla.
    oTable = $("#grilla").dataTable();
    //manejador de eventos:
    //evento: click.
    //aplicado sobre <tr></tr>
    //realizando la acción de 
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
        val.push(p.Titulo);
        val.push(p.usuarioCreador.nombreUsuario);
        val.push(p.FechaCreacion);
        val.push(p.FechaUltimaIntervencion);
       
        if(p.estaDialogoDesbalanceado)
            val.push("<div style=\"text-align: center; color: red; font-size:13px;\">Diálogo desbalanceado</div>");
        else
            val.push("");
        val.push("<button class=\"boton\">Ingresar</button>");
        encabezados.push(val);
    }
    
    $("#grilla").dataTable().fnAddData(encabezados);
//    $("#grilla").dataTable().fnAddData([
//            p.idDialogo,
//            p.Titulo, 
//            p.usuarioCreador.nombreUsuario, 
//            p.FechaCreacion,
//            p.FechaUltimaIntervencion,
//            "",
//            "<input class=\"boton\" type=\"button\" value=\"ingresar\">"
//            ]);

}




