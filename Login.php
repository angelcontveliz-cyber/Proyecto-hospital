<?php
include("conn.php");
session_start();
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resultado = $conn->query($sql);



if ($resultado->num_rows > 0) {
      
    $fila = $resultado->fetch_assoc();
    $estado= $fila["estado"];
    $id_U=$fila['id_usuario'];
    $_SESSION ['id_usuario']=$id_U;
if($estado=="Activo"){
    $id_rol = $fila["id_rol"];
   switch ($id_rol){
    case 1:
        $_SESSION ['usuario']= $usuario;

        header("location:admin.php");
    exit();
    case 2:
      
        $_SESSION ['usuario']= $usuario;
        header("Location:Medico.php");
exit();

case 3:
    
        $_SESSION ['usuario']= $usuario;
        header("Location:Usuario.php");
exit();
 default:
   heder ("Es imposible que veas esto significa que en algo la cague");
   exit();
   }
  
}
else{
    unset($_SESSION['usuario']);?>
    <h6>Usted esta dado de baja</h6>
        <button onclick="window.location.href='index.php'";>Regresar al inicio</button>
        

    
    
    <?php
    

}

} else {
    
    echo "Usuario o contraseña incorrectos";
}
?>