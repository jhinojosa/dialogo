<?php

require_once './servicioDialogo.DAC/EstadisticasDAC.php';

/**
 * Provee la funcionalidad de obtención de estadísticas para un diálogo
 */
class BCEstadisticas {

    function __construct() {
        
    }

    /**
     * Obtiene estadísticas para el diálogo indicado.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Dialogo $dialogo Objeto de diálogo, importa su identificador.
     * @return Object Colección de tablas con las estadísticas a mostrar.
     */
    public function obtenerEstadisticas($sesion, $dialogo) {
        $_ret = array();

        if (BC_Sesion::sesionValida($sesion)) {
            $_dacm = new MovidaDAC();
            //Movida[]
            $_movsDialogo = $_dacm->seleccionarMovidasDialogo($dialogo->idDialogo);

            //datatable
            $_participacion = $this->obtenerPorcentajesParticipacion($dialogo, $_movsDialogo);
            array_push($_ret, $_participacion);

//            echo "--";
//            print_r($_participacion);
//            echo "--";
            
            $_tablaCantidad = $this->obtenerEstadisticasParticipantes($dialogo, $_movsDialogo);
            array_push($_ret, $_tablaCantidad);

//            echo "--";
//            print_r($_tablaCantidad);
//            echo "--";
            
            $_tabCant = $_tablaCantidad;
            $_tablaEje = $this->obtenerEstadisticasEje($_tabCant, $_movsDialogo);
            array_push($_ret, $_tablaEje);

            /** POSTPROCESADO TABLA 2 * */
            $_tablaTotalizadora = array();
            for ($i = 0; $i < count($_tablaCantidad->columnas) - 1; $i++) {
                $_tablaTotalizadora[$i] = 0;
            }

            $_total = 0;
            foreach ($_tablaCantidad->datos as $dr) {
                //echo json_encode($dr);
                for ($i = 1; $i < count($_tablaCantidad->columnas); $i++) {
                    $valor = $dr[$i];
                    $_tablaTotalizadora[$i - 1] += $dr[$i];
                    $_total += $dr[$i];
                }
            }

            $_nueva1 = array();
            $_nueva2 = array();

            $_nueva1[0] = "<b>Total</b>";
            $_nueva2[0] = "<b>Porcentaje Total</b>";

            for ($i = 1; $i < count($_tablaTotalizadora) + 1; $i++) {
                $_nueva1[$i] = "<b>" . $_tablaTotalizadora[$i - 1] . "</b>";
                $_nueva2[$i] = "<b>" . round($_tablaTotalizadora[$i - 1] / $_total * 100, 2) . "%</b>";
            }

            array_push($_tablaCantidad->datos, $_nueva1);
            array_push($_tablaCantidad->datos, $_nueva2);
        }

        //echo json_encode($_tablaCantidad->datos);

        for ($i = 0; $i < count($_ret); $i++) {
            array_push($_ret[$i]->columnas, null);
            array_push($_ret[$i]->datos, null);
        }


        //echo json_encode($_ret);
        return $_ret;
    }

    /**
     *
     * @param Tabla $_tablaCantidad
     * @param Movida[] $_movsDialogo 
     */
    private function obtenerEstadisticasEje($_tablaCantidad, $_movsDialogo) {
//        $_tablaCantidad = array_splice($_tablaCantidad, count($_tablaCantidad) - 1);
//        $_tablaCantidad->columnas = array_splice($_tablaCantidad->columnas, count($_tablaCantidad->columnas) - 1);
//        $_tablaCantidad->datos = array_splice($_tablaCantidad->datos, count($_tablaCantidad->datos) - 1);
//        unset($_tablaCantidad->columnas[count($_tablaCantidad->columnas) - 1]);
//        unset($_tablaCantidad->datos[count($_tablaCantidad->datos) - 1]);
        //echo json_encode($_tablaCantidad->);

        $_ret = new Tabla();
        $_ret->columnas[0]->sTitle = "Participante";

        $_mov = new Movida();
        $_ejeBuscarEntender = $_mov->Eje->BuscarEntender;
        $_nuevaC = $_ret->columnas[1]->sTitle = "Buscar entender";

        $_ejeDarseEntender = $_mov->Eje->DarseAEntender;
        $_nuevaC = $_ret->columnas[2]->sTitle = "Darse a entender";

        $_total0 = 0;
        $_total1 = 0;
        $_totaln = 0;
        //echo json_encode($_movsDialogo);
        foreach ($_tablaCantidad->datos as $_dr) {
            //Una nueva fila con las mismas características que una fila de $_ret.
            $_n = array();
            $_n[0] = $_dr[0]; //participante
            //echo json_encode($_dr);

            $_valorB = 0;
            $_valorD = 0;
            for ($i = 1; $i < count($_tablaCantidad->columnas); $i++) {

                for ($j = 0; $j < count($_movsDialogo); $j++) {
                    //echo $j;
                    //echo "(" . $_tablaCantidad->columnas[$i]-> .",". $_movsDialogo[$j]->Nombre . ")";
                    if ($_tablaCantidad->columnas[$i]->sTitle == $_movsDialogo[$j]->Nombre) {
                        //echo $_tablaCantidad->columnas[$i]->sTitle;
                        if ($_movsDialogo[$j]->eje == $_ejeBuscarEntender) {
                            $_valorB += $_dr[$i];
                            $_total0 += $_dr[$i];
                        }
                        if ($_movsDialogo[$j]->eje == $_ejeDarseEntender) {
                            $_valorD += $_dr[$i];
                            $_total1 += $_dr[$i];
                        }
                    }
                }
            }
            $_n[1] = $_valorB;
            $_n[2] = $_valorD;

            array_push($_ret->datos, $_n);
        }

        $_totaln = $_total0 + $_total1;
        //echo $_totaln;

        $_total = array();
        $_total[0] = "<b>Total</b>";
        $_total[1] = "<b>" . round(($_total0 / $_totaln * 100), 2) . "%</b>";
        $_total[2] = "<b>" . round(($_total1 / $_totaln * 100), 2) . "%</b>";
        array_push($_ret->datos, $_total);
//        $_ret->columnas[count($_ret->columnas)] = null;
//        $_ret->datos[count($_ret->datos)] = null;
//        print_r($_ret);
        return $_ret;
    }

    /**
     * Genera una tabla de resumen de movidas realizadas por participante.
     * @param Dialogo $dialogo
     * @param Movida[] $_movsDialogo 
     */
    private function obtenerEstadisticasParticipantes($dialogo, $_movsDialogo) {
        /** CREACION DE TABLA * */
        $_ret = new Tabla();
        $_ret->columnas = array();
        $_ret->columnas[0]->sTitle = "Usuario Participante";
        //$_nueva = $_ret->header;

        foreach ($_movsDialogo as $mov) {
            try {
                $_ret->columnas[count($_ret->columnas)]->sTitle = $mov->Nombre;
                //array_push($_ret->columnas, $mov->Nombre );
            } catch (Exception $e) {
                
            }
        }

//        print_r($_ret);
        /** FIN * */
        $_dac = new EstadisticasDAC();

        //Datatable
        $_participacion = $_dac->seleccionarMovidasParticipante($dialogo->idDialogo);

//        print_r($_participacion);
        
        foreach ($_participacion as $dr) {
            $_filaUsuario = array();
            for ($i = 0; $i < count($_ret->columnas); $i++) {
                $_filaUsuario[$i] = "0";
            }

            $_filaUsuario[0] = $dr["x_id_usuario"];

            for ($i = 1; $i < count($_ret->columnas); $i++) {
                if ($_ret->columnas[$i]->sTitle == $dr["x_nombre_movida"]) {
                    if (!$this->existeUsuario($_ret->datos, $dr["x_id_usuario"])) {
                        $_filaUsuario[$i] = $dr["cuenta"];
                        array_push($_ret->datos, $_filaUsuario);
                    } else {

                        for ($j = 0; $j < count($_ret->datos); $j++) {
                            if ($_ret->datos[$j][0] == $dr["x_id_usuario"]) {
                                $_ret->datos[$j][$i] += $dr["cuenta"];
                            }
                        }
                    }
                }
            }
        }

//        print_r($_ret);
//        echo ">>";
        return $_ret;
    }

    private function existeUsuario($tabla, $usuario) {

        foreach ($tabla as $row) {
            if ($row[0] == $usuario) {
                return true;
            }
        }
        return false;
    }

    /**
     * Genera una tabla de resumen de porcentajes de participación de movidas.
     * @param Dialogo $dialogo
     * @param Movida[] $_movsDialogo 
     */
    private function obtenerPorcentajesParticipacion($dialogo, $_movsDialogo) {

        /** CREACION DE TABLA * */
        //DataTable
        $_ret = new Tabla();
        $_ret->columnas[0]->sTitle = "movida";
        $_ret->columnas[1]->sTitle = "descripcion";
        $_ret->columnas[2]->sTitle = "Porcentaje";
        $_ret->columnas[3]->sTitle = "cantidad";
        /** FIN * */
        //echo json_encode($_ret);

        $_dacb = new BalanceDAC();

        //CuentaMovida[]
        $_movidasRealizadas = $_dacb->obtenerResumenMovidas($dialogo->idDialogo);
        //echo json_encode($_movidasRealizadas);
        //decimal
        $totalMovidas = 0;
        foreach ($_movidasRealizadas as $c) {
            $totalMovidas += $c->Cuenta;
        }

        //echo $totalMovidas;

        foreach ($_movsDialogo as $m) {
            //DataRow
            $_fila = array();
            $_fila[0] = $m->Nombre; //movida
            $_fila[1] = $m->descripcion; //descripcion
            //echo json_encode($_movidasRealizadas);
            foreach ($_movidasRealizadas as $c) {
                if ($c->movida->IdMovida == $m->IdMovida) {
                    $_fila[2] = round(($c->Cuenta / $totalMovidas * 100), 2) . "%";
                    $_fila[3] = $c->Cuenta; //cantidad
                }
            }
            if (count($_fila) == 2) {
                $_fila[2] = 0 . "%";
                $_fila[3] = "0";
            }
            //echo json_encode($_fila) . "--";
            array_push($_ret->datos, $_fila);
        }

//        $_ret->columnas[count($_ret->columnas)] = null;
//        $_ret->datos[count($_ret->datos)] = null;
        return $_ret;
    }

}

class Tabla {

    public function __construct() {
        
    }

    public $columnas = array();
    public $datos = array();

}

?>
