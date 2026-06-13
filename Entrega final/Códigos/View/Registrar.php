<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/css.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div class="contenedor">
        <h1>Registrarse</h1>

        <?php if (isset($errores) && $errores != ''): ?>
            <div class='error'><ul><?= $errores ?></ul></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required
                   value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required
                   value="<?= isset($apellidos) ? htmlspecialchars($apellidos) : '' ?>">

            <label for="no_control">Número de Control:</label>
            <input type="text" id="no_control" name="no_control" required
                   value="<?= isset($no_control) ? htmlspecialchars($no_control) : '' ?>">

            <label for="correo">Correo Electrónico:</label>
            <input type="text" id="correo" name="correo" required
                   value="<?= isset($correo) ? htmlspecialchars($correo) : '' ?>">

            <label for="id_grupo">Grupo:</label>
            <select id="id_grupo" name="id_grupo" required>
                <option value=""> Selecciona tu grupo </option>
                <?php if (isset($grupos)): foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['id_grupo'] ?>"
                        <?= (isset($id_grupo) && $id_grupo == $grupo['id_grupo']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($grupo['grado_letra']) ?>
                    </option>
                <?php endforeach; endif; ?>
            </select>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="password2">Confirmar Contraseña:</label>
            <input type="password" id="password2" name="password2" required>

            <input type="submit" value="Registrarse">
        </form>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="../Alumnos/Alumnos.php">Inicia sesión aquí</a>
        </div>
        <br>
        <button onclick="window.location.href='../index.php'">← Volver al inicio</button>
    </div>
</body>
</html>
