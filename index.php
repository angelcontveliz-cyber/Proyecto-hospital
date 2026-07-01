<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="login-box">
    <form action="Login.php" method="POST">
    <div class="input-group">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" required>
    </div>

    <div class="input-group">
        <label for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" required>
    </div>

    <button type="submit" class="btn-submit">Entrar</button>
</form>
    </div>

</body>
</html>