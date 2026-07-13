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
$sql = $conn->prepare("CALL ObtenerPacientesDelMedico(?)");
$sql->bind_param("i", $_SESSION['id_medico']);
$sql->execute();

$resultado = $sql->get_result();

if($resultado->num_rows > 0){
   

    ?>
    <div class="table-container">

<h3>📅 Mis citas</h3>

<table >
    <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Fecha de nacimineto</th>
        <th>Estado</th>
    </tr>

<?php
    while ($fila = $resultado->fetch_assoc()) {
?>

    <tr>
        <td><?php echo $fila["nombre"]; ?></td>
        <td><?php echo $fila["telefono"]; ?></td>
        <td><?php echo $fila["direccion"]; ?></td>
        <td><?php echo $fila["fecha_nacimiento"]; ?></td>
        <td><?php echo $fila["estado"]; ?></td>
        
    </tr>

<?php
    }
?>

</table>
<div>

<?php
}else{
        echo "<div class='no-data'>No tiene citas registradas</div>";
}

?>
</body>
</html>

