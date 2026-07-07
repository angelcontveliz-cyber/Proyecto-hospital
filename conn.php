<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "proyecto_hospital";

$conn =new mysqli
 ($host, $user, $password, $database);

if ($conn-> connect_error){
    die("Conexion no exitosa;". $conn->connect_error);

}

$conn->set_charset("utf8mb4");

 ?>
 <br>
 