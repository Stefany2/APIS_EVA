<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["descripcion"], $data["monto"])) {
    $descripcion = $conn->real_escape_string($data["descripcion"]);
    $monto = floatval($data["monto"]);

    $sql = "INSERT INTO registrar_gastos (descripcion, monto) VALUES ('$descripcion', '$monto')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Gasto registrado exitosamente"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}
$conn->close();
?>
