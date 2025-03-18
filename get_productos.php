<?php
header("Content-Type: application/json");
include 'db.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array();
while ($row = $result->fetch_assoc()) {
    // Convertir la imagen en Base64 si existe
    if (!empty($row["imagen"]) && file_exists($row["imagen"])) {
        $row["imagen"] = base64_encode(file_get_contents($row["imagen"]));
    } else {
        $row["imagen"] = null; // Si no hay imagen
    }

    $productos[] = $row;
}

echo json_encode($productos);
$conn->close();
?>
