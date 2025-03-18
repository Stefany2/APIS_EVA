<?php
include 'db.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

$productos = array();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($productos);
?>
