<?php
include_once "MyModel.php";
class Categoria{
    

    public static $table='categoria';
    var $nombre;
    var $image_url;
    var $id;
    var $descripcion;


    function __construct($nombre=null, $image_url=null, $id=null, $descripcion=null) {
        $this->nombre = $nombre;
        $this->image_url = $image_url;
        $this->id = $id;
        $this->descripcion = $descripcion;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getImage_url() {
        return $this->image_url;
    }

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setImage_url($image_url) {
        $this->image_url = $image_url;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    //obtengo todos los registros
    //devuelve todos
    static function getAll(){
        return Mymodel::table(self::$table)
        ->selectFrom()->executeGET();
    }
    //devuelve primer elemento encontrado por el id
    static function get($id){
        return Mymodel::table(self::$table)
                ->selectFrom()
                ->where('id', $id)
                ->executeGET()[0];
    }
    //modificar
    function modificar(){
        return Mymodel::table(self::$table)
                ->update(['nombre','image_url','descripcion'],[$this->nombre,$this->image_url,$this->descripcion])
                ->where('id', $this->id)
                ->execute();
    }
    //ingresa el objeto
    function registrar(){
        $id= Mymodel::table(self::$table)
                ->insertInto(['nombre','image_url','descripcion'],[$this->nombre,$this->image_url,$this->descripcion])
                ->executeInsert();
        $this->id=$id;
        return $this;
    }
    static function eliminar($id){
        return Mymodel::table(self::$table)
                ->deleteFrom()->where('id', $id)
                ->execute();
    }



}
?>