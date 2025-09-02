<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_POST['id'];
$name = $_POST['name'];


$sql = "UPDATE vendors SET name=? WHERE id=?";



$q = $conn->prepare($sql);
$q->bind_param("si", $name, $id);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: vendors.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>