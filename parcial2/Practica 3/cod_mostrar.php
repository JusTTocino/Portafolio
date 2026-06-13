<?php
include "conexion.php";

// Realizar una consulta SELECT para obtener los datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Comprobar si la consulta devuelve resultados
if ($result->num_rows > 0) {
    // Crear la tabla HTML
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>";

    // Mostrar cada fila de datos en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["Nombre"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados encontrados";
}

// Cerrar la conexión
$conn->close();
?>