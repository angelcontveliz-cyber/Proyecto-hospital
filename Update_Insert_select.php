<?php
include ('conn.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Usuarios</title>
</head>
<body>
    <?php
$opcion=$_GET['opcion'];

    switch($opcion){
      case 1:
        ?>
        <form action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required>

            <label for="id_rol">ID de Rol:</label>
            <input type="number" id="id_rol" name="id_rol" required>

            <button type="submit" name="btn_guardar">Agregar usuario</button>
        </form>
        <button onclick="window.location.href='Admin.php'">Regresar al login</button>

        <?php 
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
            
            $nombre = $_POST['nombre'];
            $pass   = $_POST['contrasena'];
            $rol    = $_POST['id_rol'];
            $estado = $_POST['estado'];

            // Consulta: el orden es usuario, contrasena, id_rol, estado
            $sql = "INSERT INTO usuarios (usuario, contrasena, id_rol, estado) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

          
            $stmt->bind_param("ssis", $nombre, $pass, $rol, $estado);
              
                
            if ($stmt->execute()) {
                echo "<p style='color:green;'>Usuario guardado correctamente.</p>";
              
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
        
        
        exit();
        case 2:
            ?>
             <form action="" method="POST">
            <label for="id_usuario">ID del usuario asignado:</label>
            <input type="Number" id="id_usuario" name="id_usuario" required>

            <label for="Nombre">Nombre</label>
            <input type="text" id="Nombre" name="Nombre" required>

            <label for="id_especialidad">id_especialidad</label>
            <input type="number" id="id_especialidad" name="id_especialidad" required>

            <label for="id_consultorio">ID de consultorio:</label>
            <input type="number" id="id_consultorio" name="id_consultorio" required>

            <button type="submit" name="btn_guardar">Agregar Medico</button>
        </form>
        <button onclick="window.location.href='Admin.php'">Regresar al login</button>
      <?php 
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_guardar'])) {
            
            $id_usuario = $_POST['id_usuario'];
            $Nombre   = $_POST['Nombre'];
            $id_especialidad   = $_POST['id_especialidad'];
            $id_consultorio = $_POST['id_consultorio'];

            // Consulta: el orden es usuario, contrasena, id_rol, estado
            $sql = "INSERT INTO medicos (id_usuario, Nombre, id_especialidad, id_consultorio) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

          
            $stmt->bind_param("isii", $id_usuario, $Nombre, $id_especialidad,  $id_consultorio);
              
               
            if ($stmt->execute()) {
                echo "<p style='color:green;'>Medico guardado correctamente.</p>";
                $id = $conn->insert_id;
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
       
        
         exit();
         default:
         heder ("Es imposible que veas esto significa que en algo la cague");
   exit();
   }
?>

    

</body>
</html>