<?php
session_start();


$usuario_id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$es_admin = isset($_POST['es_admin']) ? 1 : 0;

if (empty($nombre) || empty($correo) || empty($usuario_id)) {
    header('Location: editar.php?id=' . $usuario_id . '&error=Campos%20requeridos');
    exit;
} else {
    // Insertar nuevo usuario en la base de datos

    $sql = "INSERT INTO usuarios (nombre, correo, password, es_admin) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $password, $es_admin);

    if ($stmt->execute()) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear el usuario: " . $conexion->error;
    }
    exit();
$stmt->close();
}

?>