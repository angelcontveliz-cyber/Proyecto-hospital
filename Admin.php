<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de administrador bien benido</title>

</head>
<body>
    <?php session_start();?>
 <center>"Bienvenido, " <?php echo  $_SESSION['usuario'];?></center>
<br>

<button onclick="window.location.href='Update_Insert_select.php? opcion= 1'">
   Insertar Usuario
</button>
    <button onclick="window.location.href='Update_Insert_select.php? opcion=2'">
        Insertar Medico
    </button>
    <button onclick="window.location.href='Update_Insert_select.php opcion=3'">
        Insertar Paciente
    </button>
    <button onclick="window.location.href='Update_Insert_select.php opcion=4'">
        Insertar medicamento
    </button>
    <button onclick="window.location.href='Update_Insert_select.php opcion=5'">
       Crear reseta
    </button>
</body>
</html>