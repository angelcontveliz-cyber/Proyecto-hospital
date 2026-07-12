<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Receta</title>
</head>
<body>
    <?php 
    session_start();
    include("conn.php"); 
    ?>
    
    <form action="" method="POST">
        
        <label for="nombre_M">Medicamento</label>
        <input type="text" name="nombre_M" id="nombre_M" required>
        
        <label for="cantidad">Cantidad</label>
        <input type="text" name="cantidad" id="cantidad" required>
        
        <button type="submit" name="btn1">Insertar Medicamento en receta</button>
    </form>

    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn1'])){

        $Nombre_M = $_POST['nombre_M'];
        $cantidad = $_POST['cantidad'];

        
        $Recu = "SELECT id_medicamento FROM medicamentos WHERE nombre = '$Nombre_M'";
        
        
        $Resultado = $conn->query($Recu);

        if($Resultado && $Resultado->num_rows > 0){
            
            
            $id_del_Medicamento = $Resultado->fetch_column();
            
            
            $Inse = $conn->prepare("INSERT INTO detalle_receta(id_receta, id_medicamento, cantidad) VALUES (?,?,?)");
            
            
            $Inse->bind_param("iis", $_SESSION['id_reseta'], $id_del_Medicamento, $cantidad);
            
            
            if($Inse->execute()){
                echo "Medicameto insertado en la recesta";
            } else {
                echo "Error al guardar: " . $Inse->error;
            }
            
            $Inse->close();

        } else {
            echo "No se encontró ningún medicamento con ese nombre.";
        }
    }
    ?>
</body>
</html>