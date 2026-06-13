<!---
Jose Alejandro Meneses Mendivil
4AMPr
17/04/26
Practica 4
---->
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_p2";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>