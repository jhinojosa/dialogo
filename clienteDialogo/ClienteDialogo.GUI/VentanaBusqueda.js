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
    
    // Se rescata la sesion actual
    this.sesionActual = sesionActual;
    this.initializeComponents();
    document.title="Búsqueda de intervenciones.";
}

VentanaBusqueda.prototype.initializeComponents = function(){

    $("#txtNombreUsuario").focus();
    $("#txtNombreUsuario").val("");
    
    $('#btnBuscar').click(function() {
        me.btnBuscar_Click();
    });
    
    $("#txtNombreUsuario").keyup(function(event){
        if(event.keyCode == 13){
            $("#btnBuscar").trigger('click');
        }
    });
    //alert('Fin inicialización componentes');
    //me.crearTablaMarcadores();
}

VentanaBusqueda.prototype.btnBuscar_Click=function(sender){

    var nombreUsuario = $("#txtNombreUsuario").val();
    
    // Se valida que la búsqueda no sea bacia
    if(!me.validar()){
        return;
    }
    
    // Se realiza la petición al servidor
    var _controlador = new CMarcadores();
    var _err = "";
    var _searched = _controlador.buscarIntervenciones(me.sesionActual, nombreUsuario, _err);
    
    if(_searched.length > 0){
        _searched.pop(); 
        
        // Se eliminan los resultados de la búsqueda anterior
        $("#bi_resultado_body").html('');
        
        // Si se ha llegado hasta aqui se agregan los resultados
        for (var i = 0;i < _searched.length; i++) {
            
            var texto = _searched[i].dondeApunto.Texto;
            var titulo = _searched[i].dialogoAsociado.Titulo;
            var id_dialogo = _searched[i].dialogoAsociado.idDialogo;
            var id_interv = _searched[i].dondeApunto.idIntervencion;
            
            var btn_ver = '<button id="contexto-' + id_dialogo + '-' + id_interv + '" class="verContexto btn">Ver contexto</button>';
            
            $('#bi_resultado_body').append('<tr><td>'+texto+'</td><td>'+titulo+'</td><td>'+btn_ver+'</td></tr>');
        }
        
        $(".verContexto").each(function() {
            $(this).click(function() {
                var idDialogo = $(this).attr('id').split('-')[1];
                var idIntervencion = $(this).attr('id').split('-')[2];
                
                //Abrir la ventana con sesionActual, idDialogo y idIntervencion
                vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(me.sesionActual)+"&idDialogo="+idDialogo+"&idIntervencion="+idIntervencion, "vD" + Math.random());
                vD.focus();
                try{
                    opener.vDialogo.push(vD);
                }catch(ex){}
            });
        });
        
    } else {
        $("#bi_resultado_body").html('<tr><td colspan="3">Lo sentimos, su búsqueda no ha arrojado resultados.</td></tr>');
    }
}



/*
VentanaBusqueda.prototype.crearTablaMarcadores=function(){

    $("#dgResultado").dataTable({
        
        "bJQueryUI" : false,
        "bPaginate" : false,
        "bScrollInfinite" : false,
        "bScrollCollapse" : false,
        "sScrollY" : "300px",
        "bServerSide" : false,
        "bAutoWidth":false,
        "bFilter":false,
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
*/

VentanaBusqueda.prototype.validar = function(){
    var nombreUsuario = $("#txtNombreUsuario").val();
    return (nombreUsuario != null && $.trim(nombreUsuario).length > 0);
}
