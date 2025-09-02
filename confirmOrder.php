<?php
include 'config.php';
include 'checkLogin.php';

$product_id = $_POST['id'];
$vendor_id = $_POST['vendor_id'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO orders VALUES (DEFAULT, ?, ?, ?, CURDATE())";
$q = $conn->prepare($sql);
$q->bind_param("iii", $product_id, $vendor_id, $quantity);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: index.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>