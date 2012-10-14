
variableGlobal="global";function CValidacionUsuario(){}
CValidacionUsuario.prototype.registrar=function(fullname,username,password,archivoimagen,email,mensajeError){try{var _cm=new ConexionManager();var parametros=new SOAPClientParameters();var _nuevoUsuario=new Usuario();_nuevoUsuario.nombreCompleto=fullname;_nuevoUsuario.nombreUsuario=username;_nuevoUsuario.Password=password;_nuevoUsuario.email=email;for(var p in _nuevoUsuario){if(_nuevoUsuario[p]==null)
_nuevoUsuario[p]="";}
parametros.add("usuario",JSON.stringify(_nuevoUsuario));var _reg=_cm.conexion("registrarUsuario",parametros);if(!_reg[0]){$("#lblMensajeError").show("slide",null,"500",null);$("#lblMensajeError").css({'color':'red','font-weight':'bold'});$("#lblMensajeError").text(_reg[1]);}
return _reg;}catch(ex){$("#lblMensajeError").show("slide",null,"500",null);$("#lblMensajeError").css({'color':'red','font-weight':'bold'});$("#lblMensajeError").text("Hubo un problema con la conexión. Intente otra vez.");}
return false;};CValidacionUsuario.prototype.leerArchivo=function(fileName){return fileName;}
CValidacionUsuario.prototype.iniciarSesion=function(usuario,password){var _retorno=null;try{var _conexion=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("usuario",usuario);parametros.add("password",password);_retorno=_conexion.conexion("iniciarSesion",parametros);}catch(ex){_retorno=new Sesion();_retorno.MensajeError="No se pudo establecer conexión con el servidor. Verifique la conexión";}
return _retorno;}
CValidacionUsuario.prototype.verificarUsuario=function(usuario){var _retorno=false;try{var _conexion=new ConexionManager();var parametros=new SOAPClientParameters();parametros.add("usuario",usuario);_retorno=_conexion.conexion("recuperarContrasena",parametros);}catch(ex){return false;}
return _retorno;}