<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa Dashboard</title>
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
    <header>
        <h1>Empresa Dashboard</h1>
        <button class="login-btn" onclick="location.href='login2.html'">Login</button>
    </header>
    
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#reportes">Reportes</a></li>
                    <li><a href="#usuarios">Usuarios</a></li>
                    <li><a href="#configuracion">Configuración</a></li>
                    <li><a href="#ayuda">Ayuda</a></li>
                </ul>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="content-box">
                <h2>Bienvenido al Dashboard</h2>
                <p>Selecciona una opción del menú lateral para comenzar.</p>
            </div>
        </main>
    </div>
    
    <footer>
        <p>&copy; 2024 Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>