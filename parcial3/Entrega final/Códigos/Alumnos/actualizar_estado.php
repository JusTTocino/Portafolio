<?php
session_start();
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
 
if (!isset($_SESSION['rfc'])) {
    header('Location: ../Control_Escolar/Administrador.php');
    exit();
}
 
include("../Conexion/BaseDeDatos.php");
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../Control_Escolar/panel_grupo.php');
    exit();
}

define('GMAIL_USUARIO',  'meneses.alejandro.cb37@gmail.com');
define('GMAIL_CLAVE',    'ggqbjhwwagxqofdx');

$id_justificante = intval($_POST['id_justificante']);
$nuevo_estado    = mysqli_real_escape_string($conectado, $_POST['estado']);
$id_grupo        = intval($_POST['id_grupo']);
 
$estados_validos = ['Pendiente', 'Aprobado', 'Rechazado'];
if (!in_array($nuevo_estado, $estados_validos)) {
    $_SESSION['mensaje'] = 'Estado no valido.';
    header("Location: ../Control_Escolar/grupo.php?id=$id_grupo");
    exit();
}
 
$consulta_alumno = "SELECT a.correo, a.nombre, a.apellidos, j.motivo 
                    FROM tbl_justificantes j
                    INNER JOIN tbl_alumnos a ON j.id_alumno = a.id_alumno
                    WHERE j.id_justificantes = $id_justificante";
 
$resultado_alumno = mysqli_query($conectado, $consulta_alumno);
$datos_alumno     = mysqli_fetch_assoc($resultado_alumno);

$consulta_maestros = "SELECT DISTINCT m.correo, m.nombre_maestro
                      FROM tbl_justificantes j
                      INNER JOIN tbl_alumnos a ON j.id_alumno = a.id_alumno
                      INNER JOIN tbl_m_g mg ON a.id_grupo = mg.id_grupo
                      INNER JOIN tbl_m_m mm ON mg.id_materia = mm.id_materia
                      INNER JOIN tbl_maestro m ON mm.id_maestro = m.id_maestro
                      WHERE j.id_justificantes = $id_justificante";

$resultado_maestros = mysqli_query($conectado, $consulta_maestros);
$maestros_a_notificar = [];
if ($resultado_maestros) {
    while ($fila_m = mysqli_fetch_assoc($resultado_maestros)) {
        if (!empty($fila_m['correo'])) {
            $maestros_a_notificar[] = $fila_m;
        }
    }
}
 
$consulta = "UPDATE tbl_justificantes
             SET estado = '$nuevo_estado', fecha_resolucion = CURDATE()
             WHERE id_justificantes = $id_justificante";
 
if (mysqli_query($conectado, $consulta)) {
    $_SESSION['mensaje'] = "Justificante actualizado a '$nuevo_estado'.";
 
    $nombre_completo = $datos_alumno['nombre'] . ' ' . $datos_alumno['apellidos'];
    $motivo_tramite  = htmlspecialchars($datos_alumno['motivo']);

    $badge_bg = ($nuevo_estado == 'Aprobado') ? '#d4edda' : (($nuevo_estado == 'Rechazado') ? '#f8d7da' : '#fff3cd');
    $badge_color = ($nuevo_estado == 'Aprobado') ? '#155724' : (($nuevo_estado == 'Rechazado') ? '#721c24' : '#856404');

    if ($datos_alumno && !empty($datos_alumno['correo'])) {
        $correo_alumno   = $datos_alumno['correo'];
        
        $cuerpo_alumno = "
        <div style='font-family: Arial, sans-serif; padding: 24px; border: 1px solid #eee; border-radius: 8px; max-width: 600px; margin: auto;'>
            <h2>Hola, {$nombre_completo}</h2>
            <p>Te informamos que tu solicitud de justificante ha sido revisada por Control Escolar.</p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p><strong>Motivo de la solicitud:</strong> {$motivo_tramite}</p>
            <p>
                <strong>Nuevo estado:</strong>&nbsp;
                <span style='padding: 5px 14px; font-weight: bold; border-radius: 12px; background: {$badge_bg}; color: {$badge_color};'>
                    {$nuevo_estado}
                </span>
            </p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p>Este es un mensaje automatico del sistema de Control Escolar, por favor no respondas.</p>
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
            $mail->addAddress($correo_alumno, $nombre_completo);
 
            $mail->isHTML(true);
            $mail->Subject = "Actualizacion de tu justificante - {$nuevo_estado}";
            $mail->Body    = $cuerpo_alumno;
 
            $mail->send();
            $_SESSION['mensaje'] .= " Se notifico al alumno por correo.";
        } catch (Exception $e) {
            $_SESSION['mensaje'] .= " El correo del alumno no se pudo enviar: " . $mail->ErrorInfo;
        }
    }
    
    if (count($maestros_a_notificar) > 0) {
        $correos_profes_enviados = 0;

        foreach ($maestros_a_notificar as $datos_maestro) {
            $correo_maestro = trim($datos_maestro['correo']); 
            $nombre_maestro = $datos_maestro['nombre_maestro'];

            $cuerpo_maestro = "
            <div style='font-family: Arial, sans-serif; padding: 24px; border: 1px solid #eee; border-radius: 8px; max-width: 600px; margin: auto;'>
                <h2>Estimado(a) Profesor(a), {$nombre_maestro}</h2>
                <p>Le notificamos que el estado de la solicitud de justificante de un alumno en su grupo ha cambiado.</p>
                <hr style='border: none; border-top: 1px solid #eee;'>
                <p><strong>Alumno:</strong> {$nombre_completo}</p>
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
                $mailM = new PHPMailer(true);
                $mailM->isSMTP();
                $mailM->Host       = 'smtp.gmail.com';
                $mailM->SMTPAuth   = true;
                $mailM->Username   = GMAIL_USUARIO;
                $mailM->Password   = GMAIL_CLAVE;
                $mailM->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailM->Port       = 587;
                $mailM->CharSet    = 'UTF-8';
     
                $mailM->setFrom(GMAIL_USUARIO, 'Control Escolar');
                $mailM->addAddress($correo_maestro, $nombre_maestro);
     
                $mailM->isHTML(true);
                $mailM->Subject = "Notificacion de Justificante - Alumno: {$nombre_completo} ({$nuevo_estado})";
                $mailM->Body    = $cuerpo_maestro;
     
                $mailM->send();
                $correos_profes_enviados++;
            } catch (Exception $e) {
                continue;
            }
        }

        if ($correos_profes_enviados > 0) {
            $_SESSION['mensaje'] .= " Se notificó a los profesores del grupo ({$correos_profes_enviados}).";
        }
    }
 
} else {
    $_SESSION['mensaje'] = "Error al actualizar: " . mysqli_error($conectado);
}
 
mysqli_close($conectado);
header("Location: ../Control_Escolar/grupo.php?id=$id_grupo");
exit();
?>