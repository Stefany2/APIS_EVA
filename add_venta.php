<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["nombres"], $data["descripcion"], $data["precio"], $data["cantidad"])) {
    $nombres = $conn->real_escape_string($data["nombres"]);
    $descripcion = $conn->real_escape_string($data["descripcion"]);
    $precio = floatval($data["precio"]);
    $cantidad = intval($data["cantidad"]);
    $total = $precio * $cantidad;

    $sql = "INSERT INTO registrar_ventas (nombres, descripcion, precio, cantidad, total) VALUES ('$nombres', '$descripcion', '$precio', '$cantidad', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Venta registrada exitosamente"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}
$conn->close();
?>
