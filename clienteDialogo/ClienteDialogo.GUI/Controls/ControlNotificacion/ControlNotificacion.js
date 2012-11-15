$(function(){
//    $("#background").hide(),
    $("#notificar").hide(); 
});

function notificar(mensaje){
    
    $("#notificar #mensaje").html(mensaje);
//    $("#background").show("puff").delay(1500).hide("puff");
    $("#notificar").fadeIn().delay(1500).fadeOut();
}
