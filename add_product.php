<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["descripcion_producto"], $data["precio"], $data["imagen"])) {
    $descripcion = $conn->real_escape_string($data["descripcion_producto"]);
    $precio = floatval($data["precio"]);
    $imagenBase64 = $data["imagen"];

    // Insertar en la base de datos sin la imagen (para obtener el ID)
    $sql = "INSERT INTO productos (descripcion_producto, precio) VALUES ('$descripcion', '$precio')";
    
    if ($conn->query($sql) === TRUE) {
        $id_producto = $conn->insert_id; // Obtener el ID generado

        // Guardar la imagen con el ID del producto
        $imagenNombre = "producto_" . $id_producto . ".png";
        $rutaImagen = "imagenes/" . $imagenNombre;

        if (file_put_contents($rutaImagen, base64_decode($imagenBase64))) {
            // Actualizar la base de datos con la ruta de la imagen
            $sqlUpdate = "UPDATE productos SET imagen = '$rutaImagen' WHERE id_producto = $id_producto";
            $conn->query($sqlUpdate);

            echo json_encode([
                "mensaje" => "Producto registrado exitosamente",
                "id_producto" => $id_producto,
                "imagen" => $rutaImagen
            ]);
        } else {
            echo json_encode(["error" => "Error al guardar la imagen"]);
        }
    } else {
        echo json_encode(["error" => "Error en la inserción: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Datos incompletos"]);
}

$conn->close();
?>
