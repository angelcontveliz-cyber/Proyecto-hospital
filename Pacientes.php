<!DOCTYPE html>
<html lang="en">
    <?php 
    session_start();
if(isset($_POST['btn_salir'])){

    session_destroy();

    header("Location: index.php");
    exit();}


if (!isset($_SESSION['usuario'])) { 
    header("Location: index.php"); 
    exit(); 
}
if($_SESSION['rol']!=1){
       echo "
    <script>
        alert('Apoco si muy hacker wow eres muy bueno');
            window.location.href = 'index.php';
        </script>
       " ;
    exit(); 
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center><h6>Bienvenido <?php echo $_SECCION['usuario']?></h6><center>
    
</body>
</html>