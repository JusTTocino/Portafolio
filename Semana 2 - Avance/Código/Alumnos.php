<?php
include("BaseDeDatos.php");
session_start();

$error = "";

if (isset($_POST['login'])) {
    $no_control = mysqli_real_escape_string($conectado, $_POST['no_control']);
    $password   = mysqli_real_escape_string($conectado, $_POST['password']);

    $resultado = mysqli_query($conectado,
        "SELECT a.*, g.grado_letra AS grupo
         FROM TBL_ALUMNOS a
         JOIN TBL_GRUPOS g ON a.id_grupo = g.id_grupo
         WHERE a.No_control = '$no_control' AND a.password = '$password'");

    if (mysqli_num_rows($resultado) > 0) {
        $alumno = mysqli_fetch_assoc($resultado);
        $_SESSION['id_alumno'] = $alumno['id_alumno'];
        $_SESSION['nombre']    = $alumno['nombre'];
        $_SESSION['grupo']     = $alumno['grupo'];
        header("Location: index-alumno.php");
        exit();
    } else {
        $error = "Número de control o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css.css">
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
        <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>
    </div>
    <br><br>
    <button onclick="window.location.href='index.php'">Volver</button>
</body>
</html>