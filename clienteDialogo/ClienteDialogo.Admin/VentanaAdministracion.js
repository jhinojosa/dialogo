$(function(){
    $("#tabs").tabs();
    $("#notificar").hide();
    
   
   {
       var usuario = JSON.parse($("#usuario").val());
       var idSesion = JSON.parse($("#idsesion").val());
       
       vAdmin = new VentanaAdministracion(usuario, idSesion);
   }
});


function VentanaAdministracion(usuario, idSesion){
    me = this;
    var controller = new CSesion();
    this.sesionActual = controller.obtenerSesion(usuario, idSesion);
    
    var ctrlReglas = new ControlReglas();
    var ctrlPerfilMovidas = new ControlPerfilMovidas();
    
    ctrlReglas.cargarReglas(this.sesionActual);
    ctrlPerfilMovidas.cargarMovidas(this.sesionActual);
    
    
    this.initializeComponents();
    
}

VentanaAdministracion.prototype.initializeComponents=function(){
     
     $("#tabs").tabs({
        selected:0,
        show:function(event, ui){
            if(ui.index == 0){
//                if($.fn.DataTable.fnIsDataTable($(".grillaReglas")))
                    $("#grillaReglas").dataTable().fnAdjustColumnSizing(true);
            }
            if(ui.index == 1){
//                if($.fn.DataTable.fnIsDataTable($(".grillaPerfiles")))
                    $("#grillaPerfiles").dataTable().fnAdjustColumnSizing(true);
//                if($.fn.DataTable.fnIsDataTable($(".grillaMovidas")))
                    $("#grillaMovidas").dataTable().fnAdjustColumnSizing(true);
            }
        }
    }); 
}

