<?php
include_once "MyModel.php";
class Producto
{
    public static $table = 'producto';
    var $nombre;
    var $precio;
    var $url_image;
    var $id_categoria;
    var $id;

    function __construct($nombre = null, $precio = null, $image_url = null, $id = null, $id_categoria = null)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->image_url = $image_url;
        $this->id = $id;
        $this->id_categoria = $id_categoria;
    }
    static function getAll()
    {
        return Mymodel::table(self::$table)
            ->selectFrom()->executeGET();
    }
    //devuelve primer elemento encontrado por el id
    static function get($id)
    {
        return Mymodel::table(self::$table)
            ->selectFrom()
            ->where('id', $id)
            ->executeGET()[0];
    }

    function modificar(){
        return Mymodel::table(self::$table)
                ->update(['nombre', 'precio', 'url_image', 'id_categoria'],
                [$this->nombre, $this->precio, $this->url_image, $this->id_categoria])
                ->where('id', $this->id)
                ->execute();
    }

    //ingresa el objeto
    function registrar()
    {
        $id = Mymodel::table(self::$table)
            ->insertInto(
                ['nombre', 'precio', 'url_image', 'id_categoria'],
                [$this->nombre, $this->precio, $this->url_image, $this->id_categoria]
            )
            ->executeInsert();
        $this->id = $id;
        return $this;
    }
    static function eliminar($id)
    {
        return Mymodel::table(self::$table)
            ->deleteFrom()->where('id', $id)
            ->execute();
    }
}
