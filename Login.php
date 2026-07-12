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
   $_SESSION['rol'] = $fila["id_rol"];
   switch ($_SESSION['rol']){
    case 1:
        $_SESSION ['usuario']= $usuario;

        header("location:Admin.php");
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
    unset($_SESSION['usuario']);
    echo "
    <script>
        alert('No tiene permiso para ver esta pagina');
            window.location.href = 'index.php';
        </script>
       " ;
}
}
else{
  echo "
    <script>
        alert('Usuario o contraseña incorrecto');
            window.location.href = 'index.php';
        </script>
       " ;
}

?>
