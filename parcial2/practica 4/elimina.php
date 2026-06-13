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

    $query = "DELETE FROM tbl_usuarios WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('El registro se ha eliminado correctamente');
                    window.location.href = document.referrer;
                  </script>";
        } else {
            echo "Error al eliminar el usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "No se proporcionó un ID de usuario.";
}

$conn->close();
?>