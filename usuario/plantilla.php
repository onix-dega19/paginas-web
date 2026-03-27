<?php
session_start();
// Valida que el usuario este inicado
if (!isset($_SESSION["usuario"])) {
    //header("Location: ../login.php");
    //exit;
}

require_once '../lib/conn.php';

// Obtener usuarios de la base de datos
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$result = $conexion->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de usuario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        h1 {
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn-nuevo {
            background-color: #28a745;
            color: white;
        }
        .btn-nuevo:hover {
            background-color: #218838;
            color: white;
        }
        .tabla-usuarios {
            font-size: 0.95rem;
        }
        .tabla-usuarios thead {
            background-color: #007bff;
            color: white;
        }
        .tabla-usuarios tbody tr:hover {
            background-color: #f5f5f5;
        }
        .acciones {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.85rem;
        }

        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        header h1 {
            font-size: 24px;
        }
        
        .login-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .login-btn:hover {
            background-color: #2980b9;
        }
        
        .container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        .sidebar {
            background-color: #34495e;
            color: white;
            width: 250px;
            padding: 20px;
        }
        
        .sidebar nav ul {
            list-style: none;
        }
        
        .sidebar nav ul li {
            margin: 15px 0;
        }
        
        .sidebar nav ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .sidebar nav ul li a:hover {
            background-color: #2c3e50;
        }
        
        .main-content {
            flex: 1;
            padding: 30px;
        }
        
        .content-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <?php
    include ('../templates/header.php')
    ?>
    
    
    <div class="container">
        <?php
    include ('../templates/sidebar.php')
    ?>
        <main class="main-content">
            <div class="content-box">
                <h2>listado de usuarios</h2>
                <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; 
            unset($_SESSION['mensaje']);
        ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (count($usuarios) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover tabla-usuarios">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['id']; ?></td>
                                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                                <td><?php echo ($usuario['es_admin'] == 1) ? 'Administrador' : 'Usuario'; ?></td>
                                <td>
                                    <div class="acciones">
                                        <a href="ver.php?id=<?php echo $usuario['id']; ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="delete.php" 
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                ><i class="fas fa-trash"></i></button>
                                            <input id="id" name="id" type="hidden" 
                                                value="<?php echo $usuario['id']; ?>">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay usuarios registrados
            </div>
        <?php endif; ?>
    </div>
            
</div>
        </main>
    </div>
     <?php
    include ('../templates/footer.php')
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>