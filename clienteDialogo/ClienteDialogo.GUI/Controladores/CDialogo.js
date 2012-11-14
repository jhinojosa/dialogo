function CDialogo(sesionActual) {
    //this.SesionActual = new Sesion();
    this.SesionActual = sesionActual;
    //Dialogo.
    this.dialogoActual = new Dialogo();
    //Movida[]
    this.tipodeMovidasActuales;
    //CategoriaMovida[]
    this.categoriasActuales;
    //CategoriaMovida
    this.categoriaSeleccionada;
    //Regla[]
    this.reglasActuales = new Array();
    //Usuario
    this.usuarioFacilitadorActual;
    //Usuario[]
    this.usuariosPermitidosActuales;
    //Balance[]
    this.balanceActual;
    //Regla[]
    this.reglasDisponibles;
    
   
    {
        /*
         *Equivalente a intervencionesActuales de la aplicacion original.
         *Un getter.
         *@return {Intervencion[]}
         */
        this.getIntervencionesActuales = function(){
            //return dialogoActual.intervenciones;
            try{
                return this.dialogoActual.intervenciones;
            }
            catch(ex){
                var arr = new Array();
                return arr;
            }
        }
    //setter IntervencionesActuales cuando corresponda.
    }
    
}
/**
 *Obtiene las categorías del sistema.
 */
CDialogo.prototype.actualizarCategoriasPosibles=function(){
    this.cateogriasActuales = new Array();
    try{
        var _cl = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        this.categoriasActuales=_cl.conexion("listarCategoriasMovida", parametros);
        this.categoriasActuales.pop();
        for(var i=0;i<this.categoriasActuales.length;i++){
            this.categoriasActuales[i].movidas.pop();
        }
    }catch(ex){}
}

CDialogo.prototype.obtenerMovidaPredeterminada = function(idPerfil){
    var _ret = 0;
    
    try{
        var _servicio = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("iddialogo", idPerfil);
        _ret = _servicio.conexion("obtenerMovidaCrearDialogo", parametros);
    }catch(ex){
        return 0;
    }
    
    return _ret;
}


/**
 *infiere la categoría seleccionada según el balance.
 */
CDialogo.prototype.determinarCategoriaSeleccionada=function(){
    try{
        if((this.dialogoActual.balanceDialogo != null && this.dialogoActual.balanceDialogo.length > 0) && this.categoriaSeleccionada==null){
            //Movida
            var pivote = this.balanceActual[0].movida;
            for(var i=0;i<this.dialogoActual.categoria.movidas.length;i++){
                if(this.dialogoActual.categoria.movidas[i].IdMovida == pivote.IdMovida){
                    pivote = this.dialogoActual.categoria.movidas[i];
                    break;
                }
            }
            
            for(var i=0;i<this.categoriasActuales.length;i++){
                if(this.categoriasActuales[i].movidas.length == this.balanceActual.length){
                    for(var j=0;j<this.categoriasActuales[i].movidas.length;j++){
                        if(this.categoriasActuales[i].movidas[j].Nombre == pivote.Nombre){
                            this.categoriaSeleccionada = this.categoriasActuales[i];
                            this.categoriasActuales[i].movidas = this.dialogoActual.categoria.movidas;
                            return;
                        }
                    }
                }
            }
        }
    }catch(ex){
    //alert(ex);
    }
}


//retorna un arreglo.
//un arreglo de dialogo en la pos 0.
//el valor para _msgError en la pos 1.
CDialogo.prototype.listarDialogos = function(sesionActual, pagina, _msgError) {
    //_retorno es un arreglo de dialogos.
    var _retorno = new Array();
    try {
        //Conexión al servicio web.
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(sesionActual));
        parametros.add("pagina", JSON.stringify(pagina));
        //_retorno[0] = Arreglo de encabezados codificados en JSON.
        //_retorno[1] = Mensaje de error desde el servicio web.
        _retorno = _cm.conexion("listarEncabezadosDialogo", parametros);
        
    } catch(ex) {
        //        $("#notificar").dialog("open");
        //        $("#textoNotificar").html("No se pudo conectar con el servicio.");
        notificar("No se pudo conectar con el servicio.");
    }
    return _retorno;
}


CDialogo.prototype.actualizarDialogoActual = function(idDialogo) {

    
    _int = new Intervencion();
    try {
        //conexion al servicio web.
        var _conexion = new ConexionManager();
        var parametros = new SOAPClientParameters();
        
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        parametros.add("iddialogo", JSON.stringify(idDialogo));
        this.dialogoActual = _conexion.conexion("obtenerDialogoDetallado", parametros);
                
        //Parche para subsanar el error producido por PHP 5, NuSOAP o Javascript SOAPClient,
        //donde es necesario agregar una posición nula al final del arreglo para que pueda ser enviada la respuesta.
        this.dialogoActual.categoria.movidas.pop();
        this.dialogoActual.intervenciones.pop();
        this.dialogoActual.Reglas.pop();
        this.dialogoActual.balanceDialogo.pop();
        //ObtenerMovidasDialogo
        
        _conexion = new ConexionManager();
        parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        parametros.add("iddialogo", JSON.stringify(idDialogo));
        
        this.tipodeMovidasActuales = _conexion.conexion("obtenerMovidasDialogo", parametros);
        
        this.reglasActuales = this.dialogoActual.Reglas;
        
        this.usuariosPermitidosActuales = this.dialogoActual.usuariosPermitidos;
        
        if(this.dialogoActual.balanceDialogo != null){
            this.balanceActual = this.dialogoActual.balanceDialogo;
        }
        
        return true;
    } catch(ex) {
        alert("Error al obtener las intervenciones desde el servicio web.\nNO se mostrará la página.\n\n"+ex);
        window.close();
    //alert(ex);
    }

    return false;
}

CDialogo.prototype.obtenerTodasLasActas=function(){
    //Acta[]
    var _retorno = new Array();
    
    var _cm = new ConexionManager();
    var parametros = new SOAPClientParameters();
    parametros.add("sesion", JSON.stringify(this.SesionActual));
    parametros.add("dialogo", JSON.stringify(this.dialogoActual))
    _retorno = _cm.conexion("listarTodasLasActas", parametros);
    
    _retorno.pop();
    return _retorno;
}

/**
 *Indica si hay diálogos desbalanceados.
 */
CDialogo.prototype.hayDialogosDesbalanceados=function(){
    try{
        var lista = this.obtenerDialogosDesbalanceados();
        if(lista.length > 0)
            return true;
        else
            return false;
    }catch(ex){
        return false;
    }
}

/**
 *Carga una lista de los diálogos que poseen desbalance.
 */
CDialogo.prototype.obtenerDialogosDesbalanceados=function(){
    //Dialogo[]
    var _retorno = new Array();
    try{
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        _retorno = _cm.conexion("listarAlertas", parametros);
        
    }catch(ex){}
    
    return _retorno;
}

/**
 * @param {Dialogo} dialog
 */
CDialogo.prototype.obtenerEstadisticas=function(dialog){
    //DataSet
    var _ret=new Object();
    try{
        var _cm = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        parametros.add("dialogo", JSON.stringify(dialog));
        _ret = _cm.conexion("obtenerEstadisticas", parametros);
       
       
    }catch(ex){}
   
    
    return _ret;
}

/**
 * Actualiza la configuracion para el dialogo asociado al controlador.
 */
CDialogo.prototype.guardarConfiguracionDialogo=function(){
    
    var _retorno = false;
    try{
        this.dialogoActual.balanceDialogo = this.balanceActual;
        this.dialogoActual.usuarioFacilitador = this.usuarioFacilitadorActual;
        this.dialogoActual.Reglas = this.reglasActuales;
        this.dialogoActual.usuariosPermitidos = this.usuariosPermitidosActuales;
        
        var _cm = new ConexionManager();
       
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
    
    
        var dialogo = this.dialogoActual;
        dialogo.intervenciones = null;
        dialogo.ActaUsuario = null;
        parametros.add("dialogo", JSON.stringify(this.dialogoActual));
        
        _retorno = _cm.conexion("guardarConfiguracionDialogo", parametros);
   
   
    }catch(ex){
        
    }
    
    return _retorno;
}

CDialogo.prototype.crearDialogoVacio=function(){
    try{
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        this.dialogoActual = _cm.conexion("crearDialogo", parametros);
        this.dialogoActual = JSON.parse(this.dialogoActual);
        this.dialogoActual.usuarioCreador = this.SesionActual.usuario;


        if(this.categoriasActuales == null || this.categoriaSeleccionada == null){
            this.actualizarCategoriasPosibles();
            
            if(this.categoriasActuales.length > 0){
                //Por defecto se selecciona el primer elemento, podría modificarse para seleccionar bajo otro criterio.
                //this.categoriaSeleccionada = this.categoriasActuales[0];
                //Selecciona Kantor por defecto, si existe.
                for(var i=0;i<this.categoriasActuales.length;i++){
                    if(this.categoriasActuales[i].nombre.toLowerCase() == "kantor-isaacs")
                        this.categoriaSeleccionada = this.categoriasActuales[i];
                }
                if(this.categoriaSeleccionada.nombre.toLowerCase() != "kantor-isaacs")
                    this.categoriaSeleccionada = this.categoriasActuales[0];
                    
            }
        }
        this.balanceActual = this.dialogoActual.balanceDialogo;
        
     
        return true;
    }catch(ex){
        return false;
    }
}

/**
 *Ordena publicar una intervención al servicio.
 */
CDialogo.prototype.publicarIntervencion = function(intervencionOrigen, texto, codigoMovida){
    var _retorno = false;
    try{
        var _nueva = new Intervencion();
        _nueva.intervencionRespuesta = intervencionOrigen;
        _nueva.TextoRespuesta = intervencionOrigen.TextoRespuesta;
        _nueva.tipoMovida = codigoMovida;
        _nueva.usuarioCreador = this.SesionActual.usuario;
        _nueva.Texto = texto;
        
        var _cm = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        parametros.add("dialogo", JSON.stringify(this.dialogoActual));
        parametros.add("intervencion", JSON.stringify(_nueva));
        _retorno = _cm.conexion("publicarIntervencion", parametros);
        
    }catch(ex){}
    
    return _retorno;
}


/**
 * Llama al método de creación de diálogo
 * @param {Dialogo} dialogo dialogo a publicar.
 * @param {string} mensajeError
 */
CDialogo.prototype.publicarDialogo=function(dialogo, mensajeError){
   
    var _ret = false;
    try{
        var _cm = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        
        parametros.add("dialogo", JSON.stringify(dialogo));
        
        _ret = _cm.conexion("publicarDialogo", parametros);
        if(!_ret){
        // mensajeError = _cm.conexion.obtenerMensajeError();
        }
        
        return _ret;
    }catch(ex){
        mensajeError="No se pudo conectar con el servicio."
    }
    
    return _ret;
}

CDialogo.prototype.eliminarDialogo=function(idDialogo){

    var _ret = false;
    try{
        var _cm = new ConexionManager();

        var parametros = new SOAPClientParameters();
        parametros.add("iddialogo", JSON.stringify(idDialogo));
        
        //parametros.add("dialogo", JSON.stringify(dialogo));
        
        _ret = _cm.conexion("eliminarDialogo", parametros);

        confirm(_ret);
        return _ret;
    } catch(ex){
        mensajeError="No se pudo conectar con el servicio."
    }

    //confirm("HOLA");
    return _ret;
}

/**
 * 
 * Gestiona el envío de sugerencias para una movida.
 * @param {Intervencion} intervencion intervención asociada.
 * @param {Movida} movida movida a sugerir.
 * @param {string}
 * 
 */
CDialogo.prototype.guardarSugerencia = function(intervencion, movida, mensajeError){
    var _ret = false;
    try{
        var _cm = new ConexionManager();
        
        var _mov = new MovidaCorregida();
        _mov.IdMovida = movida.IdMovida;
        _mov.Nombre = movida.Nombre;
        
        intervencion.correccionMovida[0] = _mov;
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        parametros.add("intervencion", JSON.stringify(intervencion));
        _ret = _cm.conexion("guardarCorreccion", parametros);
        
        if(!_ret){
        //Obtiene el mensaje de error desde el servicio web.
        }

    }catch(ex){}
    
    return _ret;
}

CDialogo.prototype.ReglasDisponibles = function(){
    if(this.reglasDisponibles == null || this.reglasDisponibles.length == 0){
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(this.SesionActual));
        this.reglasDisponibles = _cm.conexion("listarReglasDisponibles", parametros);
        //Paliativo contra el bug descubierto en PHP o NuSOAP al retornar arreglos,
        //donde para que sea correcta la recepción de los datos, debe incluir un elemento nulo
        //en el arreglo.
        this.reglasDisponibles.pop();
    }
    
    return this.reglasDisponibles;
}


CDialogo.prototype.buscarHijos=function(intervencionSeleccionada){
    var _listaHijos = new Array();
    _listaHijos.push(intervencionSeleccionada);
    var intervencionesActuales = this.getIntervencionesActuales();
    
    for(var i=0;i<intervencionesActuales.length;i++){
        if(intervencionesActuales[i]!=null && intervencionesActuales[i].intervencionRespuesta != null){
            if(this.ListaContiene(_listaHijos, intervencionesActuales[i].intervencionRespuesta) && !this.estaEn(_listaHijos, intervencionesActuales[i])){
                _listaHijos.push(intervencionesActuales[i]);
            }
        }
    }
    
    return _listaHijos;
}

CDialogo.prototype.estaEn=function(_arreglo, objeto){
    for(var i=0;i<_arreglo.length;i++){
        if(_arreglo[i] == objeto){
            return true;
        }
    }
    return false;
}


CDialogo.prototype.ListaContiene=function(lista, elemento){
    for(var i=0;i<lista.length;i++){
        if(lista[i].idIntervencion == elemento.idIntervencion){
            return true;
        }
    }
    return false;
}