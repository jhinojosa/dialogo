/**
 * Representa una nota asociada a una intervencion
 */
function Nota(){
    //int
    this.IdNota=0;
    //string
    this.Texto;
    //Usuario
    this.Autor=new Usuario();
    //Intervencion
    this.intervencionPadre = new Intervencion();
}