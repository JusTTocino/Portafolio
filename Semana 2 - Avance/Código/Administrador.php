<?php
include("BaseDeDatos.php");
session_start();

$error = "";

if (isset($_POST['login'])) {
    $id       = mysqli_real_escape_string($conectado, $_POST['rfc']);
    $password = mysqli_real_escape_string($conectado, $_POST['password']);

    $resultado = mysqli_query($conectado,
        "SELECT * FROM TBL_CONTROL_ESCOLAR
         WHERE rfc = '$id' AND password = '$password'");

    if (mysqli_num_rows($resultado) > 0) {
        $admin = mysqli_fetch_assoc($resultado);
        $_SESSION['id_admin']     = $admin['rfc']; 
        $_SESSION['nombre_admin'] = $admin['nombre_admin'];
        header("Location: panel_grupo.php");
        exit();
    } else {
        $error = "Id o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Admin</title>
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
                        <label>Id Admin:</label>
                        <input type="text" name="rfc" autofocus required>
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
