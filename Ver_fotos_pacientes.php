<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Paciente</title>
</head>
<body>
    <form action="" method="POST">
        <label for="id_paciente">Número de control paciente:</label>
      
        <input type="text" id="id_paciente" name="id_paciente" required>
        <button name="buttonn" type="submit">Buscar fotos de paciente</button>
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buttonn'])) {
        include("conn.php");
        
        $id_p = $_POST['id_paciente'];
        $carpeta = "imagenes_p/"; 

        $sql = "SELECT imagen FROM imagenes WHERE id_paciente = $id_p";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<br>Fotos del paciente encontradas:<br><br>";
            $suma=0;
           
            while($fila = $resultado->fetch_assoc()) {
                $nombre_archivo = $fila['imagen']; 
                $suma=$suma+1;
                echo "Imagen ". $suma ."<br><br>"; 
                echo "<img src='" . $nombre_archivo . "' alt='Imagen del paciente' width='300'>";
                echo "<br> <br>";
            }
        } else {
            echo "<br>Este paciente no tiene imágenes registradas.";
        }

        $conn->close();
    }
    ?>
</body>
</html>