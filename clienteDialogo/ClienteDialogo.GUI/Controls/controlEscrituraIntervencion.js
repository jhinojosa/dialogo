$(function() {
    
    $(".btnCancelar").button();
    $(".btnEnviar").button();
    $(".btnCancelar").hide();
    $(".btnEnviar").hide();   
});


function controlEscrituraIntervencion(){
    that=this;
    this.movidas;
    $(".cmbTipoIntervencion").on("change",null,that.cmbTipoIntervencion_SelectionChanged);
//    $(".cmbTipoIntervencion").change(function(){
//        that.cmbTipoIntervencion_SelectionChanged(this);
//    });
}

/**
 * Permite personalizar la apariencia del control, mostrando u ocultando el botón enviar.
 */
controlEscrituraIntervencion.prototype.mostrarBotonEnviar=function(value){
    //get
    if(value == null){
        return $(".btnEnviar").css("visibility");
    }else{
        if(value){
            $(".btnEnviar").css("visibility","visible");
        }else{
            $(".btnEnviar").css("visibility","hidden");
        }
    }
}

/**
 * @param {Movida[]}
 */
controlEscrituraIntervencion.prototype.setComboMovidas=function(tipoMovidas){
    that.movidas = tipoMovidas;
    try{
        $(".cmbTipoIntervencion").empty();
        for(var i=0;i<tipoMovidas.length;i++){
            $(".cmbTipoIntervencion").append("<option>"+tipoMovidas[i].Nombre+"</option>")
        }
        $(".cmbTipoIntervencion").change();
        
    }catch(ex){}
}

controlEscrituraIntervencion.prototype.actualizarIntervencion=function(intervencion){
    if(that.datosValidos()){
//        intervencion.Texto = $("#txtIntervencion").wysiwyg("getContent").val();
//        intervencion.tipoMovida = $(".cmbTipoIntervencion option:selected").val();
        return true;
    }else{
        return false;
    }
}

controlEscrituraIntervencion.prototype.datosValidos=function(){
    if($(".cmbTipoIntervencion option:selected").val() == null){
        $("#textoNotificar").html("Seleccione un tipo de intervención");
        $("#notificar").dialog("open");
        return false;
    }
    
    var _rangoTexto = $(".txtIntervencion").val();
    if(_rangoTexto.length == 0){
        $("#textoNotificar").html("Ingrese el texto de su intervención.");
        $("#notificar").dialog("open");
        return false;
    }
    
    
    
    return true;
}

controlEscrituraIntervencion.prototype.cmbTipoIntervencion_SelectionChanged=function(sender){
    try{
        for(var i=0;i<that.movidas.length;i++){
            if($(".cmbTipoIntervencion option:selected").val() == that.movidas[i].Nombre){
                $(".cmbTipoIntervencion").prop("title",that.movidas[i].descripcion);
                $(".lblExplicacionMovida").html(that.movidas[i].descripcion);
            }
        }
        
    }catch(ex){}
}