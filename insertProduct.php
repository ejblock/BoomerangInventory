<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$name = $_POST['name'];
$vendor_id = $_POST['vendor_id'];
$description = $_POST['description'];

$sql = "INSERT INTO products VALUES(DEFAULT, ?, ?, ?)";


$q = $conn->prepare($sql);
$q->bind_param("iss", $vendor_id, $name, $description);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: index.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>