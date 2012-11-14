<?php

require_once("ConnectionManager.php");
require_once'utils/Query.php';
require_once'./servicioDialogo.Datos/Dialogo.php';
require_once'./servicioDialogo.Datos/Usuario.php';

/**
 * Accede a los datos vinculados con la tabla dialogo. 
 */
class DialogoDAC {

    /**
     * Inserta un registro en la base de datos.
     * La capa superior debe encargarse de llamar a las funciones de inserción
     * para las dependencias.
     * El acceso a datos no valida, sólo inserta.
     * @param Dialogo $nuevoDialogo Objeto de diálogo completo con la información necesaria para la tabla diálogo.
     * @param string $idDialogo Identificador de diálogo por referencia, es asignado tras la correcta inserción.
     * @return bool Verdadero si la inserción fue exitosa.
     */
    public function insertarDialogo($nuevoDialogo, &$idDialogo) {
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            if ($_exito) {
                $_consulta = new Query($conexion, "dialogo");
                $n_id_usuario_creador = $nuevoDialogo->usuarioCreador->nombreUsuario;
                $n_id_usuario_facilitador = $nuevoDialogo->usuarioCreador->nombreUsuario;
                if ($nuevoDialogo->usuarioFacilitador != null) {
                    $n_id_usuario_facilitador = $nuevoDialogo->usuarioFacilitador->nombreUsuario;
                }

                $_consulta->addValorString("x_id_usuario_creador", $n_id_usuario_creador);
                $_consulta->addValorString("x_id_usuario_facilitador", $n_id_usuario_facilitador);
                $_consulta->addValorString("x_titulo_dialogo", $nuevoDialogo->Titulo);
                $_consulta->addValorString("d_fecha_creacion", date("d-m-Y H:i:s"));

                $_ret = $conexion->modificar_($_consulta->QueryInsert(), "n_id_dialogo", $idDialogo);

                $conexion->cerrarConexion();

                return $_ret;
            }
        } catch (Exception $e) {
            
        }

        return false;
    }

    public function eliminarDialogo($idDialogo) {
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();

            if($_exito){
                $_consulta = new Query($conexion, "dialogo");
                $_consulta->addCondicion("n_id_dialogo =  " . $idDialogo);
                $_ret = $conexion->modificar($_consulta->QueryDelete());
                $conexion->cerrarConexion();
                return $_ret;
            }
        } catch (Exception $e) {}

        return false;
    }

    /**
     * Actualiza en la base de datos el valor n_dialogo_desbalanceado
     * para el diálogo indicado por su ID, según el valor indicado.
     * @param int $idDialogo ID del diálogo
     * @param bool $marca Verdadero: Desbalanceado.
     */
    public function actualizarDesbalanceDialogo($idDialogo, $marca) {
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "dialogo");

                if ($marca)
                    $_query->addValorString("n_dialogo_desbalanceado", 1);
                else
                    $_query->addValorString("n_dialogo_desbalanceado", 0);

                $_query->addCondicionAND("n_id_dialogo = " . $idDialogo);

                $conexion->modificar($_query->QueryUpdate());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }
    }

    /**
     * Obtiene los encabezados asociadaos para el diálogo indicado.
     * @param int $idDialogo Identificador del dialogo.
     * @return Dialogo Objeto Dialogo completo.
     */
    public function listaEncabezado($idDialogo) {
        $_ret = new Dialogo();
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "dialogo");

                $_query->addCampo("x_titulo_dialogo");
                $_query->addCampo("x_id_usuario_creador");
                $_query->addCampo("d_fecha_creacion");
                $_query->addCampo("x_id_usuario_facilitador");
                $_query->addCampo("n_dialogo_desbalanceado");
                $_query->addCondicion("n_id_dialogo=" . $idDialogo);
                $_tabla = $conexion->consultar($_query->QuerySelect());

                $conexion->cerrarConexion();

                $_ret = new Dialogo();

                foreach ($_tabla as $dr) {
                    try {
                        $_nueva = new Dialogo();
                        $_nueva->idDialogo = $idDialogo;
                        $_nueva->Titulo = $dr["x_titulo_dialogo"];

                        $_usuarioCreador = new Usuario();
                        $_usuarioCreador->nombreUsuario = $dr["x_id_usuario_creador"];
                        $_nueva->usuarioCreador = $_usuarioCreador;
                        $_nueva->FechaCreacion = $dr["d_fecha_creacion"];

                        $_usuarioFacilitador = new Usuario();
                        $_usuarioFacilitador->nombreUsuario = $dr["x_id_usuario_creador"];
                        $_nueva->usuarioFacilitador = $_usuarioFacilitador;

                        try {
                            if ($dr["n_dialogo_desbalanceado"] == 1)
                                $_nueva->estaDialogoDesbalanceado = true;
                            else
                                $_nueva->estaDialogoDesbalanceado = false;
                        } catch (e $e) {
                            
                        }

                        $_ret = $_nueva;
                    } catch (Exception $e) {
                        
                    }
                }
            }
        } catch (Exception $e) {
            
        }

        return $_ret;
    }

    /**
     * Genera un objeto Dialogo sin mayor detalle que lo estrictamente vinculado a la tabla Dialogo.
     * @param int $idDialogo Identificador único del diálogo
     * @return Dialogo Objeto dialogo con los datos de la tabla. Objeto de dialogo vacío con id 0 en caso contrario.
     */
    public function obtenerDialogo($idDialogo) {
        $conexion = ConnectionManager::ObtenerConexion();
        try {
//bool
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "dialogo");
//                $_query->addCampo("n_id_dialogo");
//                $_query->addCampo("x_titulo_dialogo");
//                $_query->addCampo("x_id_usuario_creador");
//                $_query->addCampo("x_id_usuario_facilitador");
//                $_query->addCampo("d_fecha_creacion");
//
//                $_query->addCondicionAND("n_id_dialogo=" . $idDialogo);

                $_query = "select d.n_id_dialogo, d.x_titulo_dialogo, d.x_id_usuario_creador, 
                    d.x_id_usuario_facilitador, d.d_fecha_creacion, u.x_nombre_completo from 
                    dialogo d INNER JOIN usuario u ON d.x_id_usuario_creador=u.x_id_usuario 
                    and d.n_id_dialogo=" . $idDialogo;
//                $_tabla = $conexion->consultar($_query->QuerySelect());
                $_tabla = $conexion->consultar($_query);
                $conexion->cerrarConexion();

                if (count($_tabla) > 0) {
                    $dr = $_tabla[0];

                    try {
                        $_nueva = new Dialogo();
                        $_nueva->idDialogo = $idDialogo;
                        $_nueva->Titulo = $dr["x_titulo_dialogo"];
                        $_f = new DateTime($dr["d_fecha_creacion"]);
                        $_nueva->FechaCreacion = date_format($_f, "d-m-Y");

                        $_usuarioCreador = new Usuario();
                        $_usuarioCreador->nombreUsuario = $dr["x_id_usuario_creador"];
                        $_usuarioCreador->nombreCompleto = $dr["x_nombre_completo"];
                        $_nueva->usuarioCreador = $_usuarioCreador;

                        $_usuarioFacilitador = new Usuario();
                        $_usuarioFacilitador->nombreUsuario = $dr["x_id_usuario_facilitador"];
                        $_nueva->usuarioFacilitador = $_usuarioFacilitador;

                        return $_nueva;
                    } catch (Exception $e) {
//filas de datos corruptos no son agregadas.
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        $d = new Dialogo();
        $d->idDialogo = 0;
        return $d;
    }

    /**
     * Lista los dialogos que poseen la marca de desbalance. 
     */
    public function obtenerDialogosDesbalanceados() {
//Dialogo[]
        $_ret = Array();
        $conexion = ConnectionManager::ObtenerConexion();

        try {

            $_exito = $conexion->abrirConexion();

            if ($_exito) {
//                $_query = new Query($conexion, "dialogo");
//                $_query->addCampo("n_id_dialogo");
//                $_query->addCampo("x_titulo_dialogo");
//                $_query->addCampo("x_id_usuario_creador");
//                $_query->addCampo("x_id_usuario_facilitador");
//                $_query->addCampo("d_fecha_creacion");
//
//                $_query->addCondicionAND("n_dialogo_desbalanceado=1");
//                $_tabla = $conexion->consultar($_query->QuerySelect());

                $_q = 'select d.n_id_dialogo,x_titulo_dialogo,x_id_usuario_creador,';
                $_q .= 'd_fecha_creacion,x_id_usuario_facilitador,';
                $_q .= '(select max(d_fecha_creacion) from intervencion i where i.n_id_dialogo = d.n_id_dialogo) d_fecha_ultima_intervencion';
                $_q .= ' from dialogo d where d.n_dialogo_desbalanceado=1';

                $_tabla = $conexion->consultar($_q);
                $conexion->cerrarConexion();

                if (count($_tabla) > 0) {
                    $_ret = Array();
                    $i = 0;
                    foreach ($_tabla as $dr) {
                        try {
                            $_nueva = new Dialogo();
                            $_nueva->idDialogo = $dr["n_id_dialogo"];
                            $_nueva->Titulo = $dr["x_titulo_dialogo"];

                            $_f = new DateTime($dr["d_fecha_creacion"]);
                            $_nueva->FechaCreacion = date_format($_f, "d-m-Y");
                            //$_nueva->FechaCreacion = $dr["d_fecha_creacion"];

                            $_usuarioCreador = new Usuario();
                            $_usuarioCreador->nombreUsuario = $dr["x_id_usuario_creador"];
                            $_nueva->usuarioCreador = $_usuarioCreador;

                            $_usuarioFacilitador = new Usuario();
                            $_usuarioFacilitador->nombreUsuario = $dr["x_id_usuario_facilitador"];
                            $_nueva->usuarioFacilitador = $_usuarioFacilitador;

                            try {
                                $_f = new DateTime($dr["d_fecha_ultima_intervencion"]);
                                $_nueva->FechaUltimaIntervencion = date_format($_f, "d-m-Y H:i:s");
                            } catch (Exception $e) {
                                
                            }
//$_ret[0] = $_nueva;
                            array_push($_ret, $_nueva);
                        } catch (Exception $e) {
//filas con datos corruptos no son agregadas.
                        }
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        return $_ret;
    }

    /**
     * Obtiene una lista de todos los encabezados de los diálogos
     * @param Usuario $usuario
     * @param int $cantidadPorPagina
     * @param int $pagina 
     * @return Dialogo[] Arreglo de objetos Dialogo con la información básica para presentar una lista de los diálogos del sistema.
     */
    public function obtenerListaDialogosUsuario($usuario, $cantidadPorPagina, $pagina) {
        $_ret = Array();
        $conexion = ConnectionManager::ObtenerConexion();
//echo $conexion->DatabaseName;
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_tabla = null;
//Si la conexion es del tipo PostgreSQLDriver.

                if ($conexion instanceof PostreSQLDriver) {
                    $_q = "select d.n_id_dialogo,x_titulo_dialogo,x_id_usuario_creador,";
                    $_q .= " d_fecha_creacion,x_id_usuario_facilitador,n_dialogo_desbalanceado ";
                    $_q .= " ,r.x_id_usuario ";
                    $_q .= ",(select max(d_fecha_creacion) from intervencion i where i.n_id_dialogo = d.n_id_dialogo) d_fecha_ultima_intervencion";
                    $_q .= " from dialogo d left join";
                    $_q .= " restriccion_dialogo r on d.n_id_dialogo = r.n_id_dialogo";
                    $_q .= " where r.x_id_usuario is Null or r.x_id_usuario = '" . $usuario->nombreUsuario . "'";

                    $_tabla = $conexion->consultar($_q);
                } else {
                    $_query = new Query($conexion, "dialogo");
                    $_query->addCampo("n_id_dialogo");
                    $_query->addCampo("x_titulo_dialogo");
                    $_query->addCampo("x_id_usuario_creador");
                    $_query->addCampo("d_fecha_creacion");
                    $_query->addCampo("x_id_usuario_facilitador");
                    $_query->addCampo("n_dialogo_desbalanceado");

                    $_tabla = $conexion->consultar($_query->QuerySelect());
                }

                $conexion->cerrarConexion();

                $_ret = Array();
                $i = 0;


                foreach ($_tabla as $dr) {

                    try {
                        $_nueva = new Dialogo();
                        $_nueva->idDialogo = $dr["n_id_dialogo"];
                        $_nueva->Titulo = $dr["x_titulo_dialogo"];

                        $_usuarioCreador = new Usuario();
                        $_usuarioCreador->nombreUsuario = $dr["x_id_usuario_creador"];
                        $_nueva->usuarioCreador = $_usuarioCreador;
                        $_f = new DateTime($dr["d_fecha_creacion"]);
                        $_nueva->FechaCreacion = date_format($_f, "d-m-Y");

                        try {
                            $_f = new DateTime($dr["d_fecha_ultima_intervencion"]);
                            $_nueva->FechaUltimaIntervencion = date_format($_f, "d-m-Y H:i:s");
                        } catch (Exception $e) {
                            
                        }

                        $_usuarioFacilitador = new Usuario();
                        $_usuarioFacilitador->nombreUsuario = $dr["x_id_usuario_facilitador"];
                        $_nueva->usuarioFacilitador = $_usuarioFacilitador;

                        try {
                            if ($dr["n_dialogo_desbalanceado"] == 1)
                                $_nueva->estaDialogoDesbalanceado = true;
                            else
                                $_nueva->estaDialogoDesbalanceado = false;
                        } catch (Exception $e) {
                            
                        }
                        $_ret[$i++] = $_nueva;
                    } catch (Exception $e) {
//filas con datos corruptos no son agregadas.
                    }
                }
            }
        } catch (Exception $e) {
            
        }
        return $_ret;
    }

}

?>
