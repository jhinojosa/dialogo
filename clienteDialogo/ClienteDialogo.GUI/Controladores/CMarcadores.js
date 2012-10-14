/**
 * ¨Gestiona las llamadas a los servicios vinculados con los marcadores
 */

function CMarcadores(){
    
}

/**
 * @param {Sesion} sesionActual
 * @param {string} msgError
 * @return {Marcador[]}
 */
CMarcadores.prototype.listarMarcadores=function(sesionActual, msgError){
    //Marcador[]
    var _ret = new Array();
    try{
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion",JSON.stringify(sesionActual));
        _ret = _cm.conexion("listarMarcadores", parametros);
    }catch(ex){
        msgError = "Ocurrió un error al intentar conectar con el servicio."
    }
    
    return _ret;
}

/**
 * @param {Sesion} sesion
 * @param {intervencion} intervencion
 * @param {string} msgError
 * @return {bool}
 */
CMarcadores.prototype.guardarMarcador=function(sesion, intervencion, msgError){
    var _ret = false;
    try{
        var _marcador = new Marcador();
        _marcador.usuarioPadre = sesion.usuario;
        _marcador.dondeApunto = intervencion;
        
        var _cm = new ConexionManager();
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(sesion));
        parametros.add("marcador", JSON.stringify(_marcador));
        _ret = _cm.conexion("agregarMarcador", parametros);
   
    }catch(ex){
        msgError = "Ocurrió un error al intentar conectar con el servicio."
    }
    
    return _ret;
}

/**
 * @param {Sesion} sesionActual
 * @param {string} nombreUsuario
 * @param {string} msgError
 * @return {Marcador[]}
 */
CMarcadores.prototype.buscarIntervenciones=function(sesionActual, nombreUsuario, msgError){
    var _ret = new Array();
    try{
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(sesionActual));
        parametros.add("nombreUsuario", JSON.stringify(nombreUsuario));
        
        _ret = _cm.conexion("buscarIntervencion", parametros);
    }catch(ex){
        msgError = "Ocurrió un error al intentar conectar con el servicio.";
    }
    return _ret
}