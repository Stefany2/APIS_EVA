<?php
include('db.php');

// Leer los datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos necesarios están presentes
if (isset($data['nombre']) && isset($data['correo_electronico']) && isset($data['contrasena'])) {
    $nombre = $data['nombre'];
    $correo_electronico = $data['correo_electronico'];
    $contrasena = $data['contrasena'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo_electronico, contrasena) VALUES ('$nombre', '$correo_electronico', '$contrasena')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Usuario agregado exitosamente"]);
    } else {
        echo json_encode(["error" => "Error al agregar usuario: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos o incorrectos"]);
}
?>
