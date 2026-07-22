<?php 
include ('conn.php'); 
session_start(); 


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Gestión Hospitalaria</title>
</head>
<body>

    <?php
    $opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 0;

    switch($opcion){
        case 1: 
            ?>
            <form action="" method="POST">
    <h3>👤 Agregar Usuario</h3>
    
    <label for="nombre">Nombre:</label> 
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="contrasena">Contraseña:</label> 
    <input type="password" id="contrasena" name="contrasena" required>
    
    <label for="estado">Estado:</label> 
    <select name="estado" id="estado" required>
        <option value="Activo">Activo</option>
        <option value="Baja">Baja</option>
    </select>
    
    <label for="id_rol">ID de Rol:</label> 
    <select name="id_rol" id="rol" required>
        <option value="1">Administrador</option>
        <option value="2">Medico</option>
        <option value="3">Paciente</option>
        <option value="4">Almacenista</option>
        <option value="5">Secretaria</option>
    </select>
    
    <button type="submit" name="btn_guardar">Agregar usuario</button>
    
    <?php
   
    switch($_SESSION['rol']){
        case 1:
            echo "<a href='Admin.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
            break;
        case 2:
            echo "<a href='Medico.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
            break;
        default:
            echo "<a href='Pacientes.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
            break;
    }
    ?>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $id_rol = $_POST['id_rol'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena, id_rol, estado) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nombre, $contrasena, $id_rol, $estado);
    
    if ($stmt->execute()) {
        if($id_rol == 2) { 
            $_SESSION['id_us'] = $conn->insert_id; 
            echo "<script>window.location.href='?opcion=2';</script>"; 
        } else { 
            echo "
            <script>
                alert('Usuario Guardado');
                window.location.href = 'Admin.php';
            </script>
            ";
        }
    } else {
        echo "<p style='text-align:center; color:red;'>Error al guardar: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

            break;

        case 2: 
            ?>
            <form action="" method="POST">
    <h3>👨‍⚕️ Agregar Médico</h3>
    
    <label for="id_usuario">ID de Usuario:</label> 
    <input type="number" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_us'] ?? ''; ?>" required>
    
    <label for="Nombre">Nombre Médico:</label> 
    <input type="text" id="Nombre" name="Nombre" required>
    
    <label for="id_especialidad">ID Especialidad:</label> 
    <input type="number" id="id_especialidad" name="id_especialidad" required>
    
    <label for="id_consultorio">ID de Consultorio:</label> 
    <input type="number" id="id_consultorio" name="id_consultorio" required>
    
    <button type="submit" name="Guardar">Agregar Médico</button>
    
    <?php
   
    switch($_SESSION['rol']){
        case 1:
            echo "<a href='Admin.php'><button type='button' style='background:#6c757d; margin-top:10px;'>Regresar</button></a>";
            break;
        case 2:
            echo "<a href='Medico.php'><button type='button' style='background:#6c757d; margin-top:10px;'>Regresar</button></a>";
            break;
        default:
            echo "<a href='Pacientes.php'><button type='button' style='background:#6c757d; margin-top:10px;'>Regresar</button></a>";
            break;
    }
    ?>
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Guardar'])) {
    $id_usuario = $_POST['id_usuario'];
    $nombre_medico = $_POST['Nombre'];
    $id_especialidad = $_POST['id_especialidad'];
    $id_consultorio = $_POST['id_consultorio'];

    $stmt = $conn->prepare("INSERT INTO medicos (id_usuario, nombre, id_especialidad, id_consultorio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $id_usuario, $nombre_medico, $id_especialidad, $id_consultorio);
    
    if ($stmt->execute()) { 
        unset($_SESSION['id_us']); 
        echo "
        <script>
            alert('Medico Guardado');
            window.location.href = 'Admin.php';
        </script>
        ";
    } else {
        echo "<p style='color:red; text-align:center;'>Error al guardar: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

            break;

        case 3:
            ?>
            <form action="" method="POST">
                <h3>🏥 Agregar Paciente</h3>
                <label for="Nombre">Nombre:</label> 
                <input type="text" id="Nombre" name="Nombre" required>
                
                <label for="Telefono">Teléfono:</label> 
                <input type="text" id="Telefono" name="Telefono" required>
                
                <label for="Direccion">Dirección:</label> 
                <input type="text" id="Direccion" name="Direccion" required>
                
                <label for="fecha">Fecha de nacimiento:</label> 
                <input type="date" id="fecha" name="fecha" required>
                
                <label for="estado">Estado:</label> 
                <select name="estado" id="estado" required>
                    <option value="Activo">Activo</option>
                    <option value="Baja">Baja</option>
                </select>
                
                <button type="submit" name="btn_guardar">Agregar Paciente</button>
               <?php
                switch($_SESSION['rol']){

                case 1:
               ?> <a href='Admin.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php
                break;
                case 2:
                ?> <a href='Medico.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php break;
                default:
               ?> <a href='Secretaria.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php 
                break;
    }?>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
                $nombre_paciente = $_POST['Nombre'];
                $telefono = $_POST['Telefono'];
                $direccion = $_POST['Direccion'];
                $fecha_nac = $_POST['fecha'];
                $estado_pac = $_POST['estado'];

                $stmt = $conn->prepare("INSERT INTO pacientes(nombre, telefono, direccion, fecha_nacimiento, estado) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sssss", $nombre_paciente, $telefono, $direccion, $fecha_nac, $estado_pac);
                
                if($stmt->execute()){ 
                    echo "<p style='text-align:center; color:green;'>Paciente registrado.</p>"; 
                }
                $stmt->close();
            }
            break;

       case 4: 
    ?>
    <div class="table-container">
        <h3>💊 Registrar Nuevo Medicamento Base</h3>
        
        <form action="" method="POST">
            <label for="nombre">Nombre del Medicamento:</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Ej. Paracetamol"><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="3" required style="width:100%;"></textarea><br><br>

            <label for="gramaje">Gramaje / Concentración:</label>
            <input type="text" name="gramaje" id="gramaje" required placeholder="Ej. 500 mg"><br><br>

            <label for="precio">Precio Unitario ($):</label>
            <input type="number" step="0.01" name="precio" id="precio" min="0" required placeholder="0.00"><br><br>

            <button type="submit" name="registrar_medicamento" style="background: #28a745; width: 100%;">Guardar Medicamento</button>
        </form>

        <?php
      

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_medicamento'])) {
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);
            $gramaje = trim($_POST['gramaje']);
            $precio = floatval($_POST['precio']);

            $stmt = $conn->prepare("INSERT INTO medicamentos (nombre, descripcion, gramaje, precio) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssd", $nombre, $descripcion, $gramaje, $precio);

            if ($stmt->execute()) {
                echo "<p style='color: green; margin-top: 15px; text-align: center;'>¡Medicamento <strong>$nombre</strong> registrado con éxito en el catálogo!</p>";
            } else {
                echo "<p style='color: red; margin-top: 15px;'>Error al registrar: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
        ?>
        
        <form style="margin-top: 20px;">
            <a href='Almacenista.php'><button type='button' style="width: 100%; background: #6c757d;">Regresar</button></a>
        </form>
    </div>

<?php
break; 

        case 5: 
            ?>
   <form action="" method="POST">
    <h3>📅 Crear Cita</h3>

    <label>Número de identificación del paciente:</label>
    <input type="number" name="id_p" required>

    <label>Número de control del médico:</label>
    <input type="number" name="id_m" required>

    <label>Fecha de la cita:</label>
    <input type="date" name="fecha" required>

    <label>Hora de la cita:</label>
    <input type="time" name="hora" required>

    <label>Fecha de registro:</label>
    <input type="date" name="fecha_r" required>

    <button type="submit" name="butonn1">Insertar cita</button>

    <?php
    switch($_SESSION['rol']){

        case 1:
            echo "<a href='Admin.php'><button type='button'>Regresar</button></a>";
            break;

        case 2:
            echo "<a href='Medico.php'><button type='button'>Regresar</button></a>";
            break;

        default:
            echo "<a href='Secretaria.php'><button type='button'>Regresar</button></a>";
            break;
    }
    ?>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['butonn1'])) {

    $id_paciente = $_POST['id_p'];
    $id_medico = $_POST['id_m'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $fecha_registro = $_POST['fecha_r'];
    $estado = "Activo";

    $stmt = $conn->prepare("INSERT INTO citas(id_paciente,id_medico,fecha,hora,estado,fecha_registro)
                            VALUES(?,?,?,?,?,?)");

    $stmt->bind_param(
        "iissss",
        $id_paciente,
        $id_medico,
        $fecha,
        $hora,
        $estado,
        $fecha_registro
    );

    if($stmt->execute()){
$id_ci = $conn->insert_id;
$_SESSION['id_cita']=$id_ci;
echo "<script>
        alert('Cita creada correctamente. ID de la cita: $id_ci');
        window.location.href='Update_Insert_select.php?opcion=5';
      </script>";

    }else{

        echo "<script>
                alert('Error: ".$stmt->error."');
              </script>";

    }

    $stmt->close();
}
            break;

        case 6: 
    
    ?>
    <form action="" method="post">
    <label for="id_Cita">Numero de control de cita</label>
    <input type="text" id="id_Cita" name="id_Cita" required>
    
    <label for="fecha">Fecha de creacion</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="precio_cita">Precio de la Consulta / Cita</label>
    <input type="number" step="0.01" id="precio_cita" name="precio_cita" required min="0">
    
    <button type="submit" name="etesech">Crear receta</button>
    
    <?php
    switch($_SESSION['rol']){
        case 1:
            echo "<a href='Admin.php'><button type='button'>Regresar</button></a>";
            break;
        case 2:
            echo "<a href='Medico.php'><button type='button'>Regresar</button></a>";
            break;
        default:
            echo "<a href='Pacientes.php'><button type='button'>Regresar</button></a>";
            break;
    }
    ?>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['etesech'])) {
    
    $id_Cita = $_POST['id_Cita'];
    $fecha = $_POST['fecha'];
    $precio_cita = $_POST['precio_cita'];
    $estador = "Activo";
    
    $stmt_select = $conn->prepare("SELECT id_cita FROM citas WHERE id_cita = ?");
    $stmt_select->bind_param("i", $id_Cita);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    if ($resultado->num_rows > 0) {
        
        // Insertamos la receta incluyendo el precio de la cita especificado por el doctor
        $stmt_insert = $conn->prepare("INSERT INTO recetas (id_cita, fecha, estado, precio_cita) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("issd", $id_Cita, $fecha, $estador, $precio_cita);
        
        if($stmt_insert->execute()){
            $_SESSION['id_reseta'] = $conn->insert_id; 
            
            echo "
            <script>
                alert('Receta creada');
                window.location.href='insertae_detalles.php';
            </script>
            ";
        }
        $stmt_insert->close();
        
    } else {
        $ruta_destino = ($_SESSION['rol'] == 1) ? 'Admin.php' : 'Medico.php';
        
        echo "
        <script>
            alert('No hay una cita existente');
            window.location.href='$ruta_destino';
        </script>
        ";
    }
    $stmt_select->close();
}
break; 

 case 7:
?>


<form action="" method="POST">
    <label for="id_reseta">Inserte el numero de receta</label>
    <input type="number" id="id_reseta" name="id_reseta" required>
    <button type="submit" name="btn_consultar">Ver Detalles y Precios</button>
    
   <?php
    switch($_SESSION['rol']){
        case 1:
            echo "<a href='Admin.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
            break;
        case 5:
            echo "<a href='Almacenista.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
            break;
    }
   ?>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_consultar'])) {
    $id_reseta = $_POST['id_reseta'];

    $comprobar = $conn->prepare("SELECT estado, precio_cita FROM recetas WHERE id_receta = ?");
    $comprobar->bind_param("i", $id_reseta);
    $comprobar->execute();
    $comprobare = $comprobar->get_result();

    if ($comprobare->num_rows > 0) {
        $fila = $comprobare->fetch_assoc();
        $estado = $fila['estado'];
        $precio_cita = floatval($fila['precio_cita']);

        echo "<div style='background: #f8f9fa; padding: 15px; margin-top: 15px; border-radius: 8px; border: 1px solid #ddd;'>";
        echo "<h3>🧾 Detalles de la Receta #" . $id_reseta . " (Estado: <strong>" . $estado . "</strong>)</h3>";

        
        $nose = $conn->prepare("
            SELECT dr.cantidad, dr.id_medicamento, m.nombre, m.gramaje, m.precio 
            FROM detalle_receta dr
            INNER JOIN medicamentos m ON dr.id_medicamento = m.id_medicamento
            WHERE dr.id_receta = ?
        ");
        $nose->bind_param("i", $id_reseta);
        $nose->execute();
        $cambio = $nose->get_result();

        $subtotal_medicamentos = 0;
        echo "<ul>";
        if ($cambio->num_rows > 0) {
            while ($fila_det = $cambio->fetch_assoc()) {
                $cantidad = $fila_det['cantidad'];
                $nombre_med = $fila_det['nombre'];
                $gramaje = $fila_det['gramaje'];
                $precio_unitario = floatval($fila_det['precio']);
                
                $costo_parcial = $cantidad * $precio_unitario;
                $subtotal_medicamentos += $costo_parcial;

                echo "<li>Medicamento: <strong>" . $nombre_med . "</strong> (" . $gramaje . ") | Cantidad: " . $cantidad . " | Precio Unitario: $" . $precio_unitario . " | <strong>Subtotal: $" . $costo_parcial . "</strong></li>";
            }
        } else {
            echo "<li>No hay medicamentos registrados en esta receta.</li>";
        }
        echo "</ul>";

        $total_general = $subtotal_medicamentos + $precio_cita;

        echo "<hr>";
        echo "<p><strong>Subtotal de Medicamentos:</strong> $" . $subtotal_medicamentos . "</p>";
        echo "<p><strong>Precio de la Consulta / Cita médica:</strong> $" . $precio_cita . "</p>";
        echo "<h3 style='color: #007bff;'>TOTAL ESTIMADO A PAGAR: $" . $total_general . "</h3>";

        // Si la receta está activa, mostramos el botón para proceder al pago
        if ($estado == "Activo") {
            echo "<form action='' method='POST' style='margin-top: 15px;'>";
            echo "<input type='hidden' name='id_reseta_pagar' value='" . $id_reseta . "'>";
            echo "<button type='submit' name='btn_pagar' style='background: #28a745; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 4px;'>Confirmar y Pagar Receta</button>";
            echo "</form>";
        } else {
            echo "<p style='color: orange; font-weight: bold;'>Esta receta ya se encuentra en estado: " . $estado . "</p>";
        }
        echo "</div>";

    } else {
        echo "<script>alert('Este ID de receta no existe');</script>";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_pagar'])) {
    $id_reseta = $_POST['id_reseta_pagar'];

    
    $estadoC = $conn->prepare("UPDATE recetas SET estado='Pagado' WHERE id_receta=?");
    $estadoC->bind_param("i", $id_reseta);
    $estadoC->execute();
    $estadoC->close();

    
    $nose = $conn->prepare("SELECT id_medicamento, cantidad FROM detalle_receta WHERE id_receta=?");
    $nose->bind_param("i", $id_reseta);
    $nose->execute();
    $cambio = $nose->get_result();

    if ($cambio->num_rows > 0) {
        while ($fila = $cambio->fetch_assoc()) {
            $cantidad_a_descontar = $fila['cantidad'];
            $id_M = $fila['id_medicamento'];

            // Buscamos los lotes disponibles de este medicamento (ordenados por fecha de caducidad para usar primero los que estén por vencer)
            $stmt_lotes = $conn->prepare("SELECT id_inventario, existencia FROM inventario WHERE id_medicamento = ? AND existencia > 0 ORDER BY fecha_cadu ASC");
            $stmt_lotes->bind_param("i", $id_M);
            $stmt_lotes->execute();
            $res_lotes = $stmt_lotes->get_result();

            while ($lote = $res_lotes->fetch_assoc()) {
                if ($cantidad_a_descontar <= 0) break;

                $id_inventario = $lote['id_inventario'];
                $stock_lote = $lote['existencia'];

                if ($stock_lote >= $cantidad_a_descontar) {
                    // Si el lote tiene suficiente stock, le restamos todo lo que falta
                    $nuevo_stock = $stock_lote - $cantidad_a_descontar;
                    $update = $conn->prepare("UPDATE inventario SET existencia = ? WHERE id_inventario = ?");
                    $update->bind_param("ii", $nuevo_stock, $id_inventario);
                    $update->execute();
                    $update->close();
                    $cantidad_a_descontar = 0;
                } else {
                    // Si el lote no alcanza, consumimos el lote completo y pasamos al siguiente
                    $cantidad_a_descontar -= $stock_lote;
                    $update = $conn->prepare("UPDATE inventario SET existencia = 0 WHERE id_inventario = ?");
                    $update->bind_param("i", $id_inventario);
                    $update->execute();
                    $update->close();
                }
            }
            $stmt_lotes->close();
        }
    }

    echo "<script>
        alert('¡Receta pagada con éxito e inventario de lotes actualizado!');
        window.location.href = window.location.href;
    </script>";
}

break;

default:

switch ($_SESSION['rol']) {

    case 1:
        echo "
        <script>
            alert('No tiene permiso para ver esta página');
            window.location.href='Admin.php';
        </script>
        ";
        exit();

    case 2:
        echo "
        <script>
            alert('No tiene permiso para ver esta página');
            window.location.href='Medico.php';
        </script>
        ";
        
        break;
        case 4:
        echo "
        <script>
            alert('No tiene permiso para ver esta página');
            window.location.href='Almacenista.php';
        </script>
        ";
      break;
    default:
    echo "lol";

    break;
}



}
?>
</body>
</html>