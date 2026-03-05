<?php

if(isset($_GET['error'])){
    $error = urldecode($_GET['error']);
} 
if(isset($_GET['exito'])){ 
    $exito = urldecode($_GET['exito']);
}
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Nuevo Usuario</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(219, 39, 119, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-top: 4px solid #db2777;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #1a1a1a;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #db2777;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
            padding: 12px;
            background-color: #f9f9f9;
            border-radius: 6px;
            border: 2px solid #e0e0e0;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #db2777;
        }

        .checkbox-group label {
            margin: 0;
            cursor: pointer;
            font-weight: 500;
        }

        .checkbox-group input[type="checkbox"] + label {
            margin-bottom: 0;
        }

        .form-group.checkbox {
            margin-bottom: 25px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #db2777 0%, #c71f70 100%);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(219, 39, 119, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        .link-section {
            text-align: center;
            margin-top: 20px;
        }

        .link-section a {
            color: #db2777;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .link-section a:hover {
            color: #c71f70;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container"method="POST" action="crear.php">
        <div class="header">
            <h1>Nuevo Usuario</h1>
            <p>Completa el formulario para registrarte</p>
        </div>

        <form method="POST" action="crear.php">
            <div class="form-group">
                <label for="nombre">Nombre de Usuario</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre de usuario" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required>
            </div>

            <div class="form-group checkbox">
                <label>Tipo de Usuario</label>
                <div class="checkbox-group">
                    <input type="checkbox" id="admin" name="admin" value="1">
                    <label for="admin">Administrador</label>
                </div>
            </div>

            <button type="submit">Registrar Usuario</button>

            <div class="link-section">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
</body>
</html>