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
                
                <label for="id_rol">ID de Rol</label> 
                <select name="id_rol " id="rol" requiered>
                    <option value=1>Administrador</option>
                    <option value=2>Medico</option>
                    <option value=3>Paciente</option>
        </select>
                <input type="number" id="id_rol" name="id_rol" required>
                
                <button type="submit" name="btn_guardar">Agregar usuario</button>
                <?php
                switch($_SESSION['rol']){

                case 1:
               ?> <a href='Admin'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php
                exit();
                case 2:
                ?> <a href='Medico'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php exit();
                default:
               ?> <a href='Pacientes'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php   exit();
                break;
    }?>
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
       " ;
                        echo "<p style='text-align:center; color:green;'>Administrador guardado.</p>"; 
                    }
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
               ?> <a href='Admin.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php
                exit();
                case 2:
                ?> <a href='Medico.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php exit();
                default:
               ?> <a href='Pacientes.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php   exit();
                break;
    }?>
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
       " ;
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
                exit();
                case 2:
                ?> <a href='Medico.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php exit();
                default:
               ?> <a href='Pacientes.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php   exit();
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

        case 4: // --- MEDICAMENTO ---
            ?>
            <form action="" method="POST">
                <h3>💊 Nuevo Medicamento</h3>
                <label for="Nombre_M">Medicamento:</label> 
                <input type="text" id="Nombre_M" name="Nombre_M" required>
                
                <label for="Descripcion">Descripción:</label> 
                <input type="text" id="Descripcion" name="Descripcion" required>
                
                <label for="Existencias">Existencias:</label> 
                <input type="number" id="Existencias" name="Existencias" required>
                
                <button type="submit" name="button1">Ingresar medicamento</button>
                <?php
                switch($_SESSION['rol']){

                case 1:
               ?> <a href='Admin.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php
                exit();
                case 2:
                ?> <a href='Medico.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php exit();
                default:
               ?> <a href='Pacientes.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php   exit();
                break;
    }?>
            </form>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['button1'])) {
                $nombre_m = $_POST['Nombre_M'];
                $descripcion = $_POST['Descripcion'];
                $existencias = $_POST['Existencias'];

                $stmt = $conn->prepare("INSERT INTO medicamentos (nombre, descripcion) VALUES(?,?)");
                $stmt->bind_param("ss", $nombre_m, $descripcion);
                
                if($stmt->execute()){
                    $K = $conn->insert_id;
                    $stmt1 = $conn->prepare("INSERT INTO inventario (id_medicamento, existencia) VALUES (?,?)");
                    $stmt1->bind_param("ii", $K, $existencias);
                    if($stmt1->execute()){ 
                        echo "<p style='text-align:center; color:green;'>Medicamento e inventario creados.</p>"; 
                    }
                    $stmt1->close();
                }
            }
            break;

        case 5: // --- CITA ---
            ?>
            <form action="" method="POST">
                <h3>📅 Crear Cita</h3>
                <label for="id_p">Número de identificación paciente:</label> 
                <input type="number" id="id_p" name="id_p" required>
                
                <label for="id_m">Número de control de médico:</label> 
                <input type="number" id="id_m" name="id_m" required>
                
                <label for="fecha">Inserte la fecha citado:</label> 
                <input type="date" id="fecha" name="fecha" required>
                
                <label for="hora">Hora de citación:</label> 
                <input type="time" id="hora" name="hora" required>
                
                <label for="fecha_r">Fecha Registro:</label> 
                <input type="date" id="fecha_r" name="fecha_r" required>
                
                <button type="submit" name="butonn1">Insertar cita</button>
               <?php
                switch($_SESSION['rol']){

                case 1:
               ?> <a href='Admin.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php
                exit();
                case 2:
                ?> <a href='Medico.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
                <?php exit();
                default:
               ?> <a href='Pacientes.php'><button type='button' style='background:#6c757d;'>Regresar</button></a>
             <?php   exit();
                break;
    }?>
            </form>
            
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['butonn1'])) {
                $id_paciente = $_POST['id_p'];
                $id_medico = $_POST['id_m'];
                $fecha_cita = $_POST['fecha'];
                $hora_cita = $_POST['hora'];
                $fecha_reg = $_POST['fecha_r'];
                $estado = "Activo";

                $stmt = $conn->prepare("INSERT INTO citas(id_paciente, id_medico, fecha, hora, estado, fecha_registro) VALUES (?,?,?,?,?,?)");
                $stmt->bind_param("iissss", $id_paciente, $id_medico, $fecha_cita, $hora_cita, $estado, $fecha_reg);
                
                if($stmt->execute()){ 
                    echo "<p style='text-align:center; color:green;'>Cita creada.</p>"; 
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
    
    <button type="submit" name="etesech">Crear receta</button>
</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['etesech'])) {
    
    $id_Cita = $_POST['id_Cita'];
    $fecha = $_POST['fecha'];
    $estador = "Activo";
    
    
    $stmt_select = $conn->prepare("SELECT id_cita FROM citas WHERE id_cita = ?");
    $stmt_select->bind_param("i", $id_Cita);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    
    if ($resultado->num_rows > 0) {
        
        
        $stmt_insert = $conn->prepare("INSERT INTO recetas (id_cita, fecha, estado) VALUES (?,?,?)");
        $stmt_insert->bind_param("iss", $id_Cita, $fecha, $estador);
        
    
        if($stmt_insert->execute()){
            
           
            $_SESSION['id_reseta'] = $conn->insert_id; 
            
            echo "
            <script>
                alert('Receta creada');
                window.location.href='insertae_detalles.php';
            </script>
            ";
        }
        
    } else {
      
        $ruta_destino = ($_SESSION['rol'] == 1) ? 'Admin.php' : 'Medico.php';
        
        echo "
        <script>
            alert('No hay una cita existente');
            window.location.href='$ruta_destino';
        </script>
        ";
    }
}


    exit();

        
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
        exit();

    default:
        echo "
        <script>
            alert('No tiene permiso para ver esta página');
            window.location.href='Pacientes.php';
        </script>
        ";
        exit();
}

break;
}
?>
</body>
</html>