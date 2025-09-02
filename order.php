<?php
include 'config.php';
include 'checkLogin.php';

$id = $_GET['id'];
$sql = "SELECT products.name AS product_name, vendors.name AS vendor_name, products.id AS id, vendors.id AS vendor_id 
        FROM products JOIN vendors 
        ON vendors.id = products.vendor_id
        WHERE products.id = ?";

$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($product_name, $vendor_name, $product_id, $vendor_id);

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
    <title>Order</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">    
    <h1>Order Product</h1>
    <form action="confirmOrder.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
        <input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $vendor_id; ?>" required>
        <label for="name">Item:</label>
        <input readonly type="text" id="name" name="name" value="<?php echo $product_name; ?>" required>
        <br>
        <label for="vendor_id">Vendor:</label>
        <input readonly type="text" id="vendor_name" name="vendor_name" value="<?php echo $vendor_name; ?>" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="" required>
        <br>
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>
    </form>
</body>
</html>