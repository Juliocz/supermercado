<?php

class ProductoController
{

    function __construct()
    {
    }
    function registrar()
    {
        //header('Content-Type: application/json; charset=utf-8');
        //echo "hola";

        try {
            include_once "../Modelo/Producto.php";
            $objPost = Route::getPostJson();
           // echo json_encode($objPost);
            $c = new Producto($objPost->nombre,$objPost->precio,$objPost->url_image,null, $objPost->id_categoria);
            $c->registrar();
            echo "1";
        } catch (Throwable $ex) {
            http_response_code(500);
            if(strpos($ex,'Duplicate entry')){
            echo '2';return;}//2 es ya existe
            else 
            echo $ex . ",No se pudo registrar";
        }
    }
    function modificar()
    {
        try {
            include_once "../Modelo/Producto.php";
            $objPost = Route::getPostJson();
            $c = new Producto($objPost->nombre,$objPost->precio,$objPost->url_image,$objPost->id,$objPost->id_categoria);
            $c->modificar();
            echo '1';
        } catch (Throwable $ex) {
            http_response_code(500);
            if(strpos($ex,'Duplicate entry')){
                echo '2';return;}//2 es ya existe
            echo $ex . ",No se pudo modificar";
        }
    }

    function eliminar(){
        try {
            include_once "../Modelo/Producto.php";
            $objPost = Route::getPostJson();
            $numafects=Producto::eliminar($objPost->id);

            if($numafects==0) echo "No se elimino ningun registro";
            else echo '1';
        }catch(Throwable $ex){
            http_response_code(500);
            echo $ex . ",No se pudo modificar";
        }
    }
}
