<?php

require_once './servicioDialogo.Datos/Intervencion.php';
require_once './servicioDialogo.Datos/Movida.php';

/**
 * Accede a los datos vinculados con una intervención. 
 */
class IntervencionDAC {

    /**
     * Obtiene las intervenciones realizadas por el usuario indicado.
     * @param string $usuario 
     */
    public function obtenerIntervencionesUsuario($usuario) {
        $_retorno = array();
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            if ($_exito) {
                $_query = new Query($conexion, "intervencion");
                $_query->addCampo("n_id_intervencion");
                $_query->addCampo("n_id_dialogo");
                $_query->addCampo("n_id_respuesta"); //crear objeto
                $_query->addCampo("x_id_usuario"); //crear objeto
                $_query->addCampo("n_id_movida");  //crear objeto
                $_query->addCampo("x_texto_intervencion");
                $_query->addCampo("d_fecha_creacion");
                $_query->addCampo("x_texto_respuesta");
                $_query->addCondicionAND("x_id_usuario='" . $usuario . "'");

                $_dt = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();

                $_retorno = array();

                $_hmovidas = array();
                $_husuarios = array();
                $_hintervenciones = array();

                $i = 0;
                foreach ($_dt as $dr) {
                    $_nueva = new Intervencion();
                    $_nueva->idIntervencion = $dr["n_id_intervencion"];

                    $_nueva->Texto = $dr["x_texto_intervencion"];
                    $_nueva->FechaCreacion = $dr["d_fecha_creacion"];
                    $_nueva->TextoRespuesta = $dr["x_texto_respuesta"];

                    $n_id_movida = $dr["n_id_movida"];
                    if (isset($_hmovidas[$n_id_movida]))
                        $_mov = $_hmovidas[$n_id_movida];
                    else {//si $_mov es nulo o no está definido.
                        $_mov = new Movida();
                        $_mov->IdMovida = $n_id_movida;
                        $_hmovidas[$n_id_movida] = $_mov;
                    }

                    if (isset($_husuarios[$usuario]))
                        $_autor = $_husuarios[$usuario];
                    else {
                        $_autor = new Usuario();
                        $_autor->nombreUsuario = $usuario;
                        $_husuarios[$usuario] = $_autor;
                    }

                    $_nueva->usuarioCreador = $_autor;
                    $_nueva->tipoMovida = $_mov;
                    $_nueva->idDialogo = $dr["n_id_dialogo"];

                    array_push($_retorno, $_nueva);
                    $_hintervenciones[$_nueva->idIntervencion] = $_nueva;
                }

// una vez asociado, es necesario vincular las respuestas, para eso se aprovecha la tabla hash creada
// el algoritmo asume que todas las respuestas vinculadas en la base de datos existen
// el valor 0 no es permitido como respuesta, pues una intervención debiera empezar por el número 1

                foreach ($_dt as $dr) {
                    try {
                        $idInt = $dr["n_id_intervencion"];
                        
                        if(!isset($dr["n_id_respuesta"])){
                            $idRespuesta = $dr["n_id_respuesta"];
                            
                            if($idRespuesta != 0){
                                $_intPadre = $_hintervenciones[$idRespuesta];
                                $_intHija = $_hintervenciones[$idInt];
                                $_intHija->intervencionRespuesta = $_intPadre;
                            }
                        }
                    } catch (Exception $e) {
                        
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        
        return $_retorno;
    }

    /**
     * Actualiza el texto de una intervención.
     * @param Intervencion $intervencion Intervención a actualizar.
     * @return bool Verdadero si se actualizó sin problemas.
     */
    public function actualizarIntervencion($intervencion) {

        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $query = new Query($conexion, "intervencion");

                $query->addValorString("x_texto_intervencion", $intervencion->Texto);
                $query->addCondicion("n_id_intervencion=" . $intervencion->idIntervencion);

//echo $query->QueryUpdate();
                $_exito = $conexion->modificar($query->QueryUpdate());
                $conexion->cerrarConexion();

                return $_exito;
            }
        } catch (Exception $e) {
            
        }
        return false;
    }

    /**
     * Inserta en la base de datos una fila nueva para la intervención
     * @param Dialogo $dialogoPadre Dialogo al que pertenece la intervención
     * @param Intervencion $intervencion Objeto de tipo intervención lleno.
     * @return bool Verdadero si pudo realizarse la inserción.
     */
    public function insertarIntervencion($dialogoPadre, $intervencion) {
        try {
            $n_id_respuesta = 0;
            if ($intervencion->intervencionRespuesta != null)
                $n_id_respuesta = $intervencion->intervencionRespuesta->idIntervencion;

            $x_id_usuario = $intervencion->usuarioCreador->nombreUsuario;


            $n_id_movida = $intervencion->tipoMovida->IdMovida;

            $x_texto_intervencion = $intervencion->Texto;

            $x_texto_respuesta = $intervencion->TextoRespuesta;

            $d_fecha_creacion = date("d-m-Y H:i:s");

            $n_id_dialogo = $dialogoPadre->idDialogo;




            $conexion = ConnectionManager::ObtenerConexion();

            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $query = new Query($conexion, "intervencion");
                if ($n_id_respuesta != 0) {
                    $query->addValorString("n_id_respuesta", $n_id_respuesta);
                    $query->addValorString("x_texto_respuesta", $x_texto_respuesta);
                }
                $query->addValorString("x_id_usuario", $x_id_usuario);
                $query->addValorString("n_id_movida", $n_id_movida);
                $query->addValorString("n_id_movida_original", $n_id_movida);
                $query->addValorString("x_texto_intervencion", $x_texto_intervencion);

                $query->addValorFechaTS("d_fecha_creacion", $d_fecha_creacion, true);
                $query->addValorString("n_id_dialogo", $n_id_dialogo);

//echo $query->QueryInsert();
                $_exito = $conexion->modificar($query->QueryInsert());
                $conexion->cerrarConexion();
            }

            return $_exito;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtiene detalles para la intervención indicada
     * @param int $idIntervencion ID de intervención a obtener.
     * @return Intervencion Objeto Intervención.
     */
    public function seleccionarIntervencion($idIntervencion) {
        $_retorno = new Intervencion();
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            if ($_exito) {
                $_query = new Query($conexion, "intervencion");
                $_query->addCampo("n_id_intervencion");
                $_query->addCampo("n_id_dialogo");
                $_query->addCampo("n_id_respuesta");
                $_query->addCampo("x_id_usuario"); //crear objeto
                $_query->addCampo("n_id_movida");  //crear objeto
                $_query->addCampo("x_texto_intervencion");
                $_query->addCampo("d_fecha_creacion");
                $_query->addCampo("x_texto_respuesta");
                $_query->addCondicionAND("n_id_intervencion=" . $idIntervencion);

                $_dt = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();

                $_retorno = new Intervencion();

                $_hmovidas = array();
                $_husuarios = array();
                $_hintervenciones = array();

//$_dt contiene solo una intervención,
//aquella que se busca.
                foreach ($_dt as $dr) {
                    $_nueva = new Intervencion();
                    $_nueva->idIntervencion = $idIntervencion;

                    $_nueva->Texto = $dr["x_texto_intervencion"];
                    $_nueva->FechaCreacion = $dr["d_fecha_creacion"];
                    $_nueva->TextoRespuesta = $dr["x_texto_respuesta"];

                    $n_id_movida = $dr["n_id_movida"];
                    $_hmovidas[$n_id_movida] = new Movida();
                    $_mov = $_hmovidas[$n_id_movida];
                    if ($_mov == null) {
                        $_mov = new Movida();
                        $_mov->IdMovida = $n_id_movida;
                        $_hmovidas[$n_id_movida] = $_mov;
                    }

                    $x_id_usuario = $dr["x_id_usuario"];
                    $_husuarios[$x_id_usuario] = new Usuario();
                    $_autor = $_husuarios[$x_id_usuario];
                    if ($_autor == null) {
                        $_autor = new Usuario();
                        $_autor->nombreUsuario = $x_id_usuario;
                        $_husuarios[$x_id_usuario] = $_autor;
                    }

                    $_nueva->usuarioCreador = $_autor;
                    $_nueva->tipoMovida = $_mov;
                    $_nueva->idDialogo = $dr["n_id_dialogo"];

                    $_retorno = $_nueva;
//Almacena la intervención que se busca en una tabla hash,
//con su ID como clave.
                    $_hintervenciones[$_nueva->idIntervencion] = $_nueva;
// echo $_nueva->idIntervencion;
                }
//echo json_encode($_hintervenciones)."--";
// una vez asociado, es necesario vincular las respuestas, para eso se aprovecha la tabla hash creada
// el algoritmo asume que todas las respuestas vinculadas en la base de datos existen
// el valor 0 no es permitido como respuesta, pues una intervención debiera empezar por el número 1
//               APARENTEMENTE NO ES DE GRAN UTILIDAD EN ESTA OCASIÓN, 
//               YA QUE NO AFECTA EL RESULTADO RETORNADO, Y LA HASHTABLE SE CREA CADA VEZ QUE SE LLAMA AL MÉTODO,
//               POR ENDE, CADA VEZ SE COMIENZA A TRABAJAR CON UNA HT VACÍA.
//                foreach ($_dt as $dr) {
//                    try {
//                        $idInt = $dr["n_id_intervencion"];
//                        //echo json_encode($dr);
//                        if ($dr["n_id_respuesta"] != null) {
//                            $idRespuesta = $dr["n_id_respuesta"];
//                            if ($idRespuesta != 0) {
//                                //echo "==". $idRespuesta ."==";
//                                $_intPadre = $_hintervenciones[$idRespuesta];
//                                //echo json_encode($_intPadre);
//                                $_intHija = $_hintervenciones[$idInt];
//
//                                $_intHija->intervencionRespuesta = $_intPadre;
//                            }
//                        }
//                    } catch (Exception $e) {
//                        
//                    }
//                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Obtiene la lista de intervenciones asociadas al dialogo indicado.
     * @param int $idDialogo Identificados unico del dialogo.
     */
    public function seleccionarIntervenciones($idDialogo) {
//Intervencion[]
        $_retorno = Array();

        try {
            $conexion = ConnectionManager::ObtenerConexion();

//bool
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "intervencion");
                $_query->addCampo("n_id_intervencion");
                $_query->addCampo("n_id_respuesta"); //crear objeto
                $_query->addCampo("x_id_usuario"); //crear objeto
                $_query->addCampo("n_id_movida");  //crear objeto
                $_query->addCampo("x_texto_intervencion");
                $_query->addCampo("d_fecha_creacion");
                $_query->addCampo("x_texto_respuesta");
                $_query->addCondicionAND("n_id_dialogo=" . $idDialogo);

                $_query->addOrden("d_fecha_creacion,n_id_intervencion");

                $_dt = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();

                $_retorno = Array();
                $i = 0;
                $_hmovidas = Array();
                $_husuarios = Array();
                $_hintervenciones = Array();

                foreach ($_dt as $dr) {
//Intervencion
                    $_nueva = new Intervencion();
                    $_nueva->idIntervencion = $dr["n_id_intervencion"];

                    $_nueva->Texto = $dr["x_texto_intervencion"];
                    $_f = new DateTime($dr["d_fecha_creacion"]);
                    $_nueva->FechaCreacion = date_format($_f, "d-m-Y H:i:s");
                    $_nueva->TextoRespuesta = $dr["x_texto_respuesta"];

//echo $dr["n_id_movida"];
//int
                    $n_id_movida = $dr["n_id_movida"];
//Movida
                    $_hmovidas[$n_id_movida] = null;
                    $_mov = $_hmovidas[$n_id_movida];
                    if ($_mov == null) {
                        $_mov = new Movida();

                        $_mov->IdMovida = $n_id_movida;
                        $_hmovidas[$n_id_movida] = $_mov;
                    }

                    $_nueva->tipoMovida = $_mov;


//Además, se vinculan los usuarios.
                    try {
//string
                        $x_id_usuario = $dr["x_id_usuario"];
//Usuario

                        $_husuarios[$x_id_usuario] = null;
                        $_autor = $_husuarios[$x_id_usuario];

                        if ($_autor == null) {
                            $_autor = new Usuario();

                            $_autor->nombreUsuario = $x_id_usuario;
//echo $x_id_usuario;
                            $_husuarios[$x_id_usuario] = $_autor;
                        }

                        $_nueva->usuarioCreador = $_autor;
                    } catch (Exception $e) {
                        
                    }

                    $_retorno[$i++] = $_nueva;
                    $_hintervenciones[$_nueva->idIntervencion] = $_nueva;
                }

//una vez asociado, es necesario vincular las respuestas, para eso se aprovecha la tabla hash creada
//el algoritmo asume que todsa las respuestas vinculadas en la base de datos existen
//el valor 0 no es permitido como respuesta, pues una intervencion deberia empezar por el numero 1.

                foreach ($_dt as $dr) {
                    try {
                        $idInt = $dr["n_id_intervencion"];

                        if ($dr["n_id_respuesta"] != null) {
                            $idRespuesta = $dr["n_id_respuesta"];

                            if ($idRespuesta != 0) {
//Intervencion
                                $_intPadre = $_hintervenciones[$idRespuesta];
//Intervencion
                                $_intHija = $_hintervenciones[$idInt];

                                $_intHija->intervencionRespuesta = $_intPadre;
                            }
                        }
                    } catch (Exception $e) {
                        
                    }
                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

}

?>
