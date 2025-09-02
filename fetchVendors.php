<?php
include 'config.php';
include 'checkLogin.php';

$sql = "SELECT * FROM vendors";
$result = $conn->query($sql);
$vendors = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $vendors[] = $row;
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($vendors);
?>