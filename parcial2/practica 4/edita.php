<!---
Jose Alejandro Meneses Mendivil
4AMPr
17/04/26
Practica 4
---->
<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['editar'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];

    $query = "UPDATE tbl_usuarios SET nombre = '$nombre' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: muestra.php");
}

if (isset($_POST['regresar'])) {
    header("Location: muestra.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Actualiza usuario</title>
</head>
<body>
    <?php
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_usuarios WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $nombre = $row['nombre'];
    }
    ?>

    <h1>Modifica el nombre del usuario <?php echo $_GET['id']; ?></h1>
    <form action="edita.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <input type="text" name="identificador" value="<?php echo $row['id']; ?>" disabled>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" placeholder="cambia nombre"><br>
        <input type="submit" name="editar" value="Actualizar">
        <input type="submit" name="regresar" value="Regresar">
    </form>
</body>
</html>