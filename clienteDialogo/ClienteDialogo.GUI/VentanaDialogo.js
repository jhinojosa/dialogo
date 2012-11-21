$(function() {
    
    
    // minimizar arbolito
    $('#navegador-anchor').click(function() {
        $('#controlHilo').slideToggle();
        if ($(this).hasClass('c')) {
            $(this).removeClass('c').html('Navegador del diálogo &darr;');
        } else {
            $(this).addClass('c').html('Navegador del diálogo &rarr;');
        }
    });
    
    $("#moves").hide();
    $('#anchor1').on('click', function() {
        $('#listado_actas').hide();
    });

    /*
    $("#tabs").tabs({
        selected:1,
        show:function(event, ui){
            if(ui.index == 0){
                $("#dgReglas").dataTable().fnAdjustColumnSizing(true);
            }
        }
    });
    */
    /*oculta pestaña ver todas las actas*/
    //$("#tab3").hide();
    //$("#todasActas").hide();
    /**/
    
    $("#btnVerEstadisticas").button({
        icons : {
            primary : "ui-icon-clipboard"
        }
    });
    
    $("#controlTab").tabs();
    

    $("#btnRefrescar").button();
    
    $("#btnGuardarActa").button();
    $("#btnParticipar").button();
    $("#btnConfigurar").button();
    
    
    $("#btnVerTodasActas").button();
    $("#btnVerTodasActas").hide();
    
    $("#txtActaUsuario").wysiwyg({
        controls : {
            bold : {
                visible : true
            },
            italic : {
                visible : true
            },
            underline : {
                visible : true
            },

            separator00 : {
                visible : true
            },

            justifyLeft : {
                visible : true
            },
            justifyCenter : {
                visible : true
            },
            justifyRight : {
                visible : true
            }
        }
    });


    /*Acciones para el controlador*/
    $("#lblIntervencion").css("display", "none");
    //recupera los valores idDialogo y sesionActual desde los input hidden.
    {
        var _sesionActual = JSON.parse($("#sesionActual").val());
        var _idDialogo = $("#idDialogo").val();
        var _idIntervencion = $("#idIntervencion").val();
        vdialogo = new VentanaDialogo(_sesionActual, _idDialogo);
        if(_idIntervencion != null){
            vdialogo.seleccionarIntervencion(_idIntervencion);
        }
    }
   
});

function none(){
    alert($("#txtActaUsuario").val());
}
/******************************/

var Controlador;
/**
 *@param {Sesion} sesionActual
 *@param {int} idDialogo
 */
function VentanaDialogo(sesionActual, idDialogo) {
    
    me = this;
    this.sesion = sesionActual;
    vNotas = new Array();
    //listaNodos de la aplicación original.
    //lista del tipo Nodo.
    this.listaNodos = new Array();
    
    this.actas=new Array();
    this.controlTextoIntervencion = new controlEscrituraIntervencion();
    Controlador = new CDialogo(sesionActual);
    //setear cursor.
    //_exito:bool
    
    var _exito = Controlador.actualizarDialogoActual(idDialogo);

    me.crearTablaReglas();
    if(_exito) {
        //carga de datos
        //carga datos en el controlHilo:DialogBrowser.
        
        //Carga de datos en DialogBrowser.
        //No se asignan de la manera que se usa en la aplicacion original
        //debido a temas de compatibilidad con la plataforma actual.
        //Para ello, lo ideal es convertirlo en un plugin de jQuery.
        controlHilo = new DialogBrowser();
        //db.intervenciones = dsa;
        
        
        //Carga datos en navegadorHilo.
        //en app original es:
        //controlHilo.Intervenciones = Controlador.intervencionesActuales;
        /*db.intervenciones = Controlador.intervencionesActuales;
         *db.refrescar();
         **/
        Navegador = new NavegadorHilo();
        Navegador.setVentanaPadre(this);
        
        
        //Obtiene el dialogo desde Controlador.
        //:Dialogo
        var _dialogo = Controlador.dialogoActual;
        //alert(_dialogo);
        //Carga el dialogo en la ventana.
        this.cargarDialogo(_dialogo);
        this.initializeComponents();
    }
    
   
    
}

/**
 * Al cerrarse la ventana, cierra todas las NOTA que dependan de ésta.
 */
window.onbeforeunload=function(){
    for(var i=0;i<vNotas.length;i++){
        //Cierra cada una de las ventanas notas.
        vNotas[i].close();
    }
}

/**
 *Método utilizado para seleccionar una intervencion
 *@param {int} idIntervencion
 */
VentanaDialogo.prototype.seleccionarIntervencion=function(idIntervencion){
    //Intervencion
    var _intSeleccionada = null;
    for(var i=0;i<Controlador.dialogoActual.intervenciones.length;i++){
        if(Controlador.dialogoActual.intervenciones[i].idIntervencion == idIntervencion){
            _intSeleccionada = Controlador.dialogoActual.intervenciones[i];
            break;
        }
    }
    
    this.seleccionarIntervencion_2(_intSeleccionada);
}

/**
 *Método utilizado para la comunicación entre el control de diálogo y el host (esta ventana)
 *@param {Intervencion} intSeleccionada
 */
VentanaDialogo.prototype.seleccionarIntervencion_2=function(intSeleccionada){
    try{
        Navegador.limpiar();
        
        //Se cargan el dialog browser con todas las intervenciones del diálogo,
        //Pero no se reflejan los cambios en el árbol jerárquico.
        controlHilo = new DialogBrowser();
        controlHilo.intervenciones = Controlador.getIntervencionesActuales();
        controlHilo.refrescar();
        Navegador.agregarNodoRaiz(controlHilo.intervenciones[0]);
        Navegador.agregarNodos(controlHilo.intervenciones);
        var todasLasIntervenciones = Navegador.nodosAgregados;
        
        //Se destruye el árbol jerárquico generado por defecto cuando esta ventana
        //es abierta desde la ventana principal.
        $("#arbol").tree('destroy');
        
        
        //Se selecciona la intervención actual desde la lista de intervenciones anidadas
        //Navegador.nodosAnidados...
        var sel;
        for(var i=0;i<todasLasIntervenciones.length;i++){
            if(todasLasIntervenciones[i].id == intSeleccionada.idIntervencion){
                sel = todasLasIntervenciones[i];
            }
        }
        
        //...y se pasa como parámetro a la función que genera el árbol jerárquico.
        Navegador.setNavegadorHilo(sel);
        $("#" + intSeleccionada.idIntervencion).css("border","solid 1px #ff6600");
        $("#dialogBrowser").click(function(){
            $("#" + intSeleccionada.idIntervencion).css("border","none");
        });
        
    }catch(ex){}
}


/**
 *Guarda un marcador
 *@param {Intervencion} intervencion
 */
VentanaDialogo.prototype.agregarMarcador=function(intervencion){
    var  _controlador = new CMarcadores();
    var _err="";
    
    //bool
    var _exito = _controlador.guardarMarcador(Controlador.SesionActual, intervencion, _err);
    if(_exito){
        notificar("Marcador guardado exitosamente");
    }
    else{
        //Notificar "No se pudo guardar el marcador: "_err
        notificar("No se pudo guardar el marcador: " + _err);
    }
}

VentanaDialogo.prototype.initializeComponents=function(){
    $("#btnRefrescar").click(function(){
        me.btnRefrescar_Click(this);
    });
        
    $("#cmbUsuarios").change(function(event){
        me.cmbUsuarios_SelectionChanged(this,event);
    });
    
    $("#btnVerTodasActas").click(function(){
        me.btnVerTodasActas_Click(this);
    });
    
    $("#btnParticipar").click(function(){
        me.btnParticipar_Click(this);
    });
    
    $("#btnGuardarActa").click(function(){
        me.btnGuardarActa_Click(this);
    });
    
    $("#btnVerEstadisticas").click(function(){
        me.btnVerEstadisticas_Click(this);
    });
    
    $("#btnConfigurar").click(function(){
        me.btnConfigurar_Click(this); 
    });
    
   
}


VentanaDialogo.prototype.btnConfigurar_Click=function(sender){
    vNotas[vNotas.length] = window.open("VentanaConfigurarDialogo.php", "_vnota");
}

VentanaDialogo.prototype.btnVerEstadisticas_Click=function(sender){
    
    //var _vtn = new VentanaEstadísticas(Controlador);
    //_vtn.cargarEstadisticas();
    //    var cont = Controlador;
    //    cont.intervenciones = null;
    //    cont.tipodeMovidasActuales = null;
    //    cont.dialogoActual.intervenciones = null;
    //    cont.dialogoActual.categorias = null;
    //    cont.reglasActuales = null;
    //    cont.dialogoActual.ActaUsuario = null;
    
    
    vNotas[vNotas.length] = window.open("VentanaEstadisticas.php", "_vnota");
//redirigir a la página.
}

VentanaDialogo.prototype.btnGuardarActa_Click=function(sender){
    //CActa
    var _controlador = new CActa(Controlador.SesionActual);
    
    try{
        var _acta = Controlador.dialogoActual.ActaUsuario;
        _acta.TextoActa = $("#txtActaUsuario").wysiwyg("getContent")[0].value;
        
        if($.trim(_acta.TextoActa)==""){
            return;
        }
        
        var _msgError="";
        var _exito = _controlador.guardarActa(Controlador.dialogoActual, _acta, _msgError);
        
        if(_exito){
            //            $("#textoNotificar").html("El acta fue exitosamente guardada.");
            //            $("#notificar").dialog("open");
            notificar("El acta fue exitosamente guardada");
        }
        else{
            //            $("#textoNotificar").html("No se pudo guardar el acta. "+_msgError);
            //            $("#notificar").dialog("open");
            notificar("No se pudo guardar el acta.<br>"+ _msgError);
        }
    }catch(ex){
        //        $("#textoNotificar").html("No se pudo guardar el acta.");
        //        $("#notificar").dialog("open");
        notificar("No se pudo guardar el acta");
    }
}

VentanaDialogo.prototype.btnParticipar_Click=function(sender){
    /*$("#tabs").tabs({
        selected:1
    });
    */
}

VentanaDialogo.prototype.cmbUsuarios_SelectionChanged=function(sender,event){
    if(sender.selectedIndex<=0){
        $("#txtActaOtroUsuario").html("");
    }
    
    var _acta;
    for(var i=0;i<me.actas.length;i++){
        if(me.actas[i].UsuarioCreador.nombreUsuario == sender.value){
            _acta = me.actas[i];
        }
    }
    
    try{
        if(_acta.TextoActa != null){
            $("#txtActaOtroUsuario").html(_acta.TextoActa);
        }
    }catch(ex){}
}

VentanaDialogo.prototype.btnVerTodasActas_Click=function(sender){
    //colocar como visible la pestaña ver todas actas.
    $("#listado_actas").show();
    //$("#todasActas").show();
    //pestaña como activa.
    $("#txtActaOtroUsuario").html("");
    
    /*$("#tabs").tabs({
        selected:2
    });
    */
    //Actas[]
    me.actas = Controlador.obtenerTodasLasActas();
    //vaciar el combobox
    $("#cmbUsuarios").empty();
    //cargarle las actas.
    $("#cmbUsuarios").append("<option></option>");
    for(var i=0;i<me.actas.length;i++){
        $("#cmbUsuarios").append("<option>"+me.actas[i].UsuarioCreador.nombreUsuario+"</option>");
    }
}
VentanaDialogo.prototype.btnRefrescar_Click=function(sender){
    
    try{
        
        var _exito = Controlador.actualizarDialogoActual(Controlador.dialogoActual.idDialogo);
        if(_exito){
            var _dialogo = Controlador.dialogoActual;
            this.cargarDialogo(_dialogo);
        }
        
        
    }catch(ex){
        
    }
}

VentanaDialogo.prototype.crearTablaReglas=function(){
    /*$("#dgReglas").dataTable({
        "bJQueryUI" : true,
        "bPaginate" : false,
        "bScrollInfinite" : true,
        "sScrollY" : "150px",
        "bScrollCollapse" : true,
        "bServerSide" : false,
        "bFilter":false,
        "oLanguage":{
            "sInfo": "Mostrando _TOTAL_ reglas asociadas",
            "sProcessing": "Cargando...",
            "sEmptyTable": "No hay reglas asociadas",
            "sInfoEmpty": ""
        },
        "aoColumns":[
        {
            "sTitle":"Reglas",
            "bSortable":true,
            "sWidth":"100%"
        }
        ]
    });*/
}
/** 
 * Carga los datos del diálogo indicado en el sistema.
 * @param {Dialogo} dialogo
 * @return {void}
 */
VentanaDialogo.prototype.cargarDialogo = function(dialogo) {
    
    try {
        document.title ="Dialogando - " + dialogo.Titulo;
        $('#barra-estado li:last').html(dialogo.Titulo);
        $("#tituloPaginaActual a").text("Dialogando - " + dialogo.Titulo);
        
        $("#lblTitulo").text(dialogo.Titulo);
        $("#lblFechaCreacion").text(dialogo.FechaCreacion);
        $("#lblNombreUsuario").text(dialogo.usuarioCreador.nombreCompleto+" ("+dialogo.usuarioCreador.nombreUsuario+")");
        
        //propiedades de tabs.
        //-borrar el contenido de la tabla reglas.
        //$("#dgReglas").dataTable().fnDestroy();
        if (dialogo.Reglas.length > 0) $("#dgReglas tbody").empty();
        me.crearTablaReglas();
        //-asignar las reglas a la tabla reglas.
        for(var i = 0;i<dialogo.Reglas.length;i++){
            $("#dgReglas tbody").append('<tr><td>' + dialogo.Reglas[i].textoRegla + '</td></tr>');
        }

    } catch(ex) {
        //alert('Error ventanadialogoJS')
    }

    try {
        if(dialogo.ActaUsuario.TextoActa != null){
            $("#txtActaUsuario").wysiwyg('setContent', dialogo.ActaUsuario.TextoActa);
        }
    } catch(ex) {
    }

    try {
        //se agregan las categorias de movidas del dialogo a los tipos de movidas para la corrección
        //en Navegador (NavegadorHilo).
        //Navegador.tiposMovida = dialogo.categoria.movidas;
        Navegador.setTiposMovida(dialogo.categoria.movidas);
        
    } catch(ex) {
    }

    try {
        //:Usuario
        var _usu = Controlador.SesionActual.usuario;

        if(_usu.Rol == _usu.ROL_ADMINISTRADOR || (_usu.nombreUsuario == dialogo.usuarioFacilitador.nombreUsuario)) {
            //boton ver todas las actas activado.
            $("#btnVerTodasActas").show();
            Navegador.modoFacilitador = true;
            //boton configurar visible;
            $("#btnConfigurar").css("visibility","visible");
            //boton participar collapsed.
            $("#btnParticipar").hide();
        } else {
            //boton ver todas las actas collapsed
            $("#btnVerTodasActas").hide();
            Navegador.modoFacilitador = false;
            //boton configurar collapsed.
            $("#btnConfigurar").css("visibility","hidden");
        }
    } catch(ex) {
    }

    try {
        //setea imagen del creador en la vista.
        //En la aplicación origina se solicita al servidor, dado que se envía el objeto completo.
        //Ahora, dado que el objeto Usuario contiene solo la dirección, ésta no se solicita al servidor
        //ya que viene en el objeto usuario
        var _csesion = new CSesion();
        dialogo.usuarioCreador.imagen = _csesion.obtenerArchivoUsuario("", dialogo.usuarioCreador.nombreUsuario);
        //alert(dialogo.usuarioCreador.email);
        
        var g;
        if (_usu.email) g = "http://www.gravatar.com/avatar/" + calcMD5(_usu.email) + "/?s=50";
        else g = "http://www.gravatar.com/avatar/" + calcMD5('bb@asdasdasjkl.asd') + "/?s=50";
        
        $("#imagenUsuario img").prop("src", g);
        
    } catch(ex) {
    }
    
    try{
    //:Intervencion
    //var intSeleccionada = dialogo.intervenciones[0];
    //seleccionarIntervencion(intSeleccionada);
    }catch(ex){
        
    }
    
    
    
    //carga DialogBrowser.
    controlHilo = new DialogBrowser();
    controlHilo.intervenciones = Controlador.getIntervencionesActuales();
    controlHilo.refrescar();
    //Carga NavegadorHilo.
    //se anidan las intervenciones
//    $("#background").show();
    Navegador.limpiar();
    Navegador.agregarNodoRaiz(controlHilo.intervenciones[0]);
    Navegador.agregarNodos(controlHilo.intervenciones);
    //se carga el arbol jerárquico con la lista anidada.
    
    Navegador.setNavegadorHilo(Navegador.nodosAgregados[0]);
//    $("#background").hide();
    
    
}

VentanaDialogo.prototype.remueveTabdeLista = function(idInter){
    for(var i=0;i<this.listaNodos.length;i++){
        if(this.listaNodos[i].ContenidoAsociado.idIntervencion == idInter){
            this.listaNodos[i]=null;
        }
    }
}


/**@param {Intervencion} inter
 */
VentanaDialogo.prototype.buscarTab = function(inter){
    //para cada elemento en listaNodos
    for(var i=0;i<this.listaNodos.length;i++){
        if(this.listaNodos[i].ContenidoAsociado.idIntervencion == inter.idIntervencion){
            return this.listaNodos[i];
        }
    }
    return null;
//verificar si el texto que da origen es el mismo.
}

VentanaDialogo.prototype.buscarNodoWidget=function(control){
    try{
        for(var i=0;i<this.listaNodos.length;i++){
            if(this.listaNodos[i].ContenidoAsociado.idIntervencion == control){
                return this.listaNodos[i];
            }
        }
        return null;
    }catch(ex){}
    return null;
}

/**Gestiona el guardar de una sugerencia de tipo movida
 *@param {Intervencion} intervencion Intervencion asociada.
 *@param {Movida} movida Tipo de movida
 */
VentanaDialogo.prototype.guardarSugerenciaMovida = function(intervencion, movida){
    //alert("ventanaDialogo.guardarSugerenciaMovida");
    
    var _err="";
    //bool
    var _exito = Controlador.guardarSugerencia(intervencion, movida, _err);
    if(_exito){
        //notificar "sugerencia guardada con éxito."
        //        $("#textoNotificar").html("Sugerencia guardada con éxito.");
        //        $("#notificar").dialog("open");
        notificar("Sugerencia guardada con éxito");
    }else{
        //        $("#textoNotificar").html("No se pudo guardar la sugerencia: "+_err);
        //        $("#notificar").dialog("open");   
        notificar("No se pudo guardar la sugerencia: " + _err);
    }
//notificar "No se pudo guardar la sugerencia: "+_err
}
/**
 * @param {Intervencion} intervencion Intervencion que da origen a la respuesta
 * @param {string} texto Texto que da origen a la respuesta
 */
VentanaDialogo.prototype.agregarTabRespuesta=function(intervencion, texto){
    //intervencion = intervencion.split("_");
    //alert(texto+" ,"+intervencion.id);
   
    if(this.listaNodos.length == 0){
    //        $("#controlTab").tabs("destroy");
    //        $("#controlTab").tabs();
    }
    //busco si hay un tab para esta respuesta.
    //Es decir si se está respondiendo al mismo texto.
    var _nodoExiste = this.buscarTab(intervencion);
    
    //Si no hay un tab para esa respuesta.
    if(_nodoExiste == null){
        var _nuevoNodo = new Nodo(intervencion, texto);
        
        this.listaNodos.push(_nuevoNodo);
        lista = this.listaNodos;
        //creo un nuevo elemento Nodo.-
        //Agrego el nodo a la lista de tabs.
        $tabs = $("#controlTab").tabs({
            add: function(event, ui){
                //aquí, colocar el controlEscrituraIntervencion.
                var tab_content = generaControlEscrituraIntervencion(intervencion.idIntervencion);
                $(ui.panel).append(tab_content);
                
                /**
                 *Configura los elementos interiores de cada pestaña respuesta al ser creada.
                 *Botones, cuadro de texto
                 */
                {
                    $("#cmbTipoIntervencion_"+intervencion.idIntervencion).change(function(){
                        for(var i=0;i<Navegador.tiposMovida.length;i++){
                            if($("#cmbTipoIntervencion_"+intervencion.idIntervencion+" option:selected").val() == Navegador.tiposMovida[i].Nombre){
                                $("#cmbTipoIntervencion_"+intervencion.idIntervencion).prop("title",Navegador.tiposMovida[i].descripcion);
                                $("#lblExplicacionMovida_"+intervencion.idIntervencion).html(Navegador.tiposMovida[i].descripcion);
                            }
                        }
                    });
                    //falta setear los elementos al interior del combobox
                    /*Seteo de elementos en cmbTipoMovidas*/
                    me.controlTextoIntervencion.setComboMovidas(Controlador.tipodeMovidasActuales);
                    //                    $(".cmbTipoIntervencion").empty();
                    //                    for(var i=0;i<Navegador.tiposMovida.length;i++){
                    //                        $(".cmbTipoIntervencion").append("<option>"+Navegador.tiposMovida[i].Nombre+"</option>");
                    //                    }
                    
                    
                    $("#btnEnviar_"+intervencion.idIntervencion).button();
                    $("#btnEnviar_"+intervencion.idIntervencion).click(function(){
                        //alert("Enviar");
                        //obtener el texto escrito en el cuadro de texto.
                        var _idIntervencion = this.id.replace("btnEnviar_","");
                        var _htmlString = $("#txtIntervencion_"+_idIntervencion).val();
                        
                        //obtener el elemento seleccionado desde cmbTipoIntervencion
                        //obtener su objeto Movida.
                        var _seleccionado = $("#cmbTipoIntervencion_"+_idIntervencion+" option:selected").val();
                        var _valor = null;
                        for(var i=0;i<Navegador.tiposMovida.length;i++){
                            if(Navegador.tiposMovida[i].Nombre == _seleccionado){
                                _valor = Navegador.tiposMovida[i];
                            }
                        }
                        //llamar a publicarIntervencion
                        me.publicarIntervencion(_idIntervencion, _valor, _htmlString);
                    });
                    
                    $("#btnCancelar_"+intervencion.idIntervencion).button();
                    $("#btnCancelar_"+intervencion.idIntervencion).mouseover(function(){
                        $("#tab_"+intervencion.idIntervencion).tipsy("hide");
                    });
                    $("#btnCancelar_"+intervencion.idIntervencion).click(function(){
                        //cierra el tab actual.
                        var _p=$(this)[0].id.replace("btnCancelar", "tab");
                        $("#controlTab").tabs("remove",_p);
                        //removerlo de la lista.
                        
                        
                        for(var i=0;i<lista.length;i++){
                            if(lista[i].ContenidoAsociado.idIntervencion == intervencion.idIntervencion){
                                lista.splice(i,1);
                            }
                        }
                    });
                    
                    $("#txtIntervencion_"+intervencion.idIntervencion).wysiwyg({
                        controls : {
                            bold : {
                                visible : true
                            },
                            italic : {
                                visible : true
                            },
                            underline : {
                                visible : true
                            },

                            separator00 : {
                                visible : true
                            },

                            justifyLeft : {
                                visible : true
                            },
                            justifyCenter : {
                                visible : true
                            },
                            justifyRight : {
                                visible : true
                            }
                        }
                    });
                }//FIN
                $(this).focus();
            }
        });
        
        
        
        
        //agrega la nueva pestaña y setea el header.
        var identificador_tab = intervencion.idIntervencion;
        $("#controlTab").tabs("add","#tab_"+identificador_tab,"Respuesta a "+_nuevoNodo._textoTitulo);
        //setea la nueva pestaña como activa.
        $("#controlTab").tabs("select","tab_"+identificador_tab);
        //        $("#tab_"+identificador_tab).tipsy({
        //            gravity : 's',
        //            html : true,
        //            bgcolor : "#ff6600",
        //            txtcolor : "#dddddd",
        //            title : function() {
        //                var _texto = "<b>Respuesta para<b>";
        //                var text = $(intervencion.Texto).text();
        //                _texto+=text;
        //                return _texto;
        //            }
        //        });
        
        $("#tab_"+identificador_tab).prop("title","Respuesta para "+ me.escapeHtml(intervencion.Texto));
        
        //Mueve la página hasta abajo, para dejar visible la zona de respuesta
        location.href="#final";
        $(".cmbTipoIntervencion").change();
    }
    else{
    //se selecciona la pestaña que contiene ese texto.
    // $("#controlTab").tabs("select","tab_"+intervencion.idIntervencion+"_"+nodo._textoTitulo.substring(7,9));
    }
    
    
//lo agrego a la lista de nodos.
//dejo la nueva tab como seleccionada.
//se setean las movidas del tab actual.
}

VentanaDialogo.prototype.escapeHtml=function(string){
    var _ret = string.replace(/<br>/gi, "\n");
    _ret = _ret.replace(/<div align="center">|<div align="left">|<div align="right">/gi, "");
    _ret = _ret.replace(/<i>|<u>|<b>/gi, "");
    _ret = _ret.replace(/<\/div>|<\/b>|<\/i>|<\/u>/gi,"");
    
    
    return _ret;
}
    
/*
 *Abre una nueva ventana Notas.
 *@param {Intervencion} intervencion
 */
VentanaDialogo.prototype.abrirVentanaNotas=function(intervencion){
    //Crea una ventanaNotas a la vez.
    //Cada ventana depende de VentanaDialogo.
    
    
    
    intervencion.Texto = "";
    if(intervencion.intervencionRespuesta != null)
        intervencion.intervencionRespuesta.Texto="";
    
    //cierro saco de la lista las ventanaNotas que estén cerradas.
    for(var i=0;i<vNotas.length; i++){
        if(vNotas[i].closed){
            vNotas.splice(i,1);
            i=0;
        }
    }
    var abrirNueva = true;
    var vNotaActual=null;
    if(vNotas.length > 0){
        for(var i=0; i<vNotas.length; i++){
            if(vNotas[i].idIntervencion == intervencion.idIntervencion){
                abrirNueva = false;
                vNotaActual = vNotas[i];
                break;
            }
        }
    }else{
        abrirNueva = true;
    }
    
    if(abrirNueva){
        var ventanaNotaActual = window.open("VentanaNotas.php?intervencion="+JSON.stringify(intervencion.idIntervencion),"vNota_"+intervencion.idIntervencion, "width=320,height=300,location=no,resizable=no");  
        vNotas.push(ventanaNotaActual);
    }else{
        vNotaActual.focus();
    }
//        var _ventana = new VentanaNotas(Controlador.SesionActual);
//        if(intervencion.Notas == null || intervencion.Notas.length ==0){
//            //CNotas
//            var _controlador = new CNotas(Controlador.SesionActual);
//            //Nota
//            var _n=_controlador.crearNota();
//            _n.Autor = Controlador.SesionActual.Usuario;
//            intervencion.Notas[0]=_n;
//            _n.intervencionPadre = intervencion;
//        }
//        
//        //Aquí mostrar la ventana de notas.
//        //_ventana.Owner = this;
//        _ventana.mostrarNota(intervencion.Notas[0]);
//        //mostrar.
//        $("#dialogoNotas").dialog("open");
//    
   
}

/**Publica una intervencion.
 *@param {string} idIntervencion Id de la intervencion que da origen a la respuesta.
 *@param {Movida} codigoMovida objeto de tipo movida.
 *@param {string} texto texto de la nueva intervencion.
 */
VentanaDialogo.prototype.publicarIntervencion=function(idIntervencion, codigoMovida, texto){
    //alert("publicarIntervencion");
    var _nodoOrigen = this.buscarNodoWidget(idIntervencion);
    
    if($.trim(texto) == ""){
        return;
    }
    //setear cursor a wait.
    _nodoOrigen.ContenidoAsociado.TextoRespuesta = _nodoOrigen.Texto;
    var _exito = Controlador.publicarIntervencion(_nodoOrigen.ContenidoAsociado, texto, codigoMovida);
    if(_exito){//_exito){
        
        try{
            
           notificar("La intervención fue guardada");
           
            //remover el tab.
            $("#controlTab").tabs("remove","tab_" + idIntervencion);
            //remover de listaNodos
            for(var i=0;i<this.listaNodos.length;i++){
                if(this.listaNodos[i].ContenidoAsociado.idIntervencion == idIntervencion){
                    this.listaNodos.splice(i,1);
                }
            }
            
            
            //actualizar el dialogo actual.
            //Controlador = new CDialogo(this.sesion);
            _exito = Controlador.actualizarDialogoActual(Controlador.dialogoActual.idDialogo);
            if(_exito){//_exito){
                //controlHilo.Intervenciones = Controlador.intervencionesActuales;
                var _dialogo = Controlador.dialogoActual;
                this.cargarDialogo(_dialogo);
            }
        }
        catch(ex){
            
        }
    }else{
//        $("#textoNotificar").html("No se pudo guardar la intervención.");
//        $("#notificar").dialog("open");
notificar("No se pudo guardar la intervención.");
    }
    
}


/**
 *Obtiene la imagen de usuario derechamente del servidor,
 *ya que la imagen por defecto, es manejada desde allí también.
 */
VentanaDialogo.prototype.getImage=function(usuario){
    try{
        if(usuario.imagen == null){
            var _csesion = new CSesion();
            var _file = _csesion.obtenerArchivoUsuario(Controlador.SesionActual, usuario);
        }
        
        return _file;
    }catch(ex){
        
    }
    return;
}



/**Genera el control Escritura Intervencion para ser ingresado programáticamente 
 *a cada tab de respuesta.
 */
function generaControlEscrituraIntervencion(idIntervencionResponder){
    
    //inicializa widgets del control

    _ret = "<div>"+
    "<label for=\"intervencion\" class=\"lblIntervencion\">Texto de la intervención</label>"+
    "<div class=\"intervencion\" >"+
    "<textarea class=\"txtIntervencion\" id=\"txtIntervencion_"+idIntervencionResponder+"\" cols=\"105\"></textarea>"+
    "</div> "+

    "<div class=\"clear\" style=\"height: 10px;\"></div>"+

    "<div class=\"tipoIntervencion\" style=\"float: left; width: 200px;\">"+
    "<label for=\"cmbTipoIntervencion\" class=\"lblTipoIntervencion\">Tipo de intervención:</label>"+
    "<select class=\"cmbTipoIntervencion\" id=\"cmbTipoIntervencion_"+idIntervencionResponder+"\" style=\"float: left; width: 200px;\">"+
    "</select>"+
    " </div>"+
    "<div class=\"grid_3 lblExplicacionMovida\" id=\"lblExplicacionMovida_"+idIntervencionResponder+"\" style=\"height: 50px; float:left; overflow:auto;\"></div>"+
    " <div class=\"botonesIntervencion\" style=\"float: left; margin-left: 10px; margin-top: 5px; \">"+
    "<button class=\"btnEnviar\" id=\"btnEnviar_"+idIntervencionResponder+"\">Enviar</button>"+
    "<button class=\"btnCancelar\" id=\"btnCancelar_"+idIntervencionResponder+"\">Cancelar</button>"+
    "</div>"+
    "</div>"+
    "<div class=\"clear\"></div>";
    
    return _ret;
}
/**
 * @param {Intervencion} contenido
 * @param {string} TextoRespuesta
 */
function Nodo(contenido, TextoRespuesta){
    
    //tabItem
    this.Tab;
    this.Texto;
    //Intervencion
    this.ContenidoAsociado;
    //ControlEscrituraIntervencion
    this.Widget;
    
    if(contenido==null && TextoRespuesta==null){
    //this.Widget = new ControlEscrituraIntervencion();
        
    //this.Tab = new TabIten();
    //Tab.Content == Widget;
    }else{
        this.ContenidoAsociado = contenido;
        this.Texto = TextoRespuesta;
        
        this._textoTitulo = "";
        var _txt = TextoRespuesta;
        //        if(_txt == ""){
        //            _txt = TextoRespuesta;
        //        }
        if(_txt.substr(1,3)=="div"){
            var htmlObj = $(_txt);
            var value = new Array();
            for(var i=0;i<htmlObj.length;i++){
                if(htmlObj[i].className == "parrafo"){
                    value[i]=htmlObj[i].innerHTML;
                }
            }
            _txt = "";
            for(i=0;i<value.length;i++){
                _txt+=value[i]+" ";
            }
            TextoRespuesta = _txt;
        }
        if(TextoRespuesta.length > 10){
            //var text = TextoRespuesta.replace("<br>", " ");
            this._textoTitulo = TextoRespuesta.substr(0, 10)+"...";
        }else{
            this._textoTitulo =TextoRespuesta;
        //setea tooltips
            
        }
    }
    
}
