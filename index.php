<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <title>Login - Hospital</title>
</head>
<body>
    <div class="login-box">
        <h3>Iniciar Sesión</h3>
        <form action="Login" method="post">
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