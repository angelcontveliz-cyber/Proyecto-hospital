<?php
$carpeta = "imagenes_p/";
include('conn.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnM'])){

    if(isset($_FILES['Imagen'])){
        $id_paciente=$_POST['id_p'];
        $nombre = basename($_FILES['Imagen']['name']);
        $rutadestino = $carpeta . $nombre;

        if(move_uploaded_file($_FILES['Imagen']['tmp_name'], $rutadestino)){
            $sql = "INSERT INTO imagenes (id_paciente, imagen) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $id_paciente, $rutadestino);

            if($stmt->execute()){
                echo "Foto del paciente guardada.<br>";
                echo "<img src='$rutadestino' width='250'>";
            }else{
                echo "Error al guardar en la base de datos: " . $stmt->error;
            }

            $stmt->close();

        }else{
            echo "Error al subir la imagen.";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Imagen</title>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="Imagen">Inserte imagen</label>
    <input type="file" name="Imagen" id="Imagen" accept="image/*" required>
    <label for="id_p">Inserte id del paciente<label>
        <input type="text" name="id_p" id="id_p" requiered>
    <button type="submit" name="btnM">Insertar imagen</button>
</form>

</body>
</html>

