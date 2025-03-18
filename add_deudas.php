<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["nombres"], $data["dni"], $data["monto"])) {
    $nombres = $conn->real_escape_string($data["nombres"]);
    $dni = $conn->real_escape_string($data["dni"]);
    $monto = floatval($data["monto"]);

    $sql = "INSERT INTO registrar_deudas (nombres, dni, monto) VALUES ('$nombres', '$dni', '$monto')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["mensaje" => "Deuda registrada exitosamente"]);
    } else {
        echo json_encode(["error" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}
$conn->close();
?>
