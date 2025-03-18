<?php
include 'db.php';

$sql = "SELECT * FROM registrar_gastos";
$result = $conn->query($sql);

$gastos = array();
while ($row = $result->fetch_assoc()) {
    $gastos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($gastos);
?>
