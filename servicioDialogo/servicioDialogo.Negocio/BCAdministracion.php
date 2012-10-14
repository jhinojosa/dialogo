<?php

require_once 'sesion/BC_Sesion.php';

/**
 * Gestiona la obtención y modificación de parámetros globales del sistema. 
 */
class BCAdministracion {

    /**
     * obtiene la movida predeterminada para la creación del diálogo para la categoria señalada.
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    function obtenerMovidaCrearDialogo($idCategoria) {
        $_ret = 0;

        try {
            $catmdac = new CategoriaMovidaDAC();
            $_ret = $catmdac->obtenerMovidaCrearDialogo($idCategoria);
        } catch (Exception $e) {
            return 0;
        }

        return $_ret;
    }

    /**
     * inserta en la categoria señalada, la movida seleccionada como
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    public function insertarMovidaCrearDialogo($idCategoria, $idMovida) {
        $_ret = false;

        try {
            $catmdac = new CategoriaMovidaDAC();
            $_ret = $catmdac->insertarMovidaCrearDialogo($idCategoria, $idMovida);
        } catch (Exception $e) {
            return false;
        }

        return $_ret;
    }

    /**
     * Guarda un perfil de movidas, y/o las movidas asociadas a este.
     * @param Sesion $sesion Sesión de administrador asignada por el sistema
     * @param CategoriaMovida $categoria Perfil de movidas a guardar/modificar
     * @return bool Verdadero su se guardó exitosamente.
     */
    public function guardarPerfilMovidas($sesion, $categoria) {
//        echo $categoria->idCategoria;
        try {
            if (!BC_Sesion::sesionValida($sesion) || !$sesion->usuario->esAdministrador()) {
                return false;
            }

            $ret = false;

            $catmdac = new CategoriaMovidaDAC();
            $categoria->autor = $sesion->usuario;
            if ($categoria->idCategoria == 0) {
                $ret = $catmdac->insertarCategoria($categoria);
//                echo "A";
            } else {
                $ret = $catmdac->actualizarCategoria($categoria);
//                echo "B";
            }

            //en cualquiera de los casos, repasa las movidas.
//            print_r($ret);
            if ($ret && $categoria->movidas != null && count($categoria->movidas) > 0) {

                foreach ($categoria->movidas as $mov) {
                    $mov->autor = $sesion->usuario;
                    $ret = $this->guardarMovida($categoria, $mov);
                }
            }


            return $ret;
        } catch (Exception $ex) {

            return false;
        }
    }

    /**
     *
     * @param CategoriaMovida $cat
     * @param Movida $mov 
     */
    public function guardarMovida($cat, $mov) {
        try {
            $ret = false;
            $movdac = new MovidaDAC();
            if ($mov->IdMovida != 0) {
                $ret = $movdac->actualizarMovida($mov);
            } else {
                $ret = $movdac->insertarMovida($mov);
                $movdac->asociarCategorias($cat, $mov);
            }

            return $ret;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Guarda o actualiza una regla determinada. Esta función solo atiende a peticiones con sesión de administrador.
     * @param Sesion $sesion
     * @param Regla[] $reglas 
     * @return bool Verdadero si la regla fue gaurdada exitosamente.
     */
    public function guardarReglas($sesion, $reglas) {
        if (!BC_Sesion::sesionValida($sesion) || !$sesion->usuario->esAdministrador())
            return false;

        $_ret = false;
        $_dac = new ReglaDAC();
        $_reglasBD = $_dac->obtenerReglasSistema();
        if ($reglas != null) {
            foreach ($reglas as $r) {
                if ($r->idRegla != 0) {
                    $bd = null;
                    foreach ($_reglasBD as $rbd) {
                        if ($rbd->idRegla == $r->idRegla) {
                            $bd = $rbd;
                            break;
                        }
                    }
                    if ($bd != null && $bd->textoRegla != $r->textoRegla) {
                        $_ret = $_dac->actualizarReglasSistema($r, $sesion->usuario);
                    }
                } else {
                    $_ret = $_dac->insertarReglaSistema($r, $sesion->usuario);
                }
            }
        }
        return $_ret;
    }

}

?>
