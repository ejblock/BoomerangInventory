<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$name = $_POST['name'];

$sql = "INSERT INTO vendors VALUES(DEFAULT, ?)";

$q = $conn->prepare($sql);
$q->bind_param("s", $name);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: vendors.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>