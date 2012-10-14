
function CActa(sesionActual){this.SesionActual=sesionActual;}
CActa.prototype.guardarActa=function(dialogo,acta,mensajeError){var _ret=false;try{dialogo.ActaUsuario=acta;acta.UsuarioCreador=this.SesionActual.usuario;var _cm=new ConexionManager();dialogo.intervenciones=null;var parametros=new SOAPClientParameters();parametros.add("sesion",JSON.stringify(this.SesionActual));parametros.add("dialogo",JSON.stringify(dialogo));_ret=_cm.conexion("guardarActaDialogo",parametros);}catch(ex){}
return _ret;}