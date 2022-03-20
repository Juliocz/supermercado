<?php
include_once "../Controlador/Route.php";
include_once "../Controlador/CategoriaController.php";
include_once "../Controlador/ProductoController.php";

/*include_once "../Modelo/MPersona.php";//Incluso clase persona
include_once "../Modelo/ConexionMysql.php";//Incluyo conexion mysql, esto me abre conexion automatico
include_once "../Controlador/PersonaController.php";*/



Route::get("/dashboard",function(){

    include_once "../Vistas/dashboard.php";
});
Route::get("/insertar",function(){
    include_once "../Modelo/MyModel.php";
    //$pc=['nombre','apellido','telefono','direccion','cedula','edad'];
    //$pv=['juan1','perez1','77774456','scz','74511115','29'];

    $pc=['edad'];
    $pv=['50'];

    //echo json_encode(Mymodel::table('persona')->selectFrom()->executeGET());
    //echo Mymodel::table('persona')->insertInto($pc,$pv)->executeInsert();

    echo Mymodel::table('persona')
    ->update($pc,$pv)
    ->where('apellido','Perez')
    ->execute();
    
});


Route::post("/dashboard/registrar_categoria",function(){
    //header('Content-Type: application/json; charset=utf-8');
    $c= new CategoriaController();
    $c->registrar();  
});
Route::post("/dashboard/modificar_categoria",function(){
    $c= new CategoriaController();
    $c->modificar(); 
});
Route::post("/dashboard/eliminar_categoria",function(){
    $c= new CategoriaController();
    $c->eliminar(); 
});

Route::get('/dashboard/get_categoria',function(){
    include_once "../Modelo/Categoria.php";
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(Categoria::getAll());
});

Route::post('/dashboard/registrar_producto',function(){
    $c= new ProductoController();
    $c->registrar();  
});
Route::post('/dashboard/modificar_producto',function(){
    //echo Route::getBody();
    $c= new ProductoController();
    $c->modificar();  
});
Route::post('/dashboard/eliminar_producto',function(){
    $c= new ProductoController();
    $c->eliminar();  
});


Route::get('/dashboard/get_producto',function(){
    include_once "../Modelo/Producto.php";
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(Producto::getAll());
});



Route::eventNotFound();




















/*function POST(){
    PersonaController::registrarPersona();//llamo controlador para registrar persona
}
function GET(){
    include "formulario.html";    //Muestro vista formulario
}*/






/*

//Creo persona de los datos del post
$persona=new MPersona($_POST["nombre"],$_POST["apellido"],$_POST["edad"],$_POST["cedula"],$_POST["direccion"],$_POST["telefono"]);
$persona->save(Conexion::$conn);    //Guardo en la base de datos
Conexion::close();                  //Cierro conexion

*/
/*
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        POST();
        // Boom baby we a POST method
}
   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
       GET();
}*/