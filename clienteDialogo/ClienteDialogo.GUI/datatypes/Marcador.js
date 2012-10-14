/**
 * Representa un marcador asociada a una intervencion.
 */
function Marcador(){
    //Identificador único del marcador.
    this.idMarcador;
    //Intervencion que se agreg´a marcadores.
    this.dondeApunto=new Intervencion();
    //Usuario que agrega la intervencion a marcadores.
    this.usuarioPadre=new Usuario();
    
}