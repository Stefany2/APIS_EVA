<?php
$host = "localhost"; // Dirección del servidor MySQL
$username = "root"; // Tu nombre de usuario de MySQL
$password = ""; // Tu contraseña de MySQL
$database = "bd_eva"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
