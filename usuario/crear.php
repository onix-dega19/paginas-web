<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
include '../lib/conn.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$es_admin = isset($_POST['admin']) ? 1 : 0;


//validaciones campos vacios y contraeñas no coinciden
if(empty($nombre) || empty($correo) || empty($password) || empty($confirm_password)){
    echo "Todos los campos son obligatorios.";
} elseif($password !== $confirm_password){
    echo "Las contraseñas no coinciden.";
} else {
    // Insertar nuevo usuario en la base de datos
    
$password = md5($password);
    $sql = "INSERT INTO usuarios (nombre, correo, password, es_admin) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $correo, $password, $es_admin);
    
    if ($stmt->execute()) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear el usuario: " . $conexion->error;
    }
$stmt->close();
}
header("Location: nuevo.php?error=". urlencode($error) . "&exito=". urlencode($exito));
exit();
}
?>