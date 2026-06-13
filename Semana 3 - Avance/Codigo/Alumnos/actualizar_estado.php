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
 
$consulta = "UPDATE TBL_JUSTIFICANTES
             SET estado = '$nuevo_estado', fecha_resolucion = CURDATE()
             WHERE id_justificantes = $id_justificante";
 
if (mysqli_query($conectado, $consulta)) {
    $_SESSION['mensaje'] = "Justificante actualizado a '$nuevo_estado'.";
 
    if ($datos_alumno && !empty($datos_alumno['correo'])) {
 
        $correo_alumno   = $datos_alumno['correo'];
        $nombre_completo = $datos_alumno['nombre'] . ' ' . $datos_alumno['apellidos'];
        $motivo_tramite  = htmlspecialchars($datos_alumno['motivo']);
        $cuerpo = "
        <div style='font-family: Arial, sans-serif; padding: 24px; border: 1px solid #eee;
                    border-radius: 8px; max-width: 600px; margin: auto;'>
            <h2>Hola, {$nombre_completo}</h2>
            <p>Te informamos que tu solicitud de justificante ha sido revisada por Control Escolar.</p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p><strong>Motivo de la solicitud:</strong> {$motivo_tramite}</p>
            <p>
                <strong>Nuevo estado:</strong>&nbsp;
                <span style='padding: 5px 14px; font-weight: bold; border-radius: 12px;
                             background: {$badge_bg}; color: {$badge_color};'>
                    {$nuevo_estado}
                </span>
            </p>
            <hr style='border: none; border-top: 1px solid #eee;'>
            <p>
                Este es un mensaje automatico del sistema de Control Escolar, por favor no respondas.
            </p>
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
            $mail->Body    = $cuerpo;
 
            $mail->send();
            $_SESSION['mensaje'] .= " Se notifico al alumno por correo electronico.";
 
        } catch (Exception $e) {
            $_SESSION['mensaje'] .= " El correo no se pudo enviar: " . $mail->ErrorInfo;
        }
    }
 
} else {
    $_SESSION['mensaje'] = "Error al actualizar: " . mysqli_error($conectado);
}
 
mysqli_close($conectado);
header("Location: ../Control_Escolar/grupo.php?id=$id_grupo");
exit();
?>
 