<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
<?php
session_start();
include 'conn.php';

// Llamamos al procedimiento almacenado actualizado
$sql = $conn->prepare("CALL ObtenerDatosMedicos()");
$sql->execute();
$resultado = $sql->get_result();

if($resultado->num_rows > 0){
?>
<div class="table-container">
    <h3>👨‍⚕️ Lista de Médicos</h3>
    <table>
        <tr>
            <th>ID Médico</th>
            <th>Nombre del Médico</th>
            <th>Nombre de Usuario</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Especialidad</th>
            <th>Consultorio</th>
        </tr>

<?php
    while ($fila = $resultado->fetch_assoc()) {
?>
        <tr>
            <td><?php echo $fila["id_medico"]; ?></td>
            <td><?php echo $fila["nombre_medico"]; ?></td>
            <td><?php echo $fila["nombre_usuario"]; ?></td>
            <!-- Cambiamos las variables numéricas por los nombres -->
            <td><?php echo $fila["nombre_rol"]; ?></td>
            <td><?php echo $fila["estado"]; ?></td>
            <td><?php echo $fila["nombre_especialidad"]; ?></td>
            <td><?php echo $fila["nombre_consultorio"]; ?></td>
        </tr>
<?php
    }
?>
    </table>

    <form style="margin-top: 15px;">
        <?php
        switch($_SESSION['rol']){
            case 1:
                echo "<a href='Admin.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
                break;
            case 2:
                echo "<a href='Medico.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
                break;
            case 5:
                echo "<a href='Secretaria.php'><button type='button' style='background:#6c757d; margin-top: 10px;'>Regresar</button></a>";
                break;
        }
        ?>
    </form>
</div>

<?php
}else{
    echo "<div class='no-data'>No hay médicos registrados</div>";
}
?>
</body>
</html>