$(function(){
    
    $("#publicar button").button();
  
   
    
    /**Inicialización de la clase VentanaNuevoDialogo**/
    {
        
        if(opener.VentanaPrincipal != null){
            vnd = new VentanaNuevoDialogo(opener.my.sesionActual);
        }
        
    }


});

/**
 * @param {Sesion} sesion
 */
function VentanaNuevoDialogo(sesion){
    me = this;
    this.ventanaConfigurarDialogo;
    this.controladorDialogo=new CDialogo(sesion);
    this.controlTextoIntervencion = new controlEscrituraIntervencion();
    this.controlTextoIntervencion.mostrarBotonEnviar(false);
    
    var _exito = this.controladorDialogo.crearDialogoVacio();
    if(_exito){
        this.actualizarConfiguracion();
    }else{
        alert("No se puede conectar con el servidor.\n\nSe cerrará esta ventana.");
        window.close();
    }
    
    this.InitializeComponents();
    document.title="Creando un nuevo diálogo.";
    
    
}

window.onbeforeunload=function(){
    me.ventanaConfigurarDialogo.close();
}

VentanaNuevoDialogo.prototype.InitializeComponents=function(){
    $("#btnAbrirConfiguracion").click(function(){
        me.ventanaConfigurarDialogo = window.open("VentanaConfigurarDialogo.php", "ventana"); 
    });
    
    $("#txtTitulo").focus();
   
    $("#btnEnviar").click(function(event){
        me.btnEnviar_Click(this);
        event.preventDefault();
    });
    
}

//Llamada desde VentanaConfigurarDialogo
//Solo en caso de que ésta sea el padre.
VentanaNuevoDialogo.prototype.actualizarConfiguracion=function(){
    //El funcionamiento de window.open ni window.openDialog no es igual al de .net
    //En .net, es posible esperar a que la ventana comience a cerrarse para recoger información desde ella.
    //En JS, en caso de retornar valores, se retornan al momento de la creación de la ventana.
    //alert("p");
    //var p=me.ventanaConfigurarDialogo;
    if(me.ventanaConfigurarDialogo!=null){
        me.controladorDialogo=me.ventanaConfigurarDialogo.me.controlador;
        
    }
    
    //asignación de categoría.
    try{
        //CategoriaMovida
        var _catSel=me.controladorDialogo.categoriaSeleccionada;
        
        //Selección de movida predeterminada.
        //Obtención.
        var _movsel = me.controladorDialogo.obtenerMovidaPredeterminada(_catSel.idCategoria);
        //recupero el nombre de la movida.
        for(var i=0; i<_catSel.movidas.length; i++){
            if(_catSel.movidas[i].IdMovida == _movsel){
                _movsel = _catSel.movidas[i];
                break;
            }
        }

        
        
        $("#txtPerfilMovidasSeleccionado").html(_catSel.nombre);
        $("#txtPerfilMovidasSeleccionado").prop("title",_catSel.descripcion);
        //Setear el combo de movidas del controlTextoIntervencion.
        this.controlTextoIntervencion.setComboMovidas(_catSel.movidas);
        
        if(_movsel != 0){
            //Se selecciona después de setear el cmb.
            var cmb = $(".cmbTipoIntervencion")[0];
            for(i=0;i<cmb.options.length;i++){
                if(cmb.options[i].text == _movsel.Nombre){
                    cmb.options[i].selected = true;
                    $(".cmbTipoIntervencion").change();
                    break;
                }
            }
        
            $(".cmbTipoIntervencion").attr("disabled","disable");
        }else{
            $(".cmbTipoIntervencion").removeAttr("disabled");
        }
    }catch(ex){}
    
    try{
        $("#txtReglasSeleccionadas").empty();
        $("#txtReglasSeleccionadas").append(me.controladorDialogo.reglasActuales.length);
        if(me.controladorDialogo.reglasActuales.length > 1){
            $("#txtReglasSeleccionadas").append(" reglas asignadas.");
        }else{
            $("#txtReglasSeleccionadas").append(" regla asignada.");
        }
        $("#txtReglasSeleccionadas").prop("title",me.controladorDialogo.reglasActuales[0].textoRegla);
    }catch(ex){}
    
    try{
        $("#txtRestriccionesSeleccionadas").html("Sin restricciones");
    }catch(ex){}
    
}

VentanaNuevoDialogo.prototype.btnEnviar_Click=function(sender){
    try{
        
        if(me.datosValidos()){
            var _error ="";
            try{
                //Intervencion
                var _intActual = me.controladorDialogo.dialogoActual.intervenciones[0];
                var _exito = me.controlTextoIntervencion.actualizarIntervencion(_intActual);
                //Dialogo
                var _diag = new Dialogo();
                
                _diag = me.controladorDialogo.dialogoActual;
                _diag.Titulo = $("#txtTitulo").val();
                _diag.categoria = me.controladorDialogo.categoriaSeleccionada;
                _diag.balanceDialogo = me.controladorDialogo.balanceActual;

                if(_diag.balanceDialogo.length == 0){
                    //Usando balance por defecto.
                    var _defaultBalance = new Array();
                    for(var i=0;i<_diag.categoria.movidas.length;i++){
                        _defaultBalance[i] = new Balance();
                        _defaultBalance[i].movida = _diag.categoria.movidas[i];
                        if(i != _diag.categoria.movidas.length - 1 || i!=0){
                            _defaultBalance[i].valor = 100 / _diag.categoria.movidas.length;
                        }
                        else{
                            //Con esto se asegura que los valores de balance para las intervenciones
                            //sumen 100 sin importar la cantidad de movidas.
                            var _valoresAnteriores = 0;
                            for(var j=0; j<_defaultBalance.length;j++){
                                _valoresAnteriores += _defaultBalance[j].valor;
                            }
                            _defaultBalance[i].valor = 100 - _valoresAnteriores;
                        }
                        _defaultBalance[i].valorTolerancia = 0;
                    }
                    
                    _diag.balanceDialogo = _defaultBalance;
                }
                
                _diag.Reglas = me.controladorDialogo.reglasActuales;
                
                
                if(_exito){
                    //setea los valores de Texto y tipoMovida.
                    _diag.intervenciones[0].Texto = $(".txtIntervencion").wysiwyg("getContent").val();
                    for(var i=0;i<me.controladorDialogo.categoriaSeleccionada.movidas.length;i++){
                        if($(".cmbTipoIntervencion option:selected").val()==me.controladorDialogo.categoriaSeleccionada.movidas[i].Nombre){
                            _diag.intervenciones[0].tipoMovida = me.controladorDialogo.categoriaSeleccionada.movidas[i];
                        }
                    }
                    
                    //Llamada a publicarDialogo
                    var _exito = me.controladorDialogo.publicarDialogo(_diag, _error);
                    _exito = JSON.parse(_exito);
                    
                    if(_exito[0]){
                        //                        notificar("Diálogo publicado");
                        alert("Diálogo publicado");
                        //Actualiza la lista de diálogos de la ventana principal.
                        if(opener.VentanaPrincipal != null){
                            opener.my.actualizarListaDialogos();
                        }
                        opener.window.focus();
                        window.close();
                    }
                    else{
                        notificar("Ha ocurrido el siguiente error:<br><br><i>"+_exito[1]+"</i>");
                    }
                //alert("dialogo NO publicado");
                }else{
                }
                
            }catch(ex){
                alert(ex);
            }    
            if(_error != null && _error.length > 0){
                notificar(_error);
            }
            
            
        }
        
    }catch(ex){
        notificar("Ocurrió un error inesperado.<br>No se pudo publicar el diálogo.");
    }
    
}

/**
 * @return {bool}
 */
VentanaNuevoDialogo.prototype.datosValidos=function(){
    var _retorno = true;
    var _titulo = true;
    var _texto = true;
    try{
        if(($("#txtTitulo").val().trim().length == 0)){
            notificar("Ingrese el título");
            _titulo = false;
        }
        if($(".txtIntervencion").wysiwyg("getContent").length == 0){
            notificar("Ingrese el contenido de la intervención");
            _texto = false;
        }
    }catch(ex){}
    return _titulo && _texto;
}