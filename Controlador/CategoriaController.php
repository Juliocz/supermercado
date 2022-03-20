<?php

class CategoriaController
{

    function __construct()
    {
    }
    function registrar()
    {
        //header('Content-Type: application/json; charset=utf-8');
        //echo "hola";

        try {
            include_once "../Modelo/Categoria.php";
            $objPost = Route::getPostJson();
            $c = new Categoria($objPost->nombre, null, null, $objPost->descripcion);
            $c->registrar();
            echo "Se registro correctamente";
        } catch (Throwable $ex) {
            http_response_code(500);
            echo $ex . ",No se pudo registrar";
        }
    }
    function modificar()
    {
        try {
            include_once "../Modelo/Categoria.php";
            $objPost = Route::getPostJson();
            $c = new Categoria($objPost->nombre, null, $objPost->id, $objPost->descripcion);
            echo $c->modificar();
        } catch (Throwable $ex) {
            http_response_code(500);
            echo $ex . ",No se pudo modificar";
        }
    }

    function eliminar(){
        try {
            include_once "../Modelo/Categoria.php";
            $objPost = Route::getPostJson();
            $numafects=Categoria::eliminar($objPost->id);

            if($numafects==0) echo "No se elimino ningun registro";
            else echo '1';
        }catch(Throwable $ex){
            http_response_code(500);
            echo $ex . ",No se pudo modificar";
        }
    }
}
