<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT orders.id AS id, products.name AS product_name, vendors.name 
            AS vendor_name, orders.quantity AS quantity, orders.date AS order_date FROM orders 
        JOIN vendors ON orders.vendor_id = vendors.id 
        JOIN products ON orders.product_id = products.id
        WHERE orders.id = ?";

$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($order_id, $product_name, $vendor_name, $quantity, $date);

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
    <form action="checkDeleteOrder.php" method="post">
        <input type="hidden" name="id" value="<?php echo $order_id; ?>">
        <label for="name">Product:</label>
        <input readonly type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" required>
        <br>
        <label for="vendor_name">Vendor:</label>
        <input readonly type="text" id="vendor_name" name="vendor_name" value="<?php echo $vendor_name; ?>" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input readonly type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>
        <br>
        <label for="date">Date:</label>
        <input readonly type="date" id="date" name="date" value="<?php echo $date; ?>" required>
        <br>
        <button type="submit">Confirm Delete</button>
        <button type="button" onclick="window.location.href='viewOrders.php'">Cancel</button>
    </form>
</body>
</html>