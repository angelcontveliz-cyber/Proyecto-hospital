<?php 
session_start(); 
if (!isset($_SESSION['usuario'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Administración</title>
</head>
<body>
    <h1 style="color:white;">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
    <div class="dashboard-grid">
        <a href="Update_Insert_select?opcion=3" class="card">🏥 <br><br> InsertarPaciente</a>
        <a href="Update_Insert_select?opcion=5" class="card">📅 <br><br> Crear cita</a>
        <a href="Update_Insert_select?opcion=6" class="card">    <br><br>Crear Reseta </a>
        <a href="Update_Insert_select?opcion=7" calss="card">  <br><br>Ver pacientes</a>
        <form action="index" style="padding:0; border:none; box-shadow:none; background:none;">
            <button  name="btn_salir" class="card" style="border:none; cursor:pointer;">
                <br>🔙<br>Regresar al Login
            </button>
        </form>
    </div>
</body>
</html>