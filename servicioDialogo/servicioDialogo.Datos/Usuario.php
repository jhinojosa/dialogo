<?php
/**
 *Representa a un usuario del sistema 
 */
    class Usuario{
        /**
         *Constante para el rol de facilitador
         * @var int 
         */
        public $ROL_FACILITADOR=1;
        
        /**
         *Constante para el rol de participante.
         * @var int
         */
        public $ROL_PARTICIPANTE=0;
        
        /**
         *Constante para el rol de administrador 
         */
        public $ROL_ADMINISTRADOR=2;
        
        /**
         *Identificador unico para el usuario dentro del sistema
         * @var string
         */
        public $nombreUsuario="";
        
        /**
         *Nombre completo del usuario.
         * @var string
         */
        public $nombreCompleto="";
        /**
         *Direccion de correo electronico del usuario
         * @var string
         */
        public $email="";
        
        /**
         *Contraseña en texto plano utilizada por el usuario
         * @var string
         */
        public $Password="";
        
        /**
         *Rol asociado al usuario
         * @var int
         */
        public $Rol=0;
        
        /**
         *Cadena que indica el lugar del servidor donde está la imagen del usuario
         * @var string
         */
        public $imagen;
        
        /**
         *Determina si un usuario cumple el rol de facilitador
         * Los administradores son facilitadores
         * @return bool
         */
        public function esFacilitador(){
            return ($this->Rol == $this->ROL_FACILITADOR || $this->Rol == $this->ROL_ADMINISTRADOR);
        }
        
        /**
         *Determina si un usuario cumple el rol de administrador.
         * @return bool 
         */
        public function esAdministrador(){
            return ($this->Rol== $this->ROL_ADMINISTRADOR);
        }
        
        /**
         *Verifica si la contrasela indicada es válida
         * @param string $plainPassword Password en texto plano
         * @return bool Verdadero si la contraseña coincide con los criterios del hash, falso en caso contrario.
         */
        public function PassWordValido($plainPassword){
            if(strtoupper(md5($plainPassword)) == strtoupper($this->Password)){
                //echo md5($plainPassword);
                return true;
            }else{
                return false;
                }
        }
        
        /**
         *Obtiene el password en MD5
         * @return type 
         */
        public function hashPassword(){
            return md5($this->Password);
        }
        
        /**
         *retorna el nombre de usuario
         * @return string
         */
        public function ToString(){
            return $this->nombreUsuario;
        }
    }
?>