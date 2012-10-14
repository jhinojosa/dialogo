<?php

require_once 'sesion/BC_Sesion.php';
require_once './servicioDialogo.DAC/MovidaDAC.php';
require_once './servicioDialogo.DAC/CategoriaMovidaDAC.php';

/**
 * Gestiona el acceso a los datos para las movidas. 
 */
class BCMovida {

    /**
     * Busca las categorías disponibles en el sistema.
     * @param Sesion $sesion Sesión del sistema.
     * @return CategoriaMovida[] Colección de categorías de movidas disponibles en el sistema, con su detalle.
     */
    public function listarCategoriasMovida($sesion) {
        $_retorno = array();
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new CategoriaMovidaDAC();
            $_dacm = new MovidaDAC();

            $_retorno = $_dac->seleccionarCategorias();

            foreach ($_retorno as $cat) {
                try {
                    
                    $_movidasAsociadas = $_dacm->seleccionarMovidas($cat);
                    $cat->movidas = $_movidasAsociadas;
                } catch (Exception $e) {
                    
                }
            }
        }
        
        return $_retorno;
    }

    /**
     * Obtiene una lista de las movidas posibles a realizar en un diálogo.
     * @param Sesion $sesion
     * @param int $idDialogo 
     * @return Movida[] 
     */
    public function listarMovidasPosibles($sesion, $idDialogo) {
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new MovidaDAC();
            $_ret = array();
            $_ret = $_dac->seleccionarMovidasDialogo($idDialogo);

            return $_ret;
        }
        //return null;
        return array();
    }

}

?>
