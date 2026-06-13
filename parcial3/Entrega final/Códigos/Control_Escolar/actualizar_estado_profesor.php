<?php
session_start();
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
 
if (!isset($_SESSION['rfc'])) {
    header('Location: Administrador.php');
    exit();
}
 
include("../Conexion/BaseDeDatos.php");
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: panel_grupo.php');
    exit();
}

define('GMAIL_USUARIO',  'meneses.alejandro.cb37@gmail.com');
define('GMAIL_CLAVE',    'ggqbjhwwagxqofdx');

$id_justificante = intval($_POST['id_justificante']);
$nuevo_estado    = mysqli_real_escape_string($conectado, $_POST['estado']);

$estados_validos = ['Pendiente', 'Aprobado', 'Rechazado'];
if (!in_array($nuevo_estado, $estados_validos)) {
    $_SESSION['mensaje'] = 'Estado no valido.';
    header("Location: panel_grupo.php");
    exit();
}

// CONSULTA DE DIAGNÓSTICO ESTRICTO
$consulta_maestros = "SELECT DISTINCT 
                        m.correo, 
                        m.nombre_maestro, 
                        a.nombre AS nom_alumno, 
                        a.apellidos AS ape_alumno, 
                        j.motivo,
                        a.id_grupo
                      FROM tbl_justificantes j
                      INNER JOIN tbl_alumnos a ON j.id_alumno = a.id_alumno
                      INNER JOIN tbl_m_g mg ON a.id_grupo = mg.id_grupo
                      INNER JOIN tbl_m_m mm ON mg.id_materia = mm.id_materia
                      INNER JOIN tbl_maestro m ON mm.id_maestro = m.id_maestro
                      WHERE j.id_justificantes = $id_justificante";
 
$resultado_maestros = mysqli_query($conectado, $consulta_maestros);

// Si la consulta SQL falló por completo, guardamos el error de MySQL
if (!$resultado_maestros) {
    $_SESSION['mensaje'] = "Error en la consulta SQL: " . mysqli_error($conectado);
    header("Location: panel_grupo.php");
    exit();
}

$maestros_a_notificar = [];
$id_grupo_detectado = 0;

while ($fila = mysqli_fetch_assoc($resultado_maestros)) {
    $id_grupo_detectado = intval($fila['id_grupo']);
    if (!empty($fila['correo'])) {
        $maestros_a_notificar[] = $fila;
    }
}

// Cantidad de maestros encontrados en la base de datos para este alumno
$total_maestros_encontrados = count($maestros_a_notificar);

if (isset($_POST['id_grupo']) && intval($_POST['id_grupo']) > 0) {
    $id_grupo = intval($_POST['id_grupo']);
} else {
    $id_grupo = $id_grupo_detectado;
}
 
$consulta = "UPDATE tbl_justificantes
             SET estado = '$nuevo_estado', fecha_resolucion = CURDATE()
             WHERE id_justificantes = $id_justificante";
 
if (mysqli_query($conectado, $consulta)) {
    // Iniciamos el mensaje base
    $_SESSION['mensaje'] = "Justificante actualizado a '$nuevo_estado'. [Maestros encontrados en BD: $total_maestros_encontrados]";
    
    $correos_enviados = 0;
    $detalles_envio = [];

    foreach ($maestros_a_notificar as $datos_maestro) {
        $correo_maestro = trim($datos_maestro['correo']); 
        $nombre_maestro = $datos_maestro['nombre_maestro'];
        $nombre_alumno  = $datos_maestro['nom_alumno'] . ' ' . $datos_maestro['ape_alumno'];
        $motivo_tramite = htmlspecialchars($datos_maestro['motivo']);
        
        $badge_bg = ($nuevo_estado == 'Aprobado') ? '#d4edda' : (($nuevo_estado == 'Rechazado') ? '#f8d7da' : '#fff3cd');
        $badge_color = ($nuevo_estado == 'Aprobado') ? '#155724' : (($nuevo_estado == 'Rechazado') ? '#721c24' : '#856404');

        $cuerpo_maestro = "
        <div style='font-family: Arial, sans-serif; padding: 24px; border: 1px solid #eee; border-radius: 8px; max-width: 600px; margin: auto;'>
            <h2>Estimado(a) Profesor(a), {$nombre_maestro}</h2>
            <p>Le notificamos que el estado de la solicitud de justificante de un alumno en su grupo ha cambiado.</p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p><strong>Alumno:</strong> {$nombre_alumno}</p>
            <p><strong>Motivo de la solicitud:</strong> {$motivo_tramite}</p>
            <p>
                <strong>Nuevo estado:</strong>&nbsp;
                <span style='padding: 5px 14px; font-weight: bold; border-radius: 12px; background: {$badge_bg}; color: {$badge_color};'>
                    {$nuevo_estado}
                </span>
            </p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p>Este es un mensaje automático del sistema de Control Escolar, por favor no responda.</p>
        </div>";
 
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = GMAIL_USUARIO;
            $mail->Password   = GMAIL_CLAVE;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';
 
            $mail->setFrom(GMAIL_USUARIO, 'Control Escolar');
            $mail->addAddress($correo_maestro, $nombre_maestro);
 
            $mail->isHTML(true);
            $mail->Subject = "Notificacion de Justificante - Alumno: {$nombre_alumno} ({$nuevo_estado})";
            $mail->Body    = $cuerpo_maestro;
 
            $mail->send();
            $correos_enviados++;
        } catch (Exception $e) {
            $detalles_envio[] = "Error enviando a $nombre_maestro: " . $mail->ErrorInfo;
        }
    }

    if ($correos_enviados > 0) {
        $_SESSION['mensaje'] .= " | Envios exitosos: $correos_enviados.";
    }
    if (count($detalles_envio) > 0) {
        $_SESSION['mensaje'] .= " | Fallas: " . implode(", ", $detalles_envio);
    }
 
} else {
    $_SESSION['mensaje'] = "Error al actualizar justificante: " . mysqli_error($conectado);
}
 
mysqli_close($conectado);

if ($id_grupo > 0) {
    header("Location: grupo.php?id=$id_grupo");
} else {
    header("Location: panel_grupo.php");
}
exit();