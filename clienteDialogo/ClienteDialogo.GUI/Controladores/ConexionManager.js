
function ConexionManager(){this.url="http://"+document.domain+"/servicioDialogo/servicioDialogo.php";this.parameters=new Array();this.metodo="";}
ConexionManager.prototype.Open=function(){try{return true;}
catch(ex){return false;}}
ConexionManager.prototype.Close=function(){}
ConexionManager.prototype.conexion=function(metodo,parametros){try{var _ret;_ret=SOAPClient.invoke(this.url,"ServicioDialogo."+metodo,parametros,false,false);return _ret;}catch(ex){}}