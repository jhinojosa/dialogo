<?php

//include_once './servicioDialogo.Datos/sesion/Sesion.php';
require_once './servicioDialogo.DAC/DialogoDAC.php';
require_once './servicioDialogo.DAC/IntervencionDAC.php';
require_once './servicioDialogo.DAC/MovidaDAC.php';
require_once './servicioDialogo.DAC/BalanceDAC.php';
require_once './servicioDialogo.DAC/RestriccionDAC.php';
require_once './servicioDialogo.Datos/CategoriaMovida.php';
require_once 'BCNota.php';
require_once 'BCRegla.php';
require_once 'BCActa.php';
require_once 'BCAlerta.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BCDialogo {

    public $cantidadEncabezadosPorPagina = 10;

    /**
     * Constructor, define la cantidad de listas de diálogo a utilizar por página. 
     */
    function __construct() {
        $this->cantidadEncabezadosPorPagina = 10;
    }

    /**
     * Guarda las configuraciones realizadas a la configuración del diálogo.
     * Configuraciones permitidas:
     * - Reglas
     * - Balances
     * - Restricciones
     * - Facilitador
     * @param Sesion $sesion sesión asignada por el sistema
     * @param Dialogo $dialogo Diálogo con las configuraciones modificadas.
     */
    public function actualizarConfiguracionDialogo($sesion, $dialogo) {
        $_retorno = false;

        if (!BC_Sesion::sesionValida($sesion))
            return $_retorno;

        try {
            $_dacr = new ReglaDAC();
            $_reglasSistema = $_dacr->obtenerReglas($dialogo->idDialogo);
            $_reglasPorBorrar = array();
            $_reglasPorAgregar = array();
            $_hreglasSistema = array();

            foreach ($_reglasSistema as $r) {
                $_hreglasSistema[$r->idRegla] = $r;
            }

            foreach ($dialogo->Reglas as $r) {
                if ($r->idRegla == 0) {
                    //agregar
                    array_push($_reglasPorAgregar, $r);
                } elseif (!isset($_hreglasSistema[$r->idRegla])) {
                    array_push($_reglasPorBorrar, $r);
                } else {
                    $_rsis = $_hreglasSistema[$r->idRegla];
                    if ($r->textoRegla != $_rsis->textoRegla) {
                        $_retorno = $_dacr->actualizarReglaDialogo($r);
                    }
                }
            }

            foreach ($_reglasPorBorrar as $r) {
                $_retorno = $_dacr->eliminarReglaDialogo($r);
            }

            foreach ($_reglasPorAgregar as $r) {
                $_retorno = $_dacr->insertarReglaDialogo($dialogo, $r);
            }

            $_ret->reglas = $_retorno;
        } catch (Exception $e) {
            
        }

        /**
         * Actualización de balances. 
         */
        try {
            $_retorno = false;

            $_balancedac = new BalanceDAC();

            $_retorno = $_balancedac->actualizarBalances($dialogo->idDialogo, $dialogo->balanceDialogo);
            
            $_ret->balance = $_retorno;
            
            $_alerta = new BCAlerta();
            $_alerta->verificarBalance($sesion, $dialogo);
            
        } catch (Exception $e) {
            
        }

        return $_ret;
    }

    /**
     * Inserta un nuevo diálogo en el sistema.
     * @param Sesion $sesion Sesión del sistema.
     * @param Dialogo $dialogo Objeto con la configuración del diálogo.
     * @param string $mensajeError 
     * @return bool Verdadero si se creó un diálogo con todas sus dependencias.
     */
    public function publicarDialogo($sesion, $dialogo, &$mensajeError) {

        $_retorno = false;
        if (BC_Sesion::sesionValida($sesion)) {
            $_dialogoDAC = new DialogoDAC();
            $_intervencionDAC = new IntervencionDAC();
            $_movidaDAC = new MovidaDAC();
            $_balanceDAC = new BalanceDAC();
            $_restriccionDAC = new RestriccionDAC();

            $dialogo->usuarioCreador = $sesion->usuario;
            $dialogo->usuariofacilitador = $sesion->usuario;

            $_idDialogo = 0;
            $_retorno = $_dialogoDAC->insertarDialogo($dialogo, $_idDialogo);
            $dialogo->idDialogo = $_idDialogo;

            if ($_retorno) {
                //Inserción de movidas.
                $_retorno = $_movidaDAC->copiarMovidas($dialogo, $dialogo->categoria);
            } else {
                $mensajeError = "No se pudo insertar el diálogo";
                return false;
            }

            //Obtención de movidas con id de base de datos.
            $_movidasActualizadas = $_movidaDAC->seleccionarMovidasDialogo($_idDialogo);
            //echo json_encode($_movidasActualizadas);


            if (count($_movidasActualizadas) == 0) {
                $mensajeError = "No se pudo copar las movidas";
                return false;
            }

            //asignación de movida con id correcto.
            foreach ($dialogo->balanceDialogo as $bal) {
                $_movVerdadera = $this->buscarTipoMovidaObj($_movidasActualizadas, $bal->movida);
                $bal->movida = $_movVerdadera;
            }
            //echo json_encode($dialogo->balanceDialogo);



            $dialogo->intervenciones[0]->tipoMovida = $this->buscarTipoMovidaObj($_movidasActualizadas, $dialogo->intervenciones[0]->tipoMovida);
            $dialogo->intervenciones[0]->usuarioCreador = $dialogo->usuarioCreador;
            //echo json_encode($dialogo->intervenciones[0]->tipoMovida);


            if ($_retorno) {
                //Inserción de datos anexos.
                //echo $dialogo->intervenciones[0]->tipoMovida->IdMovida;
                $retorno = $_intervencionDAC->insertarIntervencion($dialogo, $dialogo->intervenciones[0]);
            } else {
                $mensajeError = "No se pudo copíar las movidas";
                return false;
            }

            if ($_retorno) {
                //Inserción de balance.
                $_retorno = $_balanceDAC->insertarBalances($dialogo, $dialogo->balanceDialogo);
            } else {
                $mensajeError = "no se pudo insertar el texto de la intervención";
                return false;
            }

            if ($_retorno) {
                $_negocioRegla = new BCRegla();
                $_retorno = $_negocioRegla->guardarReglas($dialogo, $dialogo->Reglas);
            } else {
                $mensajeError = "No se pudo insertar el balance";
                return false;
            }

            if ($_retorno) {
                $_retorno = $_restriccionDAC->insertarRestricciones($dialogo);
            } else {
                $mensajeError = "No se pudo insertar la lista de reglas";
                return false;
            }

            if (!$_retorno) {
                $mensajeError = "No se pudo insertar las restricciones";
            }
        }
        return $_retorno;
    }

    public function eliminarDialogo($idDialogo) {
        $_dialogoDAC = new DialogoDAC();
        $_ret = $_dialogoDAC->eliminarDialogo($idDialogo);

        return $_ret;
    }

    public function obtenerEncabezadoDialogo($idDialogo) {
        $_retorno = new Dialogo();
        $_retorno->idDialogo = $idDialogo;

        $_dac = new DialogoDAC();

        $_retorno = $_dac->listaEncabezado($idDialogo);

        return $_retorno;
    }

    /**
     * Obtiene un objeto dialogo junto a sus datos relevantes para la consulta.
     * @param Sesion $sesion Sesion del sistema
     * @param int $idDialogo Identificador único de dialogo a obtener,
     * @return Dialogo Objeto detallado con el dialogo indicado.
     */
    public function obtenerDialogoDetallado($sesion, $idDialogo) {
        /*         * CREACION DEL OBJETO DIALOGO* */
        $_retorno = new Dialogo();

        if (!BC_Sesion::sesionValida($sesion))
            return $_retorno;

        $_dac = new DialogoDAC();
        $_retorno = $_dac->obtenerDialogo($idDialogo);
        /*         * FIN* */

        if ($_retorno->idDialogo == $idDialogo) { // si el dialogo se cargó correctamente.
            /*             * asignación del usuario facilitador* */
            try {
                if ($_retorno->usuarioFacilitador->nombreUsuario == $sesion->usuario->nombreUsuario) {
                    $_retorno->usuarioFacilitador = $sesion->usuario;
                    if (!$sesion->usuario->esAdministrador()) {
                        $_retorno->usuarioFacilitador->Rol = $_retorno->usuarioFacilitador->ROL_FACILITADOR;
                    }
                }
            } catch (Exception $e) {
                
            }
            /** fin* */
            $_dacIntervencion = new IntervencionDAC();

            $_retorno->intervenciones = $_dacIntervencion->seleccionarIntervenciones($idDialogo);

            //MovidaDAC 
            $_movDac = new MovidaDAC();
            //Movida[]
            $_intervencionesDialogo = $_movDac->seleccionarMovidasDialogo($_retorno->idDialogo);
            //echo json_encode($_intervencionesDialogo);
            //MovidaCorregida[]
            $_correcciones = $_movDac->seleccionarSugerenciasDialogo($_retorno->idDialogo);

            try {
                $_retorno->categoria = new CategoriaMovida();

                //Movida[]
                $_retorno->categoria->movidas = array();
                $_retorno->categoria->movidas = $_intervencionesDialogo;
                //$_retorno->categoria->movidas = $_intervencionesDialogo;
                //Importan las movidas más que la categoría seleccionada.
            } catch (Exception $e) {
                
            }

            foreach ($_retorno->intervenciones as $intervencion) {
                try {
                    //Movida
                    $_mov = $this->buscarTipoMovida($_intervencionesDialogo, $intervencion->tipoMovida->IdMovida);
                    $intervencion->tipoMovida = $_mov;
                } catch (Exception $e) {
                    
                }

                if ($_correcciones != null) {
                    //MovidaCorregida[]
                    $_mov = $this->buscarCorrecciones($sesion->usuario, $_correcciones, $intervencion->idIntervencion);
                    $intervencion->correccionMovida = $_mov;
                }
            }

            /*             * CARGA DE LAS NOTAS* */
            try {
                $_controladorNota = new BCNota();
                $_controladorNota->agregarNotasDialogo($sesion, $_retorno);
            } catch (Exception $e) {
                
            }
            /** FIN * */
            /** CARGA DE LAS REGLAS * */
            $_bcRegla = new BCRegla();
            $_bcRegla->agregarReglasDialogo($_retorno);
            /** FIN * */
            /** CARGA DEL ACTA DEL USUARIO * */
            try {
                $_controladorActa = new BCActa();
                $_retorno->ActaUsuario = $_controladorActa->obtenerActaDialogo($sesion, $_retorno);
            } catch (Exception $e) {
                
            }
            /** FIN * */
            /** ASIGNACIÓN DE BALANCE, SOLO AL FACILITADOR * */
            if ($sesion->usuario->esAdministrador() || $_retorno->usuarioFacilitador->esFacilitador()) {
                $_dacBalance = new BalanceDAC();
                $_retorno->balanceDialogo = $_dacBalance->obtenerBalanceDialogo($idDialogo);
            }
            /** FIN * */
            /** ASIGNACIÓN DE USUARIOS PERMITIDOS, SOLO AL FACILITADOR * */
            if ($sesion->usuario->esAdministrador() || $_retorno->usuarioFacilitador->esFacilitador()) {
                $_rdac = new RestriccionDAC();
                $_retorno->usuariosPermitidos = $_rdac->seleccionarRestricciones($_retorno->idDialogo);
            }
            /** FIN * */
        }

        return $_retorno;
    }

    /**
     *
     * @param Usuario $usuario
     * @param MovidaCorregida[] $_correcciones
     * @param int $idIntervencion 
     */
    private function buscarCorrecciones($usuario, $_correcciones, $idIntervencion) {
        $_retorno = array();
        if ($usuario->esFacilitador()) { //Busca todas las correcciones del dialogo
            foreach ($_correcciones as $_mov) {
                if ($_mov->idIntervencionAsociada == $idIntervencion)
                    array_push($_retorno, $_mov);
            }
        }else { //Buscar las correcciones del dialogo y el usuario.
            foreach ($_correcciones as $_mov) {
                if ($_mov->usuarioCorrector == $usuario->nombreUsuario && $_mov->idIntervencionAsociada == $idIntervencion) {
                    array_push($_retorno, $_mov);
                    return $_retorno;
                }
            }
        }
        return $_retorno;
    }

    /**
     * Busca la movida en función de un objeto Movida.
     * @param Movida $movidasDialogo Colección de movidas completas.
     * @param Movida $MovidaKey Objeto de movida, con identificador.
     * @return Movida retorna la movida hallada, o nulo en caso contrario.
     */
    private function buscarTipoMovidaObj($movidasDialogo, $MovidaKey) {
        foreach ($movidasDialogo as $mov) {
            if ($mov->IdMovida == $MovidaKey->IdMovida || $mov->Nombre == $MovidaKey->Nombre) {
                return $mov;
            }
        }
        return null;
    }

    /**
     * Busca la movida según su identificador.
     * @param Movida[] $_movidasDialogo
     * @param int $idMovida 
     * @return Movida Movida, o nulo si no encontró el identificador.
     */
    private function buscarTipoMovida($_movidasDialogo, $idMovida) {
        try {
            foreach ($_movidasDialogo as $mov) {
                if ($mov->IdMovida == $idMovida)
                    return $mov;
            }
        } catch (Exception $e) {
            
        }

        return null;
    }

    /**
     * Obtiene una lista detallada de todos los encabezados de los diálogos
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param int $pagina Número de página a obtener
     * @param string $msgError Mensaje por referencia para indicar posibles errores
     * @return Dialogo[] Arreglo de objetos Dialogo con la información básica para presentar una lista de los diálogos del sistema.
     */
    public function listarEncabezadosDialogo($sesion, $pagina, &$msgError) {
        $_retorno = Array();
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new DialogoDAC();
            $_retorno = $_dac->obtenerListaDialogosUsuario($sesion->usuario, $this->cantidadEncabezadosPorPagina, $pagina);
            $dialogoPermitidos = Array();
            foreach ($_retorno as $d) {
                array_push($dialogoPermitidos, $d);
            }
        } else {
            $msgError = "Sesión no válida";
        }
        return $_retorno;
    }

    /**
     * Obtiene una lista de los diálogos desbalanceados.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @return Dialogo[] Arreglo de objetos Dialogo. SI no existen diálogos desbalanceados, el arreglo no lleva elementos.
     */
    public function listarDialogosConAlerta($sesion) {
        //Dialogo[]
        $_retorno = Array();
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new DialogoDAC();
            //echo "p";
            $_retorno = $_dac->obtenerDialogosDesbalanceados();

            if (!$sesion->usuario->esAdministrador()) {
                $nombreUsuario = $sesion->usuario->nombreUsuario;
                $dialogosUsuario = Array();
                foreach ($_retorno as $d) {
                    if ($d->usuarioFacilitador->nombreUsuario == $nombreUsuario) {
                        array_push($dialogosUsuario, $d);
                    }
                }
                return $dialogosUsuario;
            }
        }

        return $_retorno;
    }

}

?>