<?php
    include_once "ConexionMysql.php";
    class Mymodel{
/*
        ejemplos de uso
        //SELECT devuelve array
        select Mymodel::table('persona')->selectFrom()->where('nombre','perez')->executeGET();
        //INSERT devuelve id insertado primary key
        insert Mymodel::table('persona')->insertInto(
            ['nombre','apellido','telefono','edad','direccion','cedula'],
        ['juan','perez','7774747','30','scz','11122334'])->executeInsert();
       
       //UPDATE devuelve num columnas afectadas
        Mymodel::table('persona')
        ->update($pc,$pv)
        ->where('apellido','Perez')
        ->execute();
            */


        public $table = "";
        var $conn;

        public $sql;

        function __construct(){
            $this->conn=Conexion::$conn;
        }

        public function prepareSql(){
            $this->sql="";
            return $this;
        }
        public function selectFrom(){
            
            $this->sql=$this->sql."Select * from ".$this->table." ";  
            return $this;  
        }
        public function where($column,$value){
            $this->sql=$this->sql."where $column='$value' ";  
            return $this;
        }
        public function notwhere($column,$value){
            $this->sql=$this->sql."where $column!='$value' ";  
            return $this;
        }
        
        public function and_(){
            $this->sql=$this->sql."and ";  
            return $this;
        }
        public function condition($column,$expresion="=",$value){
            $this->sql=$this->sql."$column $expresion '$value'";  
            return $this;
        }


        public function insertInto($columns,$values){
            $sql = "INSERT INTO " .$this->table."(";

            $loop=0;
            foreach($columns as $c){
                $d="$c";

                if($loop<(sizeof($columns)-1))$d=$d.",";
                
                $sql=$sql.$d;
                $loop++;
            }

            $sql=$sql.")VALUES (";


            $loop=0;
            foreach($values as $v){
                $d="'$v'";
                if($loop<(sizeof($values)-1))$d=$d.",";
                $sql=$sql.$d;

                $loop++;
            }
            $sql=$sql.")";

            $this->sql=$this->sql.$sql." ";
            return $this;
        }
        public function update($columns,$values){
            $sql="update ".$this->table." set ";

            $loop=0;
            foreach($columns as $c){
                $d="$c='$values[$loop]'";

                if($loop<(sizeof($columns)-1))$d=$d.",";
                
                $sql=$sql.$d;
                $loop++;
            }

            $this->sql=$this->sql.$sql." ";
            return $this;
        }

        public function deleteFrom(){
            $this->sql=$this->sql."delete from ".$this->table." ";  
            return $this; 
        }

        //executeGET devuelve todas los rows
        
        
        //ejecuta sql y devuelve numero columnas afectadas
        public function execute(){
            $resultado = $this->conn->query($this->sql);
            if ($resultado === false) {
                $consult="No se pudo ejecutar el query ,$this->sql,";
                throw new Exception("Model Execute Insert failed: ".$consult.$this->conn->error);
                //http_response_code(500);
                //die();
                return false;
            }
            else return $this->conn->affected_rows;
        }
        //devuelve array de lineas
        public function executeGET(){
            $resultado = $this->conn->query($this->sql);
            if ($resultado === false) {
                $consult="No se pudo ejecutar el query ,$this->sql,";
                throw new Exception("Model Execute GET failed: ".$consult.$this->conn->error);
               // http_response_code(500);
                //die();
                return false;
            } else {
                $array = [];
                $row = null;
                while ($row = $resultado->fetch_assoc())
                    array_push($array, $row);
                return $array;
            }
        }
        //ejecuta inserta y devuelve primary key del insertado
        public function executeInsert(){
            $resultado = $this->conn->query($this->sql);
            if($resultado===false){
                $consult="No se pudo ejecutar el query ,$this->sql,";
                throw new Exception("Model Execute Insert failed: ".$consult.$this->conn->error);
                //http_response_code(500);
                //die();
                return false;
            }
           
           return $this->conn->insert_id;
        }

        //devuelve objeto mymodel
        public static function table($table){
            $m=new Mymodel();
            $m->table=$table;
            $m->prepareSql();
            return $m;
        }

    }
?>