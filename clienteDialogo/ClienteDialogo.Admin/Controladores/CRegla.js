
function CRegla(sesionActual){this.sesionActual=sesionActual;this.reglasActuales;}
CRegla.prototype.listarReglas=function(){var _retorno=new Array();try{var _cm=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesion",JSON.stringify(this.sesionActual));_retorno=_cm.conexion("listarReglasDisponibles",parametros);this.reglasActuales=_retorno;}catch(ex){}
return _retorno;}
CRegla.prototype.agregarRegla=function(texto){if(typeof(this.reglasActuales)=="undefined"||this.reglasActuales!=null){for(var i=0;i<this.reglasActuales.length;i++){if(this.reglasActuales[i].textoRegla==texto){return null;}}}
var nueva=new Regla();nueva.idRegla=0;nueva.textoRegla=texto;if(this.reglasActuales==null){this.reglasActuales=new Array();}else{var reglas=this.reglasActuales;reglas.push(nueva);this.reglasActuales=reglas;}
return nueva;}
CRegla.prototype.guardarReglas=function(){var _retorno=false;try{var _cm=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("sesion",JSON.stringify(this.sesionActual));var _rules=new Array();for(var i=0;i<this.reglasActuales.length;i++){if(this.reglasActuales[i].textoRegla.length!=0)
_rules.push(JSON.stringify(this.reglasActuales[i]));}
if(_rules.length==0)
return;parametros.add("reglas",_rules);_retorno=_cm.conexion("guardarRegla",parametros);}catch(ex){}
return _retorno;}