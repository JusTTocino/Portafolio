<!---
Jose Alejandro Meneses Mendivil
4AMPr
17/04/26
Practica 4
---->
<?php
include "conexion.php";

$sql = "SELECT * FROM tbl_usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear la tabla HTML
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td class='tdcito'><a href='edita.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-marker'></i></a></td>
                <td class='tdcito'><a href='elimina.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='far fa-trash-alt'></i></a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados encontrados";
}

$conn->close();
?>