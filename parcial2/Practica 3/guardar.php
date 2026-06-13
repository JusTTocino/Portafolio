<?php
include "conexion.php";

// Recibir el dato del formulario
$nombre = $_POST['nombre'];

// Preparar la consulta SQL con sentencia preparada
$stmt = $conn->prepare("INSERT INTO usuarios (nombre) VALUES (?)");
$stmt->bind_param("s", $nombre);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>alert('Nuevo registro guardado correctamente');
    window.history.go(-1); </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>