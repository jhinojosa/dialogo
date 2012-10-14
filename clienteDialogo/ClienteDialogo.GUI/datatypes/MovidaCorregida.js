/**
 * Representa una sugerencia de corrección para una movida d eun diálogo
 */
function MovidaCorregida(){
    //Identificador unico de la movida.
this.IdMovida;
//NOmbre a mostrar para la movida.
this.Nombre;
//Nombre o direccion del icono asociado a la movida.
this.Icono;
//Texto que describe la movida.
this.descripcion;
//Eje al que pertenece (09: Buscar entender. 1:darse a entender)
this.eje;
//Fecha de creacion de la movida por parte del administrador.
this.fechaCreacion;
//Autor de la movida (para el maestro).
this.autor=new Usuario();

/*MovidaCorregida*/

//Identificador de la corrección sugerida.
//int
this.idCorreccion;
//Indica la intervención a la que pertenece la corrección
this.idIntervencionAsociada;
//Indica el usuario que realizó la corrección
//string
this.usuarioCorrector;
}