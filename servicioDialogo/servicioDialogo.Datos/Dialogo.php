<?php

/**
 *Define un objeto de transporte que representa al encabezado de un diálogo 
 */
class Dialogo
    {
        
        /**
         *Identificador unico del dialogo
         * @var int 
         */
        public $idDialogo;

        /**
         *Usuario que creó el diálogo. 
         * @var Usuario 
         */
        public $usuarioCreador;

        /**
         *Usuario asignado como facilitador del dialogo, por defecto es el mismo creador 
         * @var Usuario
         */
        public $usuarioFacilitador;

        /**
         *Titulo del dialogo.
         * @var string
         */
        public $Titulo;

        /**
         *Fecha en que se publicó el diálogo.
         * @var DataTime 
         */
        public $FechaCreacion;

        /**
         *Indica la fecha de la ultima intervención. 
         * @var DateTime
         */
         
        public $FechaUltimaIntervencion;

        /**
         *Colección de reglas para mostrar a los participantes 
         * @var Regla[] 
         */
        public $Reglas;

         /**
          *Acta del usuario que visualiza el di�logo 
          * @var Acta 
          */
        public $ActaUsuario;

        /**
         *Balance ideal para el diálogo, utilizado para evaluar la emisi�n de alertas 
         * @var Balance[] 
         */
        public $balanceDialogo;

        /**
         *Colección de intervenciones realizadas dentro del diálogo 
         * @var Intervencion[]
         */
        public $intervenciones;

        /**
         *Categoría de movida asignada al momento de crear un diálogo 
         * @var CategoriaMovida 
         */         
        public $categoria;

        /**
         *Contiene las restricciones de usuario para el diálogo 
         * @var Usuario[] 
         */
        public $usuariosPermitidos;

        /**
         *Indica si el sistema debe advertir al usuario que el diálogo se encuentra desbalaceado de sus parámetros ideales 
         * @var bool
         */
        public $estaDialogoDesbalanceado;

        /**
         *Agrega una regla a la lista
         * @param Regla $regla 
         */
        public function addRegla($regla)
        {
            if ($this->Reglas == null)
            {
                //Nuevo array de Reglas.
                $this->Reglas = Array();
            }
            else if (!in_array($regla, $this->Reglas))
            {
                $_reg = $this->Reglas;
                array_push($_reg, $regla);
                $this->Reglas = $_reg;                
            }



        }
    }
    
    
?>