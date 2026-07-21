<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="id_cita">Introduzca el numero de control de la cita</label>
        <input type="number" name="id_cita" id="id_cita" required>
        <button type="submit" name="buttonC">Cita ya terminada</button>
    </form>

<?php
include ("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buttonC'])){
    $id_cita = $_POST['id_cita'];
    $id_medico = $_SESSION['id_medico']; 

    
    $sql = $conn->prepare("UPDATE citas SET estado = 'Terminado' WHERE id_cita = ? AND id_medico = ?");
    $sql->bind_param("ii", $id_cita, $id_medico);

    if($sql->execute()){
        if($sql->affected_rows > 0){
            echo "<p style='color: green;'>¡La cita se ha actualizado a Terminada con éxito!</p>";
        } else {
            echo "<p style='color: red;'>No se encontró la cita o no corresponde a este médico.</p>";
        }
    } else {
        echo "<p style='color: red;'>Error al actualizar la cita: " . $sql->error . "</p>";
    }

    $sql->close();
}
?>
</body>
</html>