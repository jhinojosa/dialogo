$(function() {

        
    /**Inicialización de la clase VentanaMarcadores**/
    {
        var valor = $("#sesion").val();
        var sesion = JSON.parse(valor);
        //sesion = new Sesion(sesion);
        _vtn = new VentanaMarcadores(sesion);
        _vtn.cargarMarcadores();
        
        
    }
});

/**
 * Ventana de presentación de marcadores ingresados por un usuario.
 * @param {Sesion} sesion
 */

function VentanaMarcadores(sesion){
    me = this;
    //Sesion
    this.sesionActual=sesion;
    document.title="Visualización de marcadores.";
}

VentanaMarcadores.prototype.cargarMarcadores=function(){
    try{
        var _controlador = new CMarcadores();
        var _msgError="";
        //Marcadores[]
        var _marcadores = _controlador.listarMarcadores(this.sesionActual, _msgError);
        _marcadores.pop();
        
        this.crearTablaMarcadores();
        
        for(var i=0;i<_marcadores.length;i++){
            //DataRow
            var _nueva=new Array();
            _nueva[1] = _marcadores[i].dialogoAsociado.Titulo;      //Dialogo
            _nueva[2] = _marcadores[i].dialogoAsociado.idDialogo;   //idDialogo
            _nueva[3] = _marcadores[i].dondeApunto.idIntervencion;  //idIntervencion
            
            var _htmlText = _marcadores[i].dondeApunto.Texto;
            //            try{
            //                //Convertir a texto plano.
            //            }catch(ex){}
            _nueva[0] = _htmlText;
            
            _nueva[4] = "<button disabled=\"disabled\">Eliminar</button>"; 
            _nueva[5] = "<button class=\"btnVerContexto\">Ver contexto</button>";   
            $("#grillaMarcadores").dataTable().fnAddData([_nueva]);
            
            
        }
        
        $(".btnVerContexto").click(function(){
            me.btnVerContexto_Executed(this);
        });
        
    }catch(ex){
//        alert(ex);
    }
}

VentanaMarcadores.prototype.crearTablaMarcadores=function(){
    $("#grillaMarcadores").dataTable({
        
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "bScrollCollapse" : true,
        "sScrollY" : "300px",
        "bServerSide" : false,
        "bFilter":false,
        "bAutoWidth":true,
        "oLanguage":{
            "sInfo": "",
            "sSearch": "Buscar diálogo: ",
            "sZeroRecords": "No se obtuvieron resultados que coincidan con su búsqueda",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay marcadores disponibles",
            "sInfoFiltered": "Se han encontrado _TOTAL_ coincidencias",
            "sInfoEmpty": ""
            
        },
        "aoColumns":[{
            sTitle: "Texto"
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
            bVisible: false
        },{
            sTitle: "",
            bSortable:false
        }]
            
    });
}

VentanaMarcadores.prototype.btnVerContexto_Executed=function(sender){
    //alert("p");
    var dataRow = $("#grillaMarcadores").dataTable().fnGetData(sender.parentElement.parentElement);
    var idDialogo = dataRow[2];
    var idIntervencion = dataRow[3];
     
    //Abrir ventanaDialogo con sesionActual e idDialogo
    var vD = window.open("VentanaDialogo.php?sesionActual="+JSON.stringify(me.sesionActual)+"&idDialogo="+idDialogo+"&idIntervencion="+idIntervencion, "vD"+Math.random());
    vD.focus();
    try{
        opener.vDialogo.push(vD);
    }catch(ex){}
}

function btnBorrarMarcador_Executed(){
//Funcionalidad no implementada en la aplicación original.-
}
