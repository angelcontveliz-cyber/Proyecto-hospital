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
if($_SESSION['rol']!=5){
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
            <a href="Update_Insert_select?opcion=3" class="card">🏥 <br><br> Paciente</a>
            <a href="Update_Insert_select?opcion=5" class="card">📅 <br><br> Cita</a>
            <a href="EstadoCita.php" class="card">⚙️ <br><br> Cambiar estado de cita</a>
            <a href="Ver_medicos.php" class="card">🩺 <br><br> Ver medicos</a>

            <form action="" method="POST" style="padding:0; border:none; box-shadow:none; background:none; display:contents;">
                <button type="submit" name="btn_salir" class="card" style="border:none; cursor:pointer; width:100%;">
                    <br>🔙<br>Regresar al Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>