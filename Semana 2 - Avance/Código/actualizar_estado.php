<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header('Location: Administrador.php');
    exit();
}

include("BaseDeDatos.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_justificante = intval($_POST['id_justificante']);
    $nuevo_estado    = mysqli_real_escape_string($conectado, $_POST['estado']);
    $id_grupo        = intval($_POST['id_grupo']);

    $estados_validos = ['Pendiente', 'Aprobado', 'Rechazado'];
    
    $consulta_actualizar = "UPDATE TBL_JUSTIFICANTES SET estado = '$nuevo_estado',  fecha_resolucion = CURDATE() WHERE id_justificantes = $id_justificante";                

    if (mysqli_query($conectado, $consulta_actualizar)) {
        $_SESSION['mensaje'] = "Justificante actualizado a '$nuevo_estado'.";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar: " . mysqli_error($conectado);
    }

    header("Location: grupo.php?id=$id_grupo");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBTIS 37 - Panel de Administración</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<div class="contenedor">
    <h1>Control de Justificantes — Administración</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alerta-mensaje">
            <?php 
                echo $_SESSION['mensaje']; 
                unset($_SESSION['mensaje']); 
            ?>
        </div>
    <?php endif; ?>

    <div class="tarjeta-justificante">
        <div class="datos-alumno">
            <p><strong>ID Justificante:</strong> 105</p>
            <p><strong>Alumno:</strong> Juan Pérez Mendoza</p>
            <p><strong>Motivo:</strong> Médico</p>
            <p><strong>Descripción:</strong> Cita en el IMSS por malestar general.</p>
        </div>

        <form action="procesar_estado.php" method="POST" class="formulario-estado">
            
            <input type="hidden" name="id_justificante" value="105">
            <input type="hidden" name="id_grupo" value="4"> 

            <label for="estado">Cambiar Estado:</label>
            <select name="estado" id="estado">
                <option value="Pendiente"> Pendiente</option>
                <option value="Aprobado"> Aprobado</option>
                <option value="Rechazado"> Rechazado</option>
            </select>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

</body>
</html>