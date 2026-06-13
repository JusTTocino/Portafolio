<?php
session_start();
if (!isset($_SESSION['rfc'])) {
    header("Location: Administrador.php");
    exit();
}
$dir = __DIR__ . "/../docs/";
$archivos = [];
if (is_dir($dir)) {
    foreach (scandir($dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $partes = explode('-', $file, 2);
            $archivos[] = ['original' => isset($partes[1]) ? $partes[1] : $file, 'archivo' => $file];
        }
    }
}
require __DIR__ . '/../View/admin-index.php';
?>
