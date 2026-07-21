<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Medicamentos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="table-container">
        <h3>💊 Modificar Existencia de Medicamentos</h3>
        
        <form action="" method="POST">
            <label for="nombre_busqueda">Nombre del Medicamento:</label>
            <input type="text" name="nombre_busqueda" id="nombre_busqueda" required placeholder="Ej. Paracetamol"><br><br>

            <label for="tipo_operacion">Acción:</label>
            <select name="tipo_operacion" id="tipo_operacion" required>
                <option value="agregar">Agregar existencia (Poner)</option>
                <option value="quitar">Quitar existencia</option>
            </select><br><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required><br><br>

            <button type="submit" name="actualizar_stock">Actualizar Existencia</button>
        </form>

        <?php
        include ("conn.php");
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_stock'])) {
            $nombre_busqueda = "%" . trim($_POST['nombre_busqueda']) . "%";
            $tipo_operacion = $_POST['tipo_operacion'];
            $cantidad = intval($_POST['cantidad']);

            // Buscamos el medicamento usando LIKE
            $stmt_check = $conn->prepare("SELECT id_medicamento, existencia, nombre FROM medicamentos WHERE nombre LIKE ?");
            $stmt_check->bind_param("s", $nombre_busqueda);
            $stmt_check->execute();
            $resultado = $stmt_check->get_result();

            if ($resultado->num_rows > 0) {
                // Si encuentra coincidencia, tomamos el primero que coincida
                $fila = $resultado->fetch_assoc();
                $id_medicamento = $fila['id_medicamento'];
                $existencia_actual = $fila['existencia'];
                $nombre_med = $fila['nombre'];

                if ($tipo_operacion === 'agregar') {
                    $nueva_existencia = $existencia_actual + $cantidad;
                } else {
                    $nueva_existencia = $existencia_actual - $cantidad;
                    if ($nueva_existencia < 0) {
                        $nueva_existencia = 0;
                    }
                }

                $stmt_update = $conn->prepare("UPDATE medicamentos SET existencia = ? WHERE id_medicamento = ?");
                $stmt_update->bind_param("ii", $nueva_existencia, $id_medicamento);

                if ($stmt_update->execute()) {
                    echo "<p style='color: green; margin-top: 15px;'>¡Stock actualizado con éxito para <strong>$nombre_med</strong>! Nueva existencia: $nueva_existencia.</p>";
                } else {
                    echo "<p style='color: red; margin-top: 15px;'>Error al actualizar la base de datos.</p>";
                }
                $stmt_update->close();
            } else {
                echo "<p style='color: red; margin-top: 15px;'>No se encontró ningún medicamento con ese nombre.</p>";
            }
            $stmt_check->close();
        }

        $sql_tabla = "SELECT id_medicamento, nombre, descripcion, existencia FROM medicamentos";
        $res_tabla = $conn->query($sql_tabla);
        ?>

        <hr style="margin: 25px 0;">

        <h3>📦 Lista de Medicamentos</h3>
        
        <?php if ($res_tabla && $res_tabla->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Existencia Actual</th>
                </tr>
                <?php while ($med = $res_tabla->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $med['id_medicamento']; ?></td>
                        <td><?php echo $med['nombre']; ?></td>
                        <td><?php echo $med['descripcion']; ?></td>
                        <td><strong><?php echo $med['existencia']; ?></strong></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay medicamentos registrados en la base de datos.</p>
        <?php endif; ?>

        <form style="margin-top: 20px;">
            <a href='Almacenista.php'><button type='button'>Regresar</button></a>
        </form>
    </div>
</body>
</html>