<?php

/**
 *Clase de utilidad para asistencia de SQL. GEnera consultas SQL de inserción, selección, actualización y borrado. 
 */
class Query{
    //Lista de strings
    private $listaCampos=array();
    
    //HashTable
    private $hashValores= array();
    
    //string
    private $orden="";
    
    //string
    private $stringcondicion="";
    
    //Nombre de la tabla
    public $tabla;
    
    //Indica el driver de conexion usado para la generacion de consultas.
    //DBDriver
    public $driver; //para el soporte de otros motores.
    
    /**
     *Crea un objeto consulta con el driver y la tabla indicados
     * @param type $driver Driver para usar como referencia en la generacion de consultas
     * @param type $nombreTabla Tabla para la consulta.
     */
    public function __construct($driver, $nombreTabla) {
        $this->tabla = $nombreTabla;
        $this->driver = $driver;
        
    }
    
    /**
     *Agrega un campo a la consulta de seleccion
     * @param type $campo 
     */
    public function addCampo($campo){
        $campo = strtolower($campo);
        if(!array_key_exists($campo, $this->listaCampos)){
            array_push($this->listaCampos, $campo);
        }
    }
    
    /**
     *Agrega un nombre de campo y un valor asociado. útil para consultas de insercion y actualización.
     * @param string $campo
     * @param string $valor 
     */
    public function addValorString($campo, $valor){
        $this->addCampo($campo);
        $this->hashValores[$campo]="'".$valor."'";
    }
    
    /**
     *Agrega un nombre de campo y un valor asociado. Útil para consultas de insercion y actualización.
     * @param string $campo
     * @param int $valor 
     */
    public function addValorInt($campo, $valor){
        $this->addCampo($campo);
        $this->hashValores[$campo]=$valor;
    }
    
    /**
     *Agrega un nombre de campo y un valor asociado. Útil para consultas de insercion y actualización.
     * @param string $campo
     * @param Decimal $valor 
     */
    public function addValorDecimal($campo, $valor){
        $this->addCampo($campo);
        $this->hashValores[$campo]=  str_replace(",", ".", $valor);
    }
    
    /**
     *Agrega un nombre de campo y un valor asociado. Útil para consultas de insercion y actualización.
     * @param string $campo
     * @param DateTime $valor 
     */
    public function addValorFecha($campo, $fecha){
        $this->addCampo($campo);
        $this->hashValores[$campo]=  new DateTime($fecha);
    }
    
    /**
     *Agrega un nombre de campo y un valor asociado. Útil para consultas de insercion y actualización.
     * @param string $campo
     * @param bool $valor 
     */
    public function addValorFechaTS($campo, $fecha, $timeStamp){
        $this->addCampo($campo);
        if($timeStamp){
            $this->hashValores[$campo]=  "'".$fecha."'";
        }else{
            $this->hashValores[$campo]=  "'".$fecha."'";
        }
        
    }
    
    /**
     *Agrega una condicion a la consulta. util para la seleccion, actualización y borrado.
     * @param type $condicion 
     */
    public function addCondicion($condicion){
        $this->stringcondicion=$condicion;
    }
    
    /**
     *Agrega una condicion de tipo "condicion1 Y condicion2" a la consulta.
     * util para la seleccion, actualizacion y borrado.
     * @param type $condicion 
     */
    public function addCondicionAND($condicion){
        $_and = "";
        if(strlen($this->stringcondicion)>0){
            $_and = "AND ";
        }
        $this->stringcondicion=$this->stringcondicion . $_and . $condicion . " ";       
    }
    
    /**
     *Agrega un campo que sera utilizado para ordenar el resultado de una consulta de seleccion
     * @param type $p 
     */
    public function addOrden($p){
        if($this->orden == null)
            $this->orden="";
        $this->orden = $this->orden.$p;
    }
    
    /***************GENERACION DE CONSULTAS*********************/
    
    /**
     *Query SQL para agregar datos 
     */
    public function QueryInsert(){
        $query = "insert into " . $this->tabla;
        
        $campos = "";
        $vals = "";
        foreach($this->hashValores as $campo => $valor){
            $campos .= "," . $campo;
            $vals .= "," . $this->hashValores[$campo];
        }
        $query .= "(" . substr($campos, 1) . ")";
        $query .= " values (" . substr($vals, 1) . ")";
        return $query;
    }
    
    /**
     *Query SQL para seleccionar datos 
     */
    public function QuerySelect(){
        $_retorno = "select ";
        $_campos = "";
        foreach($this->listaCampos as $campo){
            $_campos .= "," . $campo;
        }
        if(strlen($_campos) > 1)
            $_retorno .= substr($_campos, 1);
        
        
        $_retorno .= " from " . $this->tabla;
       
        if($this->stringcondicion != null && strlen(trim($this->stringcondicion)) > 0){
            $_retorno .= " where " . $this->stringcondicion;
        }
        if($this->orden != null && strlen(trim($this->orden)) > 0 ){
            $_retorno .= " order by " . $this->orden;
        }
        
        return $_retorno;
    }
    
    /**
     *Query SQL para actualizar datos 
     */
    public function QueryUpdate(){
        $_sbase = "update " . $this->tabla . " set ";
        $_cant = count($this->hashValores);
        $i=0;
        foreach($this->hashValores as $nombreCampo => $valor){
            $_sbase .= $nombreCampo . "=" . $this->hashValores[$nombreCampo];
            $i++;
            
            if($i != $_cant){
                $_sbase .= ",";
            }
        }
        
        if($this->stringcondicion != null && strlen(trim($this->stringcondicion))>0){
            $_sbase .= " where " . $this->stringcondicion;
        }
        
        return $_sbase;
    }
    
    /**
     * Query SQL para borrar datos.
     * @return type 
     */
    public function QueryDelete(){
        return "delete from " . $this->tabla . " where " . $this->stringcondicion;
    }
    

    }
?>