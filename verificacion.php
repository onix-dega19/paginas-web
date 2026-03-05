<?php
echo "Verificación completada exitosamente";

//valida que el formulario se haya enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //tomar los datos tipo post del formulario
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    if (empty($correo) || empty($password)) {
        echo "El campo de correo electrónico está vacío.";
        exit;
    }        

include("lib/conn.php");
}
//consulta para verificar si el correo y contraseña existen en la base de datos usando prepare statement
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ? AND password = ?");
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    //si el usuario existe, iniciar sesión y redirigir a la página de inicio
    session_start();
    $_SESSION["usuario_id"] = $result->fetch_assoc()["id"];
    header("Location: usuario/index3.php");
} else {
    //si el usuario no existe, mostrar mensaje de error
    echo "Correo electrónico o contraseña incorrectos.";
}
?>