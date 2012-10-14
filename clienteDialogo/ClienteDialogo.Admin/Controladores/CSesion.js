
/// Gestiona las llamadas a los servicios vinculados con los usuarios y sesiones
function CSesion(){
    
}

//string usuario, string idSesion.
//Retorna una Sesion.
CSesion.prototype.obtenerSesion = function(usuario, idSesion){
    
    //Crea un nuevo objeto Sesion.
    var retorno = new Sesion();
    try{
        
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("usuario", JSON.stringify(usuario));
        parametros.add("idsesion", JSON.stringify(idSesion));
        
        retorno = _cm.conexion("obtenerSesion", parametros);
    }catch(ex){
        alert(ex);
        //MensajeError atributo de clase Sesion.
        retorno.MensajeError ="No se pudo obtener los datos para la sesión. Verifique la conexión.";
    }
    
    return JSON.parse(retorno);
}

CSesion.prototype.obtenerArchivoUsuario=function(sesion, nombreUsuario){
    var _ret = null;
    try{
        var _nombreArchivo = "avatar_" + nombreUsuario;
        
        var parametros = new SOAPClientParameters();
        parametros.add("sesion", JSON.stringify(sesion));
        parametros.add("archivo", JSON.stringify(_nombreArchivo));
        
        var _cm = new ConexionManager();
        _ret = _cm.conexion("obtenerArchivo", parametros);
        _ret = JSON.parse(_ret);
    }catch(ex){
        
    }
    return _ret;
}