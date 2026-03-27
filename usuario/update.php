<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
$usuario_id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$es_admin = isset($_POST['es_admin']) ? 1 : 0;

if (empty($nombre) || empty($correo) || empty($usuario_id)) {
    header('Location: editar.php?id=' . $usuario_id . '&error=Campos%20requeridos');
    exit;
}
include '../lib/conn.php';
if(empty($password)){
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, es_admin = ? WHERE id = ?");
    $stmt->bind_param('ssii', $nombre, $correo, $es_admin, $usuario_id);
} else {
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ?, es_admin = ? WHERE id = ?");
    $hased_password = md5($password);
    $stmt->bind_param('sssii', $nombre, $correo, $hased_password, $es_admin, $usuario_id);
}
//ejecutamos la consulta
if ($stmt->execute()) {
    header('Location: editar.php?id=' . $usuario_id . '&exito=Usuario%20actualizado%20correctamente');
} else {
    header('Location: editar.php?id=' . $usuario_id . '&error=Error%20al%20actualizar%20el%20usuario');
}

?>