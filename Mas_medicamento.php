<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Lote de Medicamento</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="table-container">
        <h3>📦 Registrar Entrada / Nuevo Lote</h3>
        
        <?php
        

        <form action="" method="POST">
            <label for="nombre_busqueda">Buscar Medicamento (Catálogo):</label>
            <input type="text" name="nombre_busqueda" id="nombre_busqueda" list="lista_medicamentos" autocomplete="off" required placeholder="Ej. Paracetamol"><br><br>

            <!-- Datalist para el autocompletado automático -->
            <datalist id="lista_medicamentos">
                <?php
                $query_nombres = "SELECT nombre FROM medicamentos ORDER BY nombre ASC";
                $res_nombres = $conn->query($query_nombres);
                
                if ($res_nombres && $res_nombres->num_rows > 0) {
                    while ($row_nombre = $res_nombres->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($row_nombre['nombre']) . '">';
                    }
                }
                ?>
            </datalist>

            <label for="lote">Número de Lote:</label>
            <input type="text" name="lote" id="lote" required><br><br>

            <label for="cantidad">Cantidad Recibida:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required><br><br>

            <label for="proveedor">Proveedor:</label>
            <input type="text" name="proveedor" id="proveedor" required><br><br>

            <label for="fecha_entrada">Fecha de Entrada:</label>
            <input type="date" name="fecha_entrada" id="fecha_entrada" required><br><br>

            <label for="fecha_cadu">Fecha de Caducidad:</label>
            <input type="date" name="fecha_cadu" id="fecha_cadu" required><br><br>

            <button type="submit" name="registrar_lote" style="background: #17a2b8; width: 100%;">Guardar Lote en Inventario</button>
        </form>

        <?php
        // Procesamiento del formulario al enviar
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_lote'])) {
            $nombre_busqueda = "%" . trim($_POST['nombre_busqueda']) . "%";
            $lote = trim($_POST['lote']);
            $cantidad = intval($_POST['cantidad']);
            $proveedor = trim($_POST['proveedor']);
            $fecha_entrada = $_POST['fecha_entrada'];
            $fecha_cadu = $_POST['fecha_cadu'];

            $stmt_check = $conn->prepare("SELECT id_medicamento, nombre FROM medicamentos WHERE nombre LIKE ?");
            $stmt_check->bind_param("s", $nombre_busqueda);
            $stmt_check->execute();
            $resultado = $stmt_check->get_result();

            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $id_medicamento = $fila['id_medicamento'];
                $nombre_med = $fila['nombre'];

                $stmt_insert = $conn->prepare("INSERT INTO inventario (id_medicamento, existencia, lote, proveedor, fecha_entrada, fecha_cadu) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("iissss", $id_medicamento, $cantidad, $lote, $proveedor, $fecha_entrada, $fecha_cadu);

                if ($stmt_insert->execute()) {
                    echo "<p style='color: green; margin-top: 15px; text-align: center;'>¡Lote <strong>$lote</strong> registrado para <strong>$nombre_med</strong>!</p>";
                } else {
                    echo "<p style='color: red; margin-top: 15px;'>Error al registrar el lote.</p>";
                }
                $stmt_insert->close();
            } else {
                echo "<p style='color: red; margin-top: 15px; text-align: center;'>Medicamento no encontrado en el catálogo. Regístralo primero.</p>";
            }
            $stmt_check->close();
        }
        ?>
        <form style="margin-top: 20px;">
            <a href='Almacenista.php'><button type='button' style="width: 100%; background: #6c757d;">Regresar</button></a>
        </form>
    </div>
</body>
</html>