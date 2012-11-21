/**
 * Administra las conexiones con el servicio
 */

function ConexionManager(){
   
    //Dirección que contiene el servicio web
//    this.url = "http://158.170.35.34/~cchavez/servicioDialogo/servicioDialogo.php";
//    this.url2 = "http://dialogoactivo.diinf.usach.cl/servicioDialogo/servicioDialogo.php";
//    
//    this.localurl = "http://127.0.0.1/servicioDialogo/servicioDialogo.php";
    
    this.url = "http://" + document.domain + "/dialogo" +  "/servicioDialogo/servicioDialogo.php";
    
//    this.url = "http://dialogo/servicioDialogo/servicioDialogo.php";
    //Arreglo de parámetros.
    this.parameters=new Array();
    //método a llamar.
    this.metodo = "";
    
}

/**
 * Abre una conexion.
 * Se recomienda el uso de este metodo
 * por la posibilidad de agregar parámetros a la conexion
 * @return {bool}
 */
ConexionManager.prototype.Open=function(){
    try{
        //conectar con el servicio web
        //abre la conexion
        //this.conexion.Open();
        return true;
    }
    catch(ex){
        return false;
    }
}

ConexionManager.prototype.Close=function(){
    //this.conexion.Close();
    }


/**
 * @param {string} metodo Método de webservice
 * @param {SoapClienParameters} parametros
 * @return {Object} el valor recibido desde el servicio web.
 */
ConexionManager.prototype.conexion=function(metodo, parametros){
    try{
        var _ret;
        
        _ret = SOAPClient.invoke(this.url, "ServicioDialogo."+metodo, parametros, false, false);

        return _ret;
    }catch(ex){
    }

}
