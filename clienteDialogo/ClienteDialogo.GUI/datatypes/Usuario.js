/// Representa a un Usuario del sistema.
function Usuario() {
    /// Constante para el rol de facilitador
    this.ROL_FACILITADOR = 1;

    /// Constante para el rol de participante
    this.ROL_PARTICIPANTE = 0;

    /// Constante para el rol de administrador
    this.ROL_ADMINISTRADOR = 2;

    /// Identificador único para el usuario dentro del sistema
    //string
    this.nombreUsuario;

    //Nombre completo del usuario.
    this.nombreCompleto;
    /// Dirección de correo electrónico del usuario
    //string
    this.email;

    /// Constraseña en texto plano utilizada por el usuario
    //string
    this.Password;

    /// Rol asociado al usuario
    //string
    this.Rol = 0;

    /// Imagen utilizada como avatar del usuario
    //byte array (!)
    this.imagen;
}

/// Determina si un Usuario cumple el rol de facilitador
/// Los administradores son facilitadores
Usuario.prototype.esFacilitador = function() {
    return (this.Rol == this.ROL_FACILITADOR || Rol == ROL_ADMINISTRADOR );
};
/// Determina si un Usuario cumple el rol de facilitador
Usuario.prototype.esAdministrador = function() {
    return (this.Rol == this.ROL_ADMINISTRADOR);
};
/// Verifica si la contraseña indicada es válida
/// <param name="plainPassword">Password en texto plano</param>
/// <returns>Verdadero, si la contraseña coincide con los criterios de hash, falso en caso contrario</returns>
Usuario.prototype.PassWordValido = function(plainPassword) {
    return (utils.MD5Sum.GetMd5Sum(plainPassword) == this.Password);
};

