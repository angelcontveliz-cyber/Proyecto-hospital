<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php session_start();?>
    <h6><center>Bienvenido <?php echo $_SESSION['usuario'];?></center></h6>
    
    <button onclick="window.location.href='Update_Insert_select.php? opcion=3'">
        Insertar Paciente
    </button>
    <button onclick="windows.location.href='Update_Insert_select.php? opcion=5'">Crear cita</button>
</body>
</html>