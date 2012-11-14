
var user;
$(window).load(function() {
    if(user.Rol == user.ROL_ADMINISTRADOR){
        $("#grilla").dataTable({
            "bJQueryUI" : true,
            "bPaginate" : false,
            "bScrollInfinite" : true,
            "bScrollCollapse" : false,
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
                "bVisible":false
            }, null, null, null, null, null, null,
            ]
        });
    } else{
        $("#grilla").dataTable({
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : false,
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
            "bVisible":false
        }, null, null, null, null, null,
        {
            "bVisible":false
        },
        ]
    });
}
    
    //$("#grilla").attr("title","HOLA");
    
    //oTable = datatable de id=grilla.
    oTable = $("#grilla").dataTable();
    //manejador de eventos:
    //evento: click.
    //aplicado sobre <tr></tr>
    //realizando la acción de 
    //alert(usuario.Rol);
    oTable.on("click","tr",seleccionarDialogo_Executed);
});

function controlListaDialogos(usuario){

    user = usuario;
}

controlListaDialogos.prototype.setDialogos1=function(lista) {
    $(window).load(function() {
        //alert("actualizar lista de dialogos");
        var gr = document.getElementById("grilla");
        if($.fn.DataTable.fnIsDataTable(gr)){
            $("#grilla").dataTable().fnClearTable()
        }

        //alert(user.Rol);
        
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
    //    $("#grilla").dataTable().fnAddData([
    //            p.idDialogo,
    //            p.Titulo, 
    //            p.usuarioCreador.nombreUsuario, 
    //            p.FechaCreacion,
    //            p.FechaUltimaIntervencion,
    //            "",
    //            "<input class=\"boton\" type=\"button\" value=\"ingresar\">"
    //            ]);
    });

}

controlListaDialogos.prototype.setDialogos=function(lista) {
        //alert("actualizar lista de dialogos");
        var gr = document.getElementById("grilla");
        if($.fn.DataTable.fnIsDataTable(gr)){
            $("#grilla").dataTable().fnClearTable()
        }

        //alert(user.Rol);
        
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




