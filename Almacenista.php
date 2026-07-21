<?php 
session_start(); 

if(isset($_POST['btn_salir'])){

    session_destroy();

    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['usuario'])) { 
    header("Location: index.php"); 
    exit(); 
}
if($_SESSION['rol']!=4){
     echo "
    <script>
        alert('Apoco si muy hacker wow eres muy bueno');
            window.location.href = 'index.php';
        </script>
       " ;
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Administración</title>
</head>
<body>
    <div class="dashboard-container">
        <h1 style="color:white; margin-bottom: 20px;">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
    <div class="dashboard-grid">
        <a href="Update_Insert_select?opcion=4" class="card">💊 <br><br> Nuevo medicamento</a>
          <a href="Quitarexistencias.php" class="card">💊 <br><br> Cambiar existencias de medicamento</a>
     <form action="" method="POST" class="card" style="padding:0; border:none; cursor:pointer;">
<button type="submit" name="btn_salir" style="background:transparent; border:none; width:100%; height:100%; cursor:pointer; display:flex; flex-direction:column; align-items:center; justify-content:center; font-family:inherit; color:inherit;">
    <br>🔙<br>Regresar al Login
</button>
</form>                                         

    </div>
</body>
</html>