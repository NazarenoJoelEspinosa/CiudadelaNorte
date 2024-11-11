<?php
// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'club_ciudadela_norte';

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    die("Hubo un problema, intenta nuevamente más tarde.");
}

// Obtener y validar los datos del formulario
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$direccion = trim($_POST['direccion']);
$deporte = trim($_POST['deporte']);
$fecha_nacimiento = $_POST['fecha_nacimiento'];

if (empty($nombre) || empty($email) || empty($telefono) || empty($direccion) || empty($deporte) || empty($fecha_nacimiento)) {
    die("Todos los campos son obligatorios.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Formato de email no válido.");
}

// Preparar la consulta SQL
$stmt = $conn->prepare("INSERT INTO socios (nombre, email, telefono, direccion, deporte, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nombre, $email, $telefono, $direccion, $deporte, $fecha_nacimiento);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro exitoso. ¡Bienvenido al Club Ciudadela Norte!";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
