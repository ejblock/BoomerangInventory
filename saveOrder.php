<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_POST['order_id'];
$product_id = $_POST['product_id'];
$vendor_id = $_POST['vendor_id'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];

$sql = "UPDATE orders SET product_id=?, vendor_id=?, quantity=?, date=? WHERE id=?";

$q = $conn->prepare($sql);
$q->bind_param("iiisi", $product_id, $vendor_id, $quantity, $date, $id);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: index.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>