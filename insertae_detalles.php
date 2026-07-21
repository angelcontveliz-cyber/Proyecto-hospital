<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Receta</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0;">
    <?php 
    session_start();
    include("conn.php"); 
    ?>
    
    <div class="table-container" style="width: 100%; max-width: 500px; box-sizing: border-box;">
        <h3 style="text-align: center;">📋 Agregar Medicamentos a la Receta</h3>

        <form action="" method="POST">
            <label for="nombre_M">Nombre o parte del Medicamento:</label>
            <input type="text" name="nombre_M" id="nombre_M" required placeholder="Ej. Paracetamol" style="width: 100%; box-sizing: border-box;">
            
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required style="width: 100%; box-sizing: border-box;">
            
            <button type="submit" name="btn1" style="width: 100%; margin-top: 10px;">Insertar Medicamento en receta</button>
            
            <button type="button" onclick="window.location.href='Medico.php';" style="width: 100%; background:#6c757d; cursor:pointer; margin-top: 10px;">Terminar y Volver a Médico</button>
        </form>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn1'])){

            $Nombre_M = trim($_POST['nombre_M']);
            $cantidad = intval($_POST['cantidad']);

            // Usamos LIKE con comodines '%' para buscar todas las coincidencias parecidas
            $busqueda_nombre = "%" . $Nombre_M . "%";
            
            // Traemos también el gramaje y el precio para mostrarlos en pantalla
            $Recu = $conn->prepare("SELECT id_medicamento, nombre, gramaje, precio FROM medicamentos WHERE nombre LIKE ?");
            $Recu->bind_param("s", $busqueda_nombre);
            $Recu->execute();
            $Resultado = $Recu->get_result();

            if($Resultado && $Resultado->num_rows > 0){
                
                // Si quieres que agarre el primero que coincida automáticamente:
                $fila_med = $Resultado->fetch_assoc();
                $id_del_Medicamento = $fila_med['id_medicamento'];
                $nombre_encontrado = $fila_med['nombre'];
                $gramaje_encontrado = $fila_med['gramaje'];
                $precio_encontrado = $fila_med['precio'];
                

                $Inse = $conn->prepare("INSERT INTO detalle_receta(id_receta, id_medicamento, cantidad) VALUES (?, ?, ?)");
                $Inse->bind_param("iii", $_SESSION['id_reseta'], $id_del_Medicamento, $cantidad);
                
                if($Inse->execute()){
                    echo "<div style='background: #e2f0d9; padding: 10px; margin-top: 15px; border-radius: 5px; text-align: center;'>";
                    echo "<p style='color:green; margin:0;'>¡Agregado con éxito!</p>";
                    echo "<p style='margin:5px 0 0 0;'><strong>$nombre_encontrado</strong> ($gramaje_encontrado) - Cantidad: $cantidad (Precio Unit: $$precio_encontrado)</p>";
                    echo "</div>";
                } else {
                    echo "<p style='color:red; margin-top:10px; text-align:center;'>Error al guardar: " . $Inse->error . "</p>";
                }
                
                $Inse->close();

            } else {
                echo "<p style='color:red; margin-top:10px; text-align:center;'>No se encontró ningún medicamento con el nombre '<strong>$Nombre_M</strong>'.</p>";
            }
            $Recu->close();
        }
        ?>
    </div>
</body>
</html>