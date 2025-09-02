<?php
include 'checkLogin.php';
include 'config.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_POST['id'];
$name = $_POST['name'];

$sql = "DELETE FROM vendors WHERE id=?";
$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: vendors.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>