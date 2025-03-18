<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["descripcion_producto"], $data["precio"])) {
    $descripcion = $conn->real_escape_string($data["descripcion_producto"]);
    $precio = floatval($data["precio"]);

    $sql = "INSERT INTO productos (descripcion_producto, precio) VALUES ('$descripcion', '$precio')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Producto registrado exitosamente"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}
$conn->close();
?>
