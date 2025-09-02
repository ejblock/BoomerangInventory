<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT products.id AS id, products.name AS product_name, vendors.name 
            AS vendor_name, products.description AS product_description FROM products 
        JOIN vendors ON products.vendor_id = vendors.id 
        WHERE products.id = ?";

$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($product_id, $product_name, $vendor_name, $product_description);

if ($q->fetch()) {

} else {
    die("Product not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Delete</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Are you sure?</h1>
    <form action="checkDeleteProduct.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
        <label for="name">Product:</label>
        <input readonly type="text" id="name" name="name" value="<?php echo $product_name; ?>" required>
        <br>
        <label for="vendor_name">Vendor:</label>
        <input readonly type="text" id="vendor_name" name="vendor_name" value="<?php echo $vendor_name; ?>" required>
        <br>
        <label for="description">Minimum:</label>
        <input readonly type="text" id="description" name="description" value="<?php echo $product_description; ?>" required>
        <br>
        <button type="submit">Confirm Delete</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>
    </form>
</body>
</html>