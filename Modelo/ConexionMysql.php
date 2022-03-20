<?php
$servername = "localhost";
$database = "supermercado";
$username = "root";
$password = "";
// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
Conexion::$conn=$conn;
if (!$conn) {
    //die("Connection failed: " . mysqli_connect_error());
    throw new Exception("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);

class Conexion{
    public static $conn;
    public static function close(){
        self::$conn->close();
    }
    
}
?>