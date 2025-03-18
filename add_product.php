<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["descripcion_producto"], $data["precio"], $data["imagen"])) {
    $descripcion = $conn->real_escape_string($data["descripcion_producto"]);
    $precio = floatval($data["precio"]);
    $imagenBase64 = $data["imagen"];

    // Decodificar la imagen Base64 y guardarla en una carpeta
    $imagenNombre = "producto_" . time() . ".png";
    $rutaImagen = "imagenes/" . $imagenNombre;

    if (file_put_contents($rutaImagen, base64_decode($imagenBase64))) {
        // Insertar en la base de datos
        $sql = "INSERT INTO productos (descripcion_producto, precio, imagen) VALUES ('$descripcion', '$precio', '$rutaImagen')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["mensaje" => "Producto registrado exitosamente", "imagen" => $rutaImagen]);
        } else {
            echo json_encode(["error" => "Error en la inserción: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Error al guardar la imagen"]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>
