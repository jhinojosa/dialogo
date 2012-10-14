$(function(){
    
 
    $("#instalar").click(function(){
        $.blockUI({message: '<h3>Instalando datos iniciales</h3><p>Esto tomará unos instantes.</p>'});
        var servidor = $("#servidor").val();
        var puerto = $("#puerto").val();
        var basededatos = $("#basededatos").val();
        var usuario = $("#usuario").val();
        var contrasegna = $("#contrasegna").val();
        
        if($.trim(servidor).length == 0 ||
            $.trim(puerto).length == 0 ||
            $.trim(basededatos).length == 0 ||
            $.trim(usuario).length == 0 ||
            $.trim(contrasegna).length == 0 ){
           
          // $("#mensaje").text("Hay campos vacíos.").show("fast").delay(1000).hide("fast");
        }
        
        
        $.post("setup.php", {
            servidor: servidor,
                puerto: puerto,
                basededatos: basededatos,
                usuario: usuario,
                contrasegna: contrasegna
            },
            function(ret){
                //alert(ret);
                $("#mensaje").text(ret).show("fast").delay(5000).hide("fast");
                $.unblockUI();
            }
        );
    });
});
