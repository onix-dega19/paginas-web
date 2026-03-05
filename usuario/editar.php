<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

// Incluir conexión a la base de datos
require_once '../config/conexion.php';

$mensaje = '';
$tipo_mensaje = '';
$usuario = null;

// Obtener datos del usuario
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT id, nombre, email, es_admin FROM usuarios WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $stmt->close();
}

// Procesar formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $es_admin = $_POST['es_admin'];

    // Validar campos
    if (empty($nombre) || empty($email)) {
        $mensaje = 'El nombre y email son requeridos';
        $tipo_mensaje = 'error';
    } else {
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ?, es_admin = ? WHERE id = ?");
            $stmt->bind_param('sssii', $nombre, $email, $password_hash, $es_admin, $id);
        } else {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, es_admin = ? WHERE id = ?");
            $stmt->bind_param('ssii', $nombre, $email, $es_admin, $id);
        }

        if ($stmt->execute()) {
            $mensaje = 'Usuario actualizado correctamente';
            $tipo_mensaje = 'exito';
            // Recargar datos del usuario
            $stmt = $conexion->prepare("SELECT id, nombre, email, es_admin FROM usuarios WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();
        } else {
            $mensaje = 'Error al actualizar el usuario';
            $tipo_mensaje = 'error';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .contenedor { max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; text-align: center; }
        .formulario { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; color: #555; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.3); }
        .botones { display: flex; gap: 10px; justify-content: center; }
        button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-guardar { background: #28a745; color: white; }
        .btn-guardar:hover { background: #218838; }
        .btn-cancelar { background: #6c757d; color: white; text-decoration: none; text-align: center; }
        .btn-cancelar:hover { background: #5a6268; }
        .mensaje { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .mensaje.exito { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .mensaje.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Editar Usuario</h1>

        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo $tipo_mensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <?php if ($usuario): ?>
            <form method="POST" class="formulario">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                </div>

                <div>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>

                <div>
                    <label for="password">Contraseña (dejar en blanco para no cambiar):</label>
                    <input type="password" id="password" name="password">
                </div>

                <div>
                    <label for="es_admin">Rol:</label>
                    <select id="es_admin" name="es_admin" required>
                        <option value="0" <?php echo $usuario['es_admin'] == 0 ? 'selected' : ''; ?>>Usuario</option>
                        <option value="1" <?php echo $usuario['es_admin'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                    </select>
                </div>

                <div class="botones">
                    <button type="submit" class="btn-guardar">Guardar Cambios</button>
                    <a href="index.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: #999;">Usuario no encontrado</p>
        <?php endif; ?>
    </div>
</body>
</html>