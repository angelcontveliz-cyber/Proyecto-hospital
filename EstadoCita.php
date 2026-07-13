<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="id_cita">Introdusca el numero de control de la cita</label>
        <input type="num" name="id_cita" id="id_cita" requiered>
        <button type="submit" name="butoonC">Cita ya terminada</button>
</form>
<?php
include ("conn.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buttonC'])){
    $id_cita=$POST['id_cita'];
    $_SESSION['id_medico'];

    $sql=$conn->prepare("UPDATE")

    
}
</body>
</html>