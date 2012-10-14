/**
 * Representa un balance para un tipo de movida específico.
 */
function Balance(){
    //Identificars unico de un valor de balance para una movida y dialogo.
    this.idBalance;
    //Valor procentual considerado como ideal para una movida.
    this.valor;
    //desviacion del valor esperado de balance
    this.valorTolerancia;
    //Movida asociada al balance.
    this.movida=new Movida();
     
}

