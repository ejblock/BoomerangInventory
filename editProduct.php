<?php
include 'config.php';
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";

$q = $conn->prepare($sql);
$q->bind_param("i", $id);
$q->execute();
$q->bind_result($product_id, $vendor_id, $name, $description);

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
    <form action="saveProduct.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
        <label for="name">Product:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        <br>
        <label for="vendor_id">Vendor:</label>
        <select id="vendor_id" name="vendor_id" required>
            <!-- Populate Options -->
        </select>
        <br>
        <label for="description">Minimum:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
        <br>
        <button type="submit">Save</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>
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

        }

        window.onload = fetchIDs;
    </script>
</body>
</html>