<?php 
session_start(); 
// Si no hay usuario, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
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
    <h1 style="text-align:center;">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

    <div class="dashboard-grid">
        <a href="Update_Insert_select.php?opcion=1" class="card">👤 <br><br> Usuario</a>
        <a href="Update_Insert_select.php?opcion=2" class="card">👨‍⚕️ <br><br> Médico</a>
        <a href="Update_Insert_select.php?opcion=3" class="card">🏥 <br><br> Paciente</a>
        <a href="Update_Insert_select.php?opcion=4" class="card">💊 <br><br> Medicamento</a>
        <a href="Update_Insert_select.php?opcion=5" class="card">📅 <br><br> Cita</a>
        
    </div>
</body>
</html>