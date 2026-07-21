<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Receta</title>
</head>
<body>
    <?php 
    session_start();
    include("conn.php"); 
    ?>
    
    <form action="" method="POST">
        <label for="nombre_M">Nombre o parte del Medicamento:</label>
        <input type="text" name="nombre_M" id="nombre_M" required>
        
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" required>
        
        <button type="submit" name="btn1">Insertar Medicamento en receta</button>
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn1'])){

        $Nombre_M = $_POST['nombre_M'];
        $cantidad = $_POST['cantidad'];

        // Usamos LIKE con comodines '%' para buscar coincidencias parciales o totales por nombre
        $busqueda_nombre = "%" . $Nombre_M . "%";
        
        $Recu = $conn->prepare("SELECT id_medicamento, nombre, gramaje FROM medicamentos WHERE nombre LIKE ?");
        $Recu->bind_param("s", $busqueda_nombre);
        $Recu->execute();
        $Resultado = $Recu->get_result();

        if($Resultado && $Resultado->num_rows > 0){
            // Si encuentra una coincidencia exacta o la primera aproximación
            $fila_med = $Resultado->fetch_assoc();
            $id_del_Medicamento = $fila_med['id_medicamento'];
            $nombre_encontrado = $fila_med['nombre'];
            
            // Insertamos en el detalle de la receta
            $Inse = $conn->prepare("INSERT INTO detalle_receta(id_receta, id_medicamento, cantidad) VALUES (?, ?, ?)");
            $Inse->bind_param("iii", $_SESSION['id_reseta'], $id_del_Medicamento, $cantidad);
            
            if($Inse->execute()){
                echo "<p style='color:green;'>Medicamento '$nombre_encontrado' insertado en la receta correctamente.</p>";
            } else {
                echo "<p style='color:red;'>Error al guardar: " . $Inse->error . "</p>";
            }
            
            $Inse->close();

        } else {
            echo "<p style='color:red;'>No se encontró ningún medicamento que coincida con '$Nombre_M'.</p>";
        }
        $Recu->close();
    }
    ?>
</body>
</html>