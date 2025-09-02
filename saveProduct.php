<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_POST['id'];
$vendor_id = $_POST['vendor_id'];
$name = $_POST['name'];
$description = $_POST['description'];

$sql = "UPDATE products SET vendor_id=?, name=?, description=? WHERE id=?";

$q = $conn->prepare($sql);
$q->bind_param("issi", $vendor_id, $name, $description, $id);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: index.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>