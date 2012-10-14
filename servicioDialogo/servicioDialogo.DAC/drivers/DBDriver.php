<?php

interface DBDriver{
    /**
         *Abre la conexion con la base de datos.
         * @return Verdadero si se pudo abrir la conexion. 
         */
        public function abrirConexion();

        /**
         *Cierra la conexion con la base de datos. 
         */
        public function cerrarConexion();

        /**
         * Realiza una consulta de selección en la base de datos
         * @param string $query Consulta de selección a ejecutar
         * @return Array Array con los resultados.
         */
        public function consultar($query);

        /**
         *Realiza una transacción sin esperar un retorno
         * @param string $query Consulta a ejecutar
         * @return bool Verdadero si la consulta afectó a filas. 
         */
        public function modificar($query);

        /**
         *Realiza una transacción obteniendo el valor de retorno
         * @param string $query Consulta a ejecutar.
         * @param string $campoRetorno Nombre de la columna a rescatar tras la inserción
         * @param int $valor Entero por referencia utilizado para conocer el valor asignado.
         * @return bool Verdadero si la consulta afectó a filas. 
         */
        public function modificar_($query, $campoRetorno, &$valor);
}
?>
