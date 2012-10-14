<?php

require_once './servicioDialogo.DAC/ReglaDAC.php';

class BCRegla {

    /**
     * Guarda las reglas para el diálogo indicado.
     * @param Dialogo $dialogo Objeto de diálogo con su identificador como mínimo.
     * @param Reglas[] $reglas Reglas a guardar.
     * @return bool Verdadero si se tuvo éxtio al guardar todas las reglas.
     */
    public function guardarReglas($dialogo, $reglas) {
        $_retorno = false;
        
        if (count($reglas > 0) && $reglas != null) {
            $_dac = new ReglaDAC();
            foreach ($reglas as $r) {
                $_retorno = $_dac->insertarReglaDialogo($dialogo, $r);
            }
        }else{
            return true;
        }
        
        return $_retorno;
    }

    /**
     * Lista las reglas disponibles para la creación de diálogos.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @return Regla[] Arreglo con las listas disponibles.
     */
    public function listarReglasDisponibles($sesion) {
        $_reglas = array();

        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new ReglaDAC();
            $_reglas = $_dac->obtenerReglasSistema();
        }
        return $_reglas;
    }

    /**
     * Gestiona la selección de las reglas asociadas al diálogo indicado
     * @param Dialogo $dialogo 
     * @return void
     */
    public function agregarReglasDialogo($dialogo) {
        try {
            $_dac = new ReglaDAC();
            //Regla[]
            $_reglasDialogo = $_dac->obtenerReglas($dialogo->idDialogo);
            $dialogo->Reglas = $_reglasDialogo;
        } catch (Exception $e) {
            $r = new Regla();
            array_push($dialogo->Reglas, $r);
        }
    }

}

?>
