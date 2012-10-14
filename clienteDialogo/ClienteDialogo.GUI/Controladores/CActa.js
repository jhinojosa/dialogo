
/** Gestiona las llamadas a los servicios vinculados con el acta de una intervención.
 * @param {SesionActual} sesionActual
 */
function CActa(sesionActual){
    //Sesion
    this.SesionActual=sesionActual;
    
}

/**
 * @param {Dialogo} dialogo
 * @param {Acta} acta
 * @param {string} mensajeError
 * @return {bool}
 */
CActa.prototype.guardarActa=function(dialogo,acta,mensajeError){
    var _ret =false;
    try{
        dialogo.ActaUsuario = acta;
        
        acta.UsuarioCreador = this.SesionActual.usuario;
    
    var _cm = new ConexionManager();
    
    dialogo.intervenciones = null;
    var parametros = new SOAPClientParameters();
    parametros.add("sesion", JSON.stringify(this.SesionActual));
    parametros.add("dialogo", JSON.stringify(dialogo));
    _ret = _cm.conexion("guardarActaDialogo", parametros);
   
        
    }catch(ex){
        //mensajeError = "No se pudo conectar con el servicio";
        
    }
    return _ret;
}