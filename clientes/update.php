<?php
session_start();
//
$cliente_id = $_POST['id'];
$nombre = $_POST['nombre'];
$domicilio = $_POST['domicilio'];
$giro = $_POST['giro'];
$razon_social = $_POST['razon_social'];

if (empty($nombre) || empty($domicilio) || empty($giro) || empty($razon_social)) {
    header('Location: editar.php?id=' . $cliente_id . '&error=Campos%20requeridos');
    exit;
}
include '../lib/conn.php';
if(empty($giro) || empty($razon_social)){
    $stmt = $conexion->prepare("UPDATE clientesss SET nombre = ?, domicilio = ?, giro = ?, razon_social = ? WHERE id = ?");
    $stmt->bind_param('sssii', $nombre, $domicilio, $giro, $razon_social, $cliente_id);
} else {
    $stmt = $conexion->prepare("UPDATE clientesss SET nombre = ?, domicilio = ?, giro = ?, razon_social = ? WHERE id = ?");
    $stmt->bind_param('sssii', $nombre, $domicilio, $giro, $razon_social, $cliente_id);
}
//ejecutamos la consulta
if ($stmt->execute()) {
    header('Location: editar.php?id=' . $cliente_id . '&exito=Cliente%20actualizado%20correctamente');
} else {
    header('Location: editar.php?id=' . $cliente_id . '&error=Error%20al%20actualizar%20el%20cliente');
}

?>