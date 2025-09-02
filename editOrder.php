<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE id = ?";

$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($order_id, $product_id, $vendor_id, $quantity, $date);

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
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="saveOrder.php" method="post">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <label for="product_id">Product:</label>
        <select id="product_id" name="product_id" required>
            <!-- Populate Options -->
        </select>
        <br>
        <label for="vendor_id">Vendor:</label>
        <select id="vendor_id" name="vendor_id" required>
            <!-- Populate Options -->
        </select>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
        <br>
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='viewOrders.php'">Cancel</button>
    </form>
    <script>
        async function fetchIDs() {
            const response = await fetch('fetchVendors.php');
            const vendors = await response.json();
            const dropdown = document.querySelector('#vendor_id');
            vendors.forEach(vendor => {
                const option = document.createElement('option');
                option.value = vendor.id;
                option.textContent = vendor.name;
                if (vendor.id == <?php echo $vendor_id; ?>) {
                    option.selected = true;
                }
                else {
                    option.selected = false;
                }
                dropdown.appendChild(option);
            });

            const responseProduct = await fetch('fetchProducts.php');
            const products = await responseProduct.json();
            const dropdownProduct = document.querySelector('#product_id');
            products.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.name;
                if (product.id == <?php echo $product_id; ?>) {
                    option.selected = true;
                }
                else {
                    option.selected = false;
                }
                dropdownProduct.appendChild(option);
            });

        }

        window.onload = fetchIDs;
    </script>
</body>
</html>