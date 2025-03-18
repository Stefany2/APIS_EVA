<?php
include 'db.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$usuarios = array();
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($usuarios);
?>
