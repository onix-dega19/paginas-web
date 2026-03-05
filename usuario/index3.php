<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login2.html');
    exit;
}

// Simulación de datos de usuarios (en producción, obtener de base de datos)
$usuarios = [
    ['id' => 1, 'nombre' => 'Juan Pérez', 'email' => 'juan@example.com', 'rol' => 'Administrador'],
    ['id' => 2, 'nombre' => 'María García', 'email' => 'maria@example.com', 'rol' => 'Editor'],
    ['id' => 3, 'nombre' => 'Carlos López', 'email' => 'carlos@example.com', 'rol' => 'Usuario'],
    ['id' => 4, 'nombre' => 'Ana Martínez', 'email' => 'ana@example.com', 'rol' => 'Editor'],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #007bff; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #ddd; }
        tr:hover { background-color: #f9f9f9; }
        .acciones { display: flex; gap: 8px; }
        .btn { padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-editar { background-color: #28a745; color: white; }
        .btn-editar:hover { background-color: #218838; }
        .btn-eliminar { background-color: #dc3545; color: white; }
        .btn-eliminar:hover { background-color: #c82333; }
        .btn-nuevo { background-color: #007bff; color: white; padding: 10px 20px; margin-bottom: 20px; }
        .btn-nuevo:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>
        <button class="btn btn-nuevo" onclick="window.location.href='crear.php'">+ Nuevo Usuario</button>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                    <td>
                        <div class="acciones">
                            <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-editar">Editar</a>
                            <a href="eliminar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>