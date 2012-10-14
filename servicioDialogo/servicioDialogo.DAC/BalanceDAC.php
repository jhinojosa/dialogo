<?php

require_once './servicioDialogo.Datos/Balance.php';
require_once 'datatypes/CuentaMovida.php';

/**
 * Inseta y selecciona datos vinculados con la tabla Balance 
 */
class BalanceDAC {

    /**
     * Actualiza el balance de un diálogo determinado, en la base de datos.
     * @param int $idDialogo ID del Dialogo asociado al balance.
     * @param Balance[] $balance Colección de objetos Balance con sus datos completos.
     * @return bool Verdadero si todos los balances fueron insertados correctamente.
     */
    public function actualizarBalances($idDialogo, $balance){
        $_retorno = false;
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                //print_r($balance);
                foreach ($balance as $b) {
                    try {
                        $_q = new Query($conexion, "balance");
                        $_q->addValorString("n_porcentaje_balance", $b->valor);
                        $_q->addValorString("n_porcentaje_tolerancia", $b->valorTolerancia);
                        $_q->addCondicion("n_id_dialogo='" . $idDialogo . "' ");
                        $_q->addCondicionAND("n_id_movida_dialogo='" . $b->movida->IdMovida . "'");
//                        echo $_q->QueryUpdate();
                        $_retorno = $conexion->modificar($_q->QueryUpdate());
                    } catch (Exception $e) {
                        
                    }
                }
            }$conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }
        return $_retorno;
    }
    
    
    /**
     * Inserta una colección de balances en la base de datos.
     * @param Dialogo $dialogo Dialogo asociado al balance, solo importa su id único.
     * @param Balance[] $balance Colección de objetos Balance con sus datos completos.
     * @return bool Verdadero si todos los balances fueron insertados correctamente.
     */
    public function insertarBalances($dialogo, $balance) {
        $_retorno = false;
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                //print_r($balance);
                foreach ($balance as $b) {
                    try {
                        $_q = new Query($conexion, "balance");
                        $_q->addValorString("n_id_dialogo", $dialogo->idDialogo);
                        $_q->addValorString("n_id_movida_dialogo", $b->movida->IdMovida);
                        $_q->addValorString("n_porcentaje_balance", $b->valor);
                        $_q->addValorString("n_porcentaje_tolerancia", $b->valorTolerancia);
                        //echo $_q->QueryInsert();
                        $_retorno = $conexion->modificar($_q->QueryInsert());
                    } catch (Exception $e) {
                        
                    }
                }
            }$conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }
        return $_retorno;
    }

    /**
     * Obtiene la suma de movidas realizadas para el diálogo indicado.
     * Clasificados por el tipo de movida.
     * @param int $idDialogo Identificador unico del dialogo a analizar.
     * @return CuentaMovida[] Un arreglo con las movidas ingresadas, junto a la cantidad de ocurrencias en el diálogo indicado.
     */
    public function obtenerResumenMovidas($idDialogo) {
        $_retorno = array();
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = "select n_id_movida,count(*) cuenta from";
                $_q .= " intervencion where n_id_dialogo=" . $idDialogo;
                $_q .= "group by n_id_movida;";
                
                $_tablaCuenta = $conexion->consultar($_q);
                $conexion->cerrarConexion();

                $_retorno = array();
                $i = 0;
                foreach ($_tablaCuenta as $dr) {
                    $n_id_movida = $dr["n_id_movida"];
                    $cantidad = $dr["cuenta"];
                    $_movidaNueva = new Movida();
                    $_movidaNueva->IdMovida = $n_id_movida;

                    $_nuevaCuenta = new CuentaMovida($_movidaNueva, $cantidad);

                    $_retorno[$i++] = $_nuevaCuenta;
                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Obtiene la configuración de balance para el dialogo indicado.
     * @param int $idDialogo Identificador único del diálogo que tiene el balance.
     */
    public function obtenerBalanceDialogo($idDialogo) {
        $_retorno = array();
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            if ($_exito) {
                $_q = new Query($conexion, "balance");
                $_q->addCampo("n_id_balance");
                $_q->addCampo("n_id_movida_dialogo");
                $_q->addCampo("n_porcentaje_balance");
                $_q->addCampo("n_porcentaje_tolerancia");
                $_q->addCondicionAND("n_id_dialogo = " . $idDialogo);
                
                $_tabla = $conexion->consultar($_q->QuerySelect());
                $conexion->cerrarConexion();
                $_retorno = array();
                $i = 0;
                foreach ($_tabla as $dr) {
                    $_nuevoBalance = new Balance();
                    $_nuevoBalance->idBalance = $dr["n_id_balance"];
                    $_movAsociada = new Movida();
                    $_movAsociada->IdMovida = $dr["n_id_movida_dialogo"];
                    $_nuevoBalance->movida = $_movAsociada;

                    $_nuevoBalance->valor = $dr["n_porcentaje_balance"];
                    $_nuevoBalance->valorTolerancia = $dr["n_porcentaje_tolerancia"];
                    $_retorno[$i++] = $_nuevoBalance;
                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

}

?>
