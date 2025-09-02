<?php
include 'checkLogin.php';
include 'config.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_POST['id'];

$sql = "DELETE FROM products WHERE id=?";
$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();

if ($q->affected_rows> 0) {
    header('Location: index.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>