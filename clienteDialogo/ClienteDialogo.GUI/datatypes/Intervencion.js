
/// Representa una opinión ingresada en el sistema, vincula a la intervención a la que responde, 
/// incluyendo el texto citado
function Intervencion(){

    //:int
    /// Identificador para la intervención. 0 ==> nueva intervención
    this.idIntervencion=0;
    
    //:string
    /// Texto de la intervención. Formateado en (XAML) HTML?
    this.Texto;
    
    //:dateTime
     /// Fecha de publicación de la intervención
     this.FechaCreacion;
    
    //:string
    /// Párrafo o texto al que cita la respuesta
    this.TextoRespuesta;

    //:Intervencion
    /// Intervención a la que se responde
    this.intervencionRespuesta;

    //:Movida
    this.tipoMovida;

    
    //:MovidaCorregida.
    /// Correción de sugerencias realizadas para la corrección por parte del facilitador.
    /// Este valor debiera ser cargado sólo al usuario facilitador
    this.correccionMovida;

    //:Usuario
    /// Usuario que emite la respuesta
    this.usuarioCreador;

    //:Notas[]
    /// Carga las notas creadas por el usuario.
    /// Se supone que es 1 por usuario, pero se deja 
    /// abierta la posibilidad de tener varias
    /// notas para una intervención
    this.Notas;

    this.idDialogo;
}