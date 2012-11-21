$(function() {
   

   {
        var valor = $("#sesion").val();
        var sesion = JSON.parse(valor);
        //sesion = new Sesion(sesion);
        _vtn = new VentanaAcercaDe(sesion);
           
    }
});

