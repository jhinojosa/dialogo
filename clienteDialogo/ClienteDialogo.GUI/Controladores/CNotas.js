/**
 * Gestiona las llamadas a los servicios vinculados con las notas
 * @param {Sesion} sesionaActual
 */
function CNotas(sesionActual){
    this.sesionActual=sesionActual;
}

/**
 * @param {Intervencion} iOrigen
 * @param {Nota} nota
 * @param {string} mensajeError
 * @return {bool}
 */
CNotas.prototype.guardarNota=function(iOrigen, nota, mensajeError){
    var _ret =false;
    
    var _intersPadre = nota.intervencionPadre.Notas;
    try{
        nota.intervencionPadre = iOrigen;
        nota.intervencionPadre.Notas = null;
        //comunicarse con el servicio web.
        var _cm = new ConexionManager();
       
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesionactual", JSON.stringify(me.sesionActual));
        parametros.add("nota", JSON.stringify(nota));
        _ret = _cm.conexion("guardarNota", parametros);
    
    }catch(ex){
        mensajeError = "No se pudo conectar con el servicio.";
    }
    nota.intervencionPadre.Notas = _intersPadre;
    return _ret;
}

/**
 *@return {Nota}
 */
CNotas.prototype.crearNota = function(){
    //Nota
    var nueva = new Nota();
    nueva.Texto = "";
    return nueva;
}

/**
 * @param {Nota} nota
 * @param {string} _err
 * @return {bool}
 */
CNotas.prototype.eliminarNota=function(nota, _err){
    var _ret = false;
    
    
   
        
    var _cm = new ConexionManager();
  
    var parametros = new SOAPClientParameters();
    parametros.add("sesionactual", JSON.stringify(me.sesionActual));
    parametros.add("nota", JSON.stringify(nota));
    _ret = _cm.conexion("eliminarNota", parametros);
  
    return _ret;
}