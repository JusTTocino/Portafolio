<!---
Jose Alejandro Meneses Mendivil
Practica 2
14/04/26
--->
<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_p2";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];

// Preparar la consulta SQL para insertar los datos
$sql = "INSERT INTO usuarios (nombre) VALUES ('$nombre')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro guardado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>