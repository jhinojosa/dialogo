/**
 * Representa un perfil de movidas
 */
function CategoriaMovida(){
    //Identificador unico de la categoria.
    this.idCategoria="";
    //Nombre asignado a la categoria.
    this.nombre="";
    //Descripcion para la categoria.
    this.descripcion="";
    //Coleccion de movidas asociadas a la categoria.
    //Movidas[]
    this.movidas="";
    
    
    /*Atributos para el registro de modificaciones*/
    
    //fecha de creacion de la movida.
    this.fechaCreacion="";
    //Autor asociado a la movida
    this.autor = new Usuario();
}

