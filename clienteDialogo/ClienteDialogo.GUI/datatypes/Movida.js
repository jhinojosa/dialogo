/**
 * Representa una movida, tanto global del sistema como asociada a un dialogo particular.
 */
function Movida(){
//    /// <summary>
//        /// Códificación de los ejes a los que pertenece el diálogo
//        /// </summary>
//        public enum Eje : int
//        {
//            BuscarEntender =0,
//            DarseAEntender = 1
//        }

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
}