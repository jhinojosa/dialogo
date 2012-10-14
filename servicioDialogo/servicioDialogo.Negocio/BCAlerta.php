<?php

/**
 * Gestiona las consultas acerca de desbalances en el sistema
 */
class BCAlerta{
    
    /**
     *Indica si el diálogo posee un desbalance acorde a la configuración asociada.
     * @param Dialogo $dialogo Objeto Dialogo, importa que posea el ID único.
     * @return bool Verdadero si las condiciones de balance no se cumplen.
     */
    public function estaElDialogoDesbalanceado($dialogo){
        $_retorno = false;
        $_dacBalance = new BalanceDAC();
        
        $_cuentaMovida = $_dacBalance->obtenerResumenMovidas($dialogo->idDialogo);
        
        $_balanceActual = $_dacBalance->obtenerBalanceDialogo($dialogo->idDialogo);
        
        //decimal
        $totalMovidas = 0;
        
        $_tabla = array();
        
        foreach($_cuentaMovida as $movi){
            $totalMovidas += $movi->Cuenta;
            $_tabla[$movi->movida->IdMovida] = $movi;
        }
        //print_r($_tabla);
        foreach($_balanceActual as $b){
            
            if(isset($_tabla[$b->movida->IdMovida]))
                $cuenta = $_tabla[$b->movida->IdMovida];
            else
                $cuenta = null;
            //decimal
            $_movidasTipo = 0;
            if($cuenta != null){
                //cantidad de movidas del tipo que se está revisando.
                $_movidasTipo = $cuenta->Cuenta;
            }
            
            //decimal
//            echo "movT: ".$_movidasTipo;
//            echo "totM: ".$totalMovidas."\n";
            $porcentaje = $_movidasTipo / $totalMovidas * 100;
            
            //decimal
            $minimo = $b->valor - $b->valorTolerancia;
//            echo("min: ".$b->valor . "-" . $b->valorTolerancia);
            //decimal
            $maximo = $b->valor + $b->valorTolerancia;
//            echo("max: ".$maximo);
//            echo("por: ".$porcentaje);
            if($porcentaje < $minimo || $porcentaje > $maximo){
//                echo "por: ".$porcentaje . " min: ".$minimo." max: ".$maximo;
                return true;
            }
        }
        
        
        return $_retorno;
        
    }
    
    
    /**
     *Verifica si existe un desbalance en el diálogo indicado
     * @param Sesion $sesion Sesión del sistema
     * @param Dialogo $dialogo Objeto diálogo, importa que posea el ID único.
     */
    public function verificarBalance($sesion, $dialogo){
        $_existeDesbalance = $this->estaElDialogoDesbalanceado($dialogo);
        
        $_dacDialogo = new DialogoDAC();
        
        if($_existeDesbalance){
            $_dacDialogo->actualizarDesbalanceDialogo($dialogo->idDialogo, true);
        }else{
            $_dacDialogo->actualizarDesbalanceDialogo($dialogo->idDialogo, false);
        }
    }
}
?>
