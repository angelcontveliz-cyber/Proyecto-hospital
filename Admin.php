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
        <a href="Update_Insert_select?opcion=1" class="card">👤 <br><br> Usuario</a>
        <a href="Update_Insert_select?opcion=2" class="card">👨‍⚕️ <br><br> Médico</a>
        <a href="Update_Insert_select?opcion=3" class="card">🏥 <br><br> Paciente</a>
        <a href="Update_Insert_select?opcion=4" class="card">💊 <br><br> Medicamento</a>
        <a href="Update_Insert_select?opcion=5" class="card">📅 <br><br> Cita</a>
        <a href="Update_Insert_select?opcion=6" class="card">    <br><br>Reseta </a>
         <a href="Update_Insert_select?opcion=7" class="card">    <br><br>Cambiar estado de receta </a>
        <a href="subir_foto.php" class="card">    <br><br>Subir foto del paciente </a>
        <a href="Ver_fotos_pacientes.php" class="card">    <br><br>Ver foto del paciente </a>

        <form action="index" style="padding:0; border:none; box-shadow:none; background:none;">
            <button  name="btn_salir" class="card" style="border:none; cursor:pointer;">
                <br>🔙<br>Regresar al Login
            </button>
        </form>
    </div>
</body>
</html>