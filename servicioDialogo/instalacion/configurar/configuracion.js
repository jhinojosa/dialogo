$(function(){
    $("#Limpiar").click(function(){
        $("input").val(""); 
    });
    
    $.blockUI({
        message: '<h3>Obteniendo datos desde el servidor</h3><p>Esto tomará unos instantes.</p>'
    });
    
    $.post("config.php", {
        metodo: "onLoad",
        servidor: "",
        puerto: "",
        basededatos: "",
        usuario: "",
        contrasegna: ""
    },
    function(ret){
        //alert(ret);
        try{
            var valores = JSON.parse(ret);
        }catch(ex){
            $.unblockUI();
            return;
        }
        if(typeof(valores) != "undefined"){
            if(typeof(valores.configBdArchivo) != "undefined"){
                if(typeof(valores.configBdArchivo.mensaje) != "undefined"){
                    $("#mensaje2").text(valores.configBdArchivo.mensaje).show("fast").delay(5000).hide("fast");
                }
                if(typeof(valores.configBdArchivo.btnConfigurarBdArchivos) != "undefined" ){
                    if(!valores.configBdArchivo.btnConfigurarBdArchivos){
                        $("#configurarbdarchivos").hide();
                    }
                }
                if(typeof(valores.configBdArchivo.tituloConfigBdArchivos) != "undefined" ){
                    if(!valores.configBdArchivo.tituloConfigBdArchivos){
                        $("#tituloConfigBdArchivos").hide();
                    }
                }
            }
            
            if(typeof(valores.FormConfigBd) != "undefined"){
                $("#servidor").val(valores.FormConfigBd.servidor);
                $("#puerto").val(valores.FormConfigBd.port);
                $("#basededatos").val(valores.FormConfigBd.bdName);
                $("#usuario").val(valores.FormConfigBd.usuario);
            }
            
            
            
            if(typeof(valores.config)!= "undefined"){
                $("#zonahoraria").val(valores.config.timezone);
                $("#imagenes").val(valores.config.uploads);
                $("#sqlite").val(valores.config.dirsqlite);
                $("#defaultavatar").val(valores.config.defaultavatar);
            }
        }else{
            $("#mensaje").text("Hubo un problema en la conexión").show("fast").delay(5000).hide("fast");
        }
        //$("#mensaje").text(ret).show("fast").delay(5000).hide("fast");
        $.unblockUI();
    }
    );
            
    
    $("#configurarbd").click(function(){
        $.blockUI({
            message: '<h3>Configurando la base de datos</h3><p>Esto tomará unos instantes.</p>'
        });
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
        
        
        $.post("config.php", {
            metodo: "configurarBd",
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
    
    
    $("#configurarbdarchivos").click(function(){
        $.blockUI({
            message: '<h3>Configurando la base de datos para archivos</h3><p>Esto tomará unos instantes.</p>'
        });
        
        $.post("config.php", {
            metodo: "configurarBdArchivo",
            servidor: "",
            puerto: "",
            basededatos: "",
            usuario: "",
            contrasegna: ""
        },
        function(ret){
            
            $("#mensaje2").text(ret).show("fast").delay(5000).hide("fast");
            $.unblockUI();
        }
        );

    });
    
    $("#cambiarParametros").click(function(){
        $.blockUI({
            message: '<h3>Configurando parámetros.</h3><p>Esto tomará unos instantes.</p>'
        });
        
        $.post("config.php", {
            metodo: "configurarParametros",
            /**
             * Se reutilizan los nombres de las variables.
             */
            servidor: $("#zonahoraria").val(),
            puerto: $("#imagenes").val(),
            basededatos: $("#sqlite").val(),
            usuario: $("#defaultavatar").val(),
            contrasegna: ""
        },
        function(ret){
            
            $("#mensaje3").text(ret).show("fast").delay(5000).hide("fast");
            $.unblockUI();
        }
        );
    });
    
});
