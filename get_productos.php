<?php
header("Content-Type: application/json");
include 'db.php';

$sql = "SELECT id_producto, descripcion_producto, precio, imagen FROM productos";
$result = $conn->query($sql);

$productos = array();
while ($row = $result->fetch_assoc()) {
    // Solo devolver la ruta de la imagen
    if (!empty($row["imagen"]) && file_exists($row["imagen"])) {
        $row["imagen"] = $row["imagen"]; // Mantiene la URL sin convertir a Base64
    } else {
        $row["imagen"] = null; // Si no hay imagen
    }

    $productos[] = $row;
}

echo json_encode($productos, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$conn->close();
?>
