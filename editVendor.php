<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM vendors WHERE id = ?";


$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($vendor_id, $name);

if ($q->fetch()) {
    
} else {
    die("Vendor not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Edit Vendor</h1>
    <form action="saveVendor.php" method="post">
        <input type="hidden" name="id" value="<?php echo $vendor_id; ?>">
        <label for="name">Vendor Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        <br>
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='vendors.php'">Cancel</button>
    </form>
</body>
</html>