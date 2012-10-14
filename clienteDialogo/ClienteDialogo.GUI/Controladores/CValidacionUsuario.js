variableGlobal = "global";

/// <summary>
/// Controlador de acceso a funciones de validación de usuarios y registro
/// </summary>
function CValidacionUsuario() {
   

}
/**
 * Registra un usuario en el sistema
 * @param {string} username
 * @param {string} contraseña
 * @param {unknown} archivoImagen
 * @param {string} email
 * @param {string} mensajeError
 * @return {bool} verdadero si registro exitoso, falso si no.
 */
CValidacionUsuario.prototype.modificar = function(fullname, username, oldpassword, password, archivoimagen, email, mensajeError) {
        
    try{
        var _cm = new ConexionManager();
        var parametros = new SOAPClientParameters();
    
    
        var _nuevoUsuario = new Usuario();
        _nuevoUsuario.nombreCompleto = fullname;
        _nuevoUsuario.nombreUsuario=username;
        _nuevoUsuario.Password=password;
        _nuevoUsuario.oldPassword = oldpassword;
        _nuevoUsuario.email = email;
        
        for(var p in _nuevoUsuario){
            if(_nuevoUsuario[p] == null)
                _nuevoUsuario[p] = "";
        }
        //Imagen de avatar.
        //    var _imagenUsuario;
        //    //obtiene la imagen de Avatar.
        //    _imagenUsuario = CValidacionUsuario.prototype.leerArchivo("hola");
        //    //Asigna la imagen de Avatar.
        //    _nuevoUsuario[3] = _imagenUsuario;

    
        parametros.add("usuario", JSON.stringify(_nuevoUsuario));
        //bool
        //reg[0] contiene el resultado de la operación.
        //reg[1] contiene el mensaje de error.
        //resultado codificado en JSON.
        var _reg=_cm.conexion("actualizarUsuario", parametros);
            
        if(!_reg[0]){
            $("#lblMensajeError").show("slide", null, "500", null);
            $("#lblMensajeError").css({
                'color' : 'red',
                'font-weight' : 'bold'
            });
            $("#lblMensajeError").text(_reg[1]);
        }
        return _reg;
    }catch(ex){
        //mensajeError = "Hubo un problema con la conexión. Intente otra vez.";
            
        $("#lblMensajeError").show("slide", null, "500", null);
        $("#lblMensajeError").css({
            'color' : 'red',
            'font-weight' : 'bold'
        });
        $("#lblMensajeError").text("Hubo un problema con la conexión. Intente otra vez.");
    }
    return false;

};

/// <summary>
/// !Lee un archivo, y lo carga como arreglo de bytes.!
/// Retorna el archivo a guardar.
/// </summary>
/// <param name="fileName">Nombre de archivo</param>
/// <returns>Arreglo de bytes con el archivo (binario)</returns>
CValidacionUsuario.prototype.leerArchivo = function(fileName) {
    return fileName;
}
    
/**
 * Inicia la sesión en el sistema
 * @param {string} usuario nombre de usuario
 * @param {string} password contrasña
 * @return {Sesion} objeto de sesion valido o invalido.
 */
CValidacionUsuario.prototype.iniciarSesion=function(usuario, password){
    var _retorno = null;
    try{
            
        var _conexion = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("usuario", usuario);
        parametros.add("password", password);
            
        _retorno = _conexion.conexion("iniciarSesion", parametros);
    //alert(_retorno.MensajeError);
    }catch(ex){
        _retorno = new Sesion();
        _retorno.MensajeError = "No se pudo establecer conexión con el servidor. Verifique la conexión";
    }
    return _retorno;
}

CValidacionUsuario.prototype.verificarUsuario = function(usuario){
    var _retorno = false;
    try{
        var _conexion = new ConexionManager();
        var parametros = new SOAPClientParameters();
        parametros.add("usuario", usuario);
        
        _retorno = _conexion.conexion("recuperarContrasena", parametros);
    }catch(ex){
        return false;
    }
    
    return _retorno;
}