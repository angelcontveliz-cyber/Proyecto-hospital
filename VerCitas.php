<!DOCTYPE html>
<html lang="es">
<head >
    <link rel="stylesheet" href="estilos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body >
<?php
session_start();
include 'conn.php';
$sql = $conn->prepare("CALL ObtenerCitasDelMedico(?)");
$sql->bind_param("i", $_SESSION['id_medico']);
$sql->execute();

$resultado = $sql->get_result();

if($resultado->num_rows > 0){
   

    ?>
<div class="table-container">

<h3>📅 Mis citas</h3>


<table >
    <tr>
        <th>Id de cita</th>
        <th>Id de paciente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
          <th>Fecha registro</th>
    </tr>

<?php
    while ($fila = $resultado->fetch_assoc()) {
?>

    <tr>
        <td><?php echo $fila["id_cita"]; ?></td>
        <td><?php echo $fila["id_paciente"]; ?></td>
        <td><?php echo $fila["fecha"]; ?></td>
        <td><?php echo $fila["hora"]; ?></td>
        <td><?php echo $fila["estado"]; ?></td>
        <td><?php echo $fila["fecha_registro"]; ?></td>
        
    </tr>

<?php
    }
?>
<form  >
    <?php
    
            echo "<a href='Medico.php'><button type='button'>Regresar</button></a>";
    ?>
    </form>
</table>
</div>

<?php
}else{
    echo "<div class='no-data'>No tiene citas registradas</div>";
}

?>
</body>
</html>

