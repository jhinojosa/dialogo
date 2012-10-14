/// Define un objeto de transporte que representa al encabezado de un diálogo
function Dialogo() {
    //int
    this.idDialogo="";
    //Usuario
    this.usuarioCreador="";
    //Usuario
    this.usuarioFacilitador="";
    //Título del dialogo.
    //string
    this.Titulo="";
    //Fecha en que se publico el dialogo.
    //DateTime
    this.FechaCreacion="";
    //Indica la fecha de la ultima intervencion.
    //dateTime
    this.FechaUltimaIntervencion="";
    //Coleccion de reglas para mostrar a los participantes.
    //Regla[]
    this.Reglas = new Array();
    //Acta del usuario que visualiza el diálogo
    //Acta
    this.ActaUsuario = new Acta();
    // Balance ideal para el diálogo, utilizado para evaluar la emisión de alertas
    //:Balance
    this.balanceDialogo = new Array();
    /// Colección de intervenciones realizadas dentro del diálogo
    //:Intervencion[]
    this.intervenciones = new Array();
    /// Categoría de movida asignada al momento de crear un diálogo
    //:CategoriaMovida
    this.categoria="";
    /// Contiene las restricciones de usuario para el diálogo
    //:Usuario[]
    this.usuariosPermitidos = new Array();
    /// Indica si el sistema debe advertir al usuario que el diálogo se encuentra desbalaceado de sus parámetros ideales
    //:Bool
    this.estaDialogoDesbalanceado="";

}

/**
 * Agrega una regla a la lista.
 * @param {Regla} regla
 */

