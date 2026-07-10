<?php
include("conn.php");


$id_del_paciente = 1;
$sql = "SELECT imagen FROM imagenes WHERE id_paciente = $id_del_paciente";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    echo "<h2>Imágenes del paciente $id_del_paciente</h2>";
    
    
    while($fila = $resultado->fetch_assoc()) {
        
        $nombre_archivo = $fila['imagen']; 
       
        
        
        echo "<img src='" .  $nombre_archivo . "' alt='Imagen del paciente' width='300'>";
        echo "<br><br>"; 
    }
} else {
    echo "Este paciente no tiene imágenes registradas.";
}


$conn->close();
?>