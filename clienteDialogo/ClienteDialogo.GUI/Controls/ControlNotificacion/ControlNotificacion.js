$(function(){
//    $("#background").hide(),
    //$("#notificar").hide(); 
    $('#notificar').modal('hide');
});

function notificar(mensaje){
    
    $("#notificar #mensaje").html(mensaje);
    
//    $("#background").show("puff").delay(1500).hide("puff");
    $('#notificar').modal('show');
    //$("#notificar").fadeIn().delay(1500).fadeOut();
}
