<?php
include("conn.php");

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resultado = $conn->query($sql);



if ($resultado->num_rows > 0) {
      
    $fila = $resultado->fetch_assoc();
    $estado= $fila["estado"];
if($estado=="Activo"){
    $id_rol = $fila["id_rol"];
   switch ($id_rol){
    case 1:
        header("location:admin.php");
    
    case 2:
        header("Location:Medico.php");
exit();

case 3:
        header("Location:Usuario.php");
exit();
 default:
   heder ("Es imposible que veas esto significa que en algo la cague");
   exit();
   }
  
}
else{
    ?>
    <script>
        alert("Usted esta dado de baja")
    </script>
    <?php
    

}

} else {
    
    echo "Usuario o contraseña incorrectos";
}
?>