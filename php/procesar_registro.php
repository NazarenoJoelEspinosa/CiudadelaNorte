<?php
// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'club_ciudadela_norte';

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Evitar inyecciones SQL usando prepared statements
$stmt = $conn->prepare("INSERT INTO socios (nombre, email, telefono, direccion) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $email, $telefono, $direccion);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro exitoso. ¡Bienvenido al Club Ciudadela Norte!";
} else {
    echo "Error al registrar: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
