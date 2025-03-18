<?php
include 'db.php';

$sql = "SELECT * FROM registrar_ventas";
$result = $conn->query($sql);

$ventas = array();
while ($row = $result->fetch_assoc()) {
    $ventas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($ventas);
?>
