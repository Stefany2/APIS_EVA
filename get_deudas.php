<?php
include 'db.php';

$sql = "SELECT * FROM registrar_deudas";
$result = $conn->query($sql);

$deudas = array();
while ($row = $result->fetch_assoc()) {
    $deudas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($deudas);
?>
