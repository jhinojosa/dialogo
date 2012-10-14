
function CNotas(sesionActual){this.sesionActual=sesionActual;}
CNotas.prototype.guardarNota=function(iOrigen,nota,mensajeError){var _ret=false;var _intersPadre=nota.intervencionPadre.Notas;try{nota.intervencionPadre=iOrigen;nota.intervencionPadre.Notas=null;var _cm=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesionactual",JSON.stringify(me.sesionActual));parametros.add("nota",JSON.stringify(nota));_ret=_cm.conexion("guardarNota",parametros);}catch(ex){mensajeError="No se pudo conectar con el servicio.";}
nota.intervencionPadre.Notas=_intersPadre;return _ret;}
CNotas.prototype.crearNota=function(){var nueva=new Nota();nueva.Texto="";return nueva;}
CNotas.prototype.eliminarNota=function(nota,_err){var _ret=false;var _cm=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesionactual",JSON.stringify(me.sesionActual));parametros.add("nota",JSON.stringify(nota));_ret=_cm.conexion("eliminarNota",parametros);return _ret;}