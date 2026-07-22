<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitar Existencia de Lotes</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="table-container">
        <h3>📉 Quitar Existencia / Salida de Medicamento por Lote</h3>
        
        <?php
        include ("conn.php");
        session_start();

        $lotes_disponibles = [];
        $nombre_busqueda_actual = "";

        // 1. Si presionan buscar, filtramos los lotes
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_lotes'])) {
            $nombre_busqueda_actual = trim($_POST['nombre_busqueda']);
            $busqueda_sql = "%" . $nombre_busqueda_actual . "%";
            
            $stmt_lotes = $conn->prepare("
                SELECT i.id_inventario, i.lote, i.existencia, i.fecha_cadu, m.nombre 
                FROM inventario i
                INNER JOIN medicamentos m ON i.id_medicamento = m.id_medicamento
                WHERE m.nombre LIKE ? AND i.existencia > 0
            ");
            
            // Verificamos si la tabla existe o si hay error SQL
            if (!$stmt_lotes) {
                echo "<p style='color:red; background:#f8d7da; padding:10px; border-radius:5px;'>❌ Error en la base de datos: " . $conn->error . " (Asegúrate de haber ejecutado el código SQL para crear la tabla 'inventario').</p>";
            } else {
                $stmt_lotes->bind_param("s", $busqueda_sql);
                $stmt_lotes->execute();
                $res_lotes = $stmt_lotes->get_result();

                while ($lote_row = $res_lotes->fetch_assoc()) {
                    $lotes_disponibles[] = $lote_row;
                }
                $stmt_lotes->close();
            }
        }

        // 2. Si presionan confirmar salida
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['procesar_salida'])) {
            $id_inventario = intval($_POST['id_inventario']);
            $cantidad_quitar = intval($_POST['cantidad_quitar']);
            $nombre_busqueda_actual = trim($_POST['nombre_busqueda_oculta']);

            if ($id_inventario > 0) {
                $stmt_inv = $conn->prepare("SELECT existencia, lote FROM inventario WHERE id_inventario = ?");
                $stmt_inv->bind_param("i", $id_inventario);
                $stmt_inv->execute();
                $res_inv = $stmt_inv->get_result();

                if ($res_inv->num_rows > 0) {
                    $fila_inv = $res_inv->fetch_assoc();
                    $stock_actual = $fila_inv['existencia'];
                    $nombre_lote = $fila_inv['lote'];

                    $nuevo_stock = $stock_actual - $cantidad_quitar;
                    if ($nuevo_stock < 0) {
                        $nuevo_stock = 0; // Evitamos números negativos
                    }

                    $stmt_upd = $conn->prepare("UPDATE inventario SET existencia = ? WHERE id_inventario = ?");
                    $stmt_upd->bind_param("ii", $nuevo_stock, $id_inventario);

                    if ($stmt_upd->execute()) {
                        echo "<div style='background: #e2f0d9; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;'>";
                        echo "<p style='color: green; margin:0;'>¡Stock actualizado con éxito!</p>";
                        echo "<p style='margin:5px 0 0 0;'>Se quitaron <strong>$cantidad_quitar</strong> unidades al lote <strong>$nombre_lote</strong>. Stock restante: $nuevo_stock.</p>";
                        echo "</div>";
                    } else {
                        echo "<p style='color: red; margin-bottom: 15px;'>Error al actualizar el inventario.</p>";
                    }
                    $stmt_upd->close();
                }
                $stmt_inv->close();
            }

            // Volvemos a cargar los lotes actualizados
            if (!empty($nombre_busqueda_actual)) {
                $busqueda_sql = "%" . $nombre_busqueda_actual . "%";
                $stmt_lotes = $conn->prepare("
                    SELECT i.id_inventario, i.lote, i.existencia, i.fecha_cadu, m.nombre 
                    FROM inventario i
                    INNER JOIN medicamentos m ON i.id_medicamento = m.id_medicamento
                    WHERE m.nombre LIKE ? AND i.existencia > 0
                ");
                if ($stmt_lotes) {
                    $stmt_lotes->bind_param("s", $busqueda_sql);
                    $stmt_lotes->execute();
                    $res_lotes = $stmt_lotes->get_result();
                    while ($lote_row = $res_lotes->fetch_assoc()) {
                        $lotes_disponibles[] = $lote_row;
                    }
                    $stmt_lotes->close();
                }
            }
        }
        ?>

        <!-- FORMULARIO 1: Solo para buscar -->
        <form action="" method="POST">
            <label for="nombre_busqueda">Nombre del Medicamento:</label>
            <input type="text" name="nombre_busqueda" id="nombre_busqueda" required placeholder="Ej. Paracetamol" value="<?php echo htmlspecialchars($nombre_busqueda_actual); ?>"><br><br>

            <button type="submit" name="buscar_lotes" style="background: #17a2b8; width: 100%;">1. Buscar Lotes</button>
        </form>

        <hr style="margin: 20px 0;">

        <!-- FORMULARIO 2: Solo para seleccionar lote y quitar stock -->
        <form action="" method="POST">
            <input type="hidden" name="nombre_busqueda_oculta" value="<?php echo htmlspecialchars($nombre_busqueda_actual); ?>">

            <label for="id_inventario">Seleccione el Lote:</label>
            <select name="id_inventario" id="id_inventario" required>
                <option value="">-- Seleccione un lote --</option>
                <?php 
                if (!empty($lotes_disponibles)) {
                    foreach ($lotes_disponibles as $lote_row) {
                        echo "<option value='" . $lote_row['id_inventario'] . "'>Lote: " . $lote_row['lote'] . " | Stock: " . $lote_row['existencia'] . " | Caduca: " . $lote_row['fecha_cadu'] . "</option>";
                    }
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_lotes'])) {
                    echo "<option value=''>No se encontraron lotes con existencia.</option>";
                }
                ?>
            </select><br><br>

            <label for="cantidad_quitar">Cantidad a Quitar:</label>
            <input type="number" name="cantidad_quitar" id="cantidad_quitar" min="1" required><br><br>

            <button type="submit" name="procesar_salida" style="background: #dc3545; width: 100%;">2. Confirmar y Quitar Stock</button>
        </form>

        <form style="margin-top: 20px;">
            <a href='Almacenista.php'><button type='button' style="width: 100%; background: #6c757d;">Regresar</button></a>
        </form>
    </div>
</body>
</html>