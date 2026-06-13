    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión - Alumno</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/css.css">
    </head>
    <body>
        <h1>Iniciar Sesión</h1>
        <div class="contenedor">
            <form action="" method="POST">
                <table class="nombre">
                    <tr>
                        <td>
                            <label>Número de Control:</label>
                            <input type="text" name="no_control" autofocus required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Contraseña:</label>
                            <input type="password" name="password" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="login" value="Iniciar Sesión">
                        </td>
                    </tr>
                </table>
            </form>
            <div class="registro-link">
                ¿No tienes cuenta? <a href="../Alumnos/Registrar_alumno.php">Regístrate aquí</a>
            </div>
            
            <?php if (isset($error) && $error != ""): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
        </div>
        <br><br>
        <button onclick="window.location.href='../index.php'">Volver</button>
    </body>
    </html>