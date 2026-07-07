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
        case 1: // --- INSERTAR USUARIO ---
            ?>
            <form action="" method="POST">
                <h3>👤 Agregar Usuario</h3>
                <label>Nombre:</label> <input type="text" name="nombre" required>
                <label>Contraseña:</label> <input type="password" name="contrasena" required>
                <label>Estado:</label> <input type="text" name="estado" required>
                <label>ID de Rol (1=Admin, 2=Médico):</label> <input type="number" name="id_rol" required>
                <button type="submit" name="btn_guardar">Agregar usuario</button>
                <a href="Admin.php"><button type="button" style="background:#6c757d;">Regresar</button></a>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
                $stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena, id_rol, estado) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssis", $_POST['nombre'], $_POST['contrasena'], $_POST['id_rol'], $_POST['estado']);
                if ($stmt->execute()) {
                    if($_POST['id_rol'] == 2) { $_SESSION['id_us'] = $conn->insert_id; echo "<script>window.location.href='?opcion=2';</script>"; }
                    else { echo "<p class='center' style='color:green;'>Administrador guardado.</p>"; }
                }
                $stmt->close();
            }
            break;

        case 2: // --- INSERTAR MEDICO ---
            ?>
            <form action="" method="POST">
                <h3>👨‍⚕️ Agregar Médico</h3>
                <label>ID de Usuario:</label> 
                <input type="number" name="id_usuario" value="<?php echo $_SESSION['id_us'] ?? ''; ?>" required>
                <label>Nombre Médico:</label> <input type="text" name="Nombre" required>
                <label>ID Especialidad:</label> <input type="number" name="id_especialidad" required>
                <label>ID Consultorio:</label> <input type="number" name="id_consultorio" required>
                <button type="submit" name="Guardar">Agregar Médico</button>
                <a href="Admin.php"><button type="button" style="background:#6c757d;">Regresar</button></a>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Guardar'])) {
                $stmt = $conn->prepare("INSERT INTO medicos (id_usuario, nombre, id_especialidad, id_consultorio) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isii", $_POST['id_usuario'], $_POST['Nombre'], $_POST['id_especialidad'], $_POST['id_consultorio']);
                if ($stmt->execute()) { echo "<p class='center' style='color:green;'>Médico guardado.</p>"; unset($_SESSION['id_us']); }
                $stmt->close();
            }
            break;

        case 3: // --- INSERTAR PACIENTE ---
            ?>
            <form action="" method="POST">
                <h3>🏥 Agregar Paciente</h3>
                <label>Nombre:</label> <input type="text" name="Nombre" required>
                <label>Teléfono:</label> <input type="text" name="Telefono" required>
                <label>Dirección:</label> <input type="text" name="Direccion" required>
                <label>Fecha de nacimiento:</label> <input type="date" name="fecha" required>
                <label>Estado:</label> <input type="text" name="estado" required>
                <button type="submit" name="btn_guardar">Agregar Paciente</button>
                <a href="Admin.php"><button type="button" style="background:#6c757d;">Regresar</button></a>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
                $stmt = $conn->prepare("INSERT INTO pacientes(nombre, telefono, direccion, fecha_nacimiento, estado) VALUES (?,?,?,?,?)");
                $stmt->bind_param("sssss", $_POST['Nombre'], $_POST['Telefono'], $_POST['Direccion'], $_POST['fecha'], $_POST['estado']);
                if($stmt->execute()){ echo "<p class='center' style='color:green;'>Paciente registrado.</p>"; }
                $stmt->close();
            }
            break;

        case 4: // --- MEDICAMENTO ---
            ?>
            <form action="" method="POST">
                <h3>💊 Nuevo Medicamento</h3>
                <label>Nombre:</label> <input type="text" name="Nombre_M" required>
                <label>Descripción:</label> <input type="text" name="Descripcion" required>
                <label>Existencias:</label> <input type="number" name="Existencias" required>
                <button type="submit" name="button1">Ingresar medicamento</button>
                <a href="Admin.php"><button type="button" style="background:#6c757d;">Regresar</button></a>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button1'])) {
                $stmt = $conn->prepare("INSERT INTO medicamentos (nombre, descripcion) VALUES(?,?)");
                $stmt->bind_param("ss", $_POST['Nombre_M'], $_POST['Descripcion']);
                if($stmt->execute()){
                    $K = $conn->insert_id;
                    $stmt1 = $conn->prepare("INSERT INTO inventario (id_medicamento, existencia) VALUES (?,?)");
                    $stmt1->bind_param("ii", $K, $_POST['Existencias']);
                    $stmt1->execute();
                    echo "<p class='center' style='color:green;'>Medicamento e inventario creados.</p>";
                }
            }
            break;

        case 5: // --- CITA ---
            ?>
            <form action="" method="POST">
                <h3>📅 Crear Cita</h3>
                <label>ID Paciente:</label> <input type="number" name="id_p" required>
                <label>ID Médico:</label> <input type="number" name="id_m" required>
                <label>Fecha cita:</label> <input type="date" name="fecha" required>
                <label>Hora:</label> <input type="time" name="hora" required>
                <label>Fecha Registro:</label> <input type="date" name="fecha_r" required>
                <button type="submit" name="butonn1">Insertar cita</button>
                <a href="Admin.php"><button type="button" style="background:#6c757d;">Regresar</button></a>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['butonn1'])) {
                $stmt = $conn->prepare("INSERT INTO citas(id_paciente, id_medico, fecha, hora, estado, fecha_registro) VALUES (?,?,?,?,?,?)");
                $estado = "Activo";
                $stmt->bind_param("iissss", $_POST['id_p'], $_POST['id_m'], $_POST['fecha'], $_POST['hora'], $estado, $_POST['fecha_r']);
                if($stmt->execute()){ echo "<p class='center' style='color:green;'>Cita creada.</p>"; }
                $stmt->close();
            }
            break;
    }
    ?>
</body>
</html>