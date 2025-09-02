<?php
include 'checkLogin.php';

if ($_SESSION['person_status'] === 'barista') {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Add Product</h1>
    <form action="insertProduct.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="" required>
        <br>
        <label for="vendor_id">Vendor:</label>
        <select id="vendor_id" name="vendor_id" required>
            <!-- Populate Options -->
        </select>
        <br>
        <label for="description">Minimum:</label>
        <input type="text" id="description" name="description" value="" required>
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
                dropdown.appendChild(option);
            });

        }

        window.onload = fetchIDs;
    </script>
</body>
</html>