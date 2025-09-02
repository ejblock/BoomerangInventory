<?php
include 'checkLogin.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Daily Inventory</h1>
        <button onclick="back()">Back</button>
    <table id="productsTable">
        <thead>
            <tr>
                <th>Item</th>
                <th>Minimum</th>
                <th>Order Item</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
    <script>
        async function fetchProducts() {
            const response = await fetch('fetchDaily.php');
            const products = await response.json();
            const tableBody = document.querySelector('#productsTable tbody');
            tableBody.innerHTML = '';
            products.forEach(product => {
                const row = document.createElement('tr');
                if ("<?php echo $_SESSION['person_status']; ?>" === 'manager') {
                    row.innerHTML = `
                        <td>${product.name}</td>
                        <td>${product.description}</td>
                        <td>
                            <button onclick="order(${product.id})">Order</button>
                            <button onclick="editProduct(${product.id})">Edit</button>
                            <button onclick="deleteProduct(${product.id})">Delete</button>
                        </td>
                    `;
                }
                else {
                    row.innerHTML = `
                        <td>${product.name}</td>
                        <td>${product.description}</td>
                        <td>
                            <button onclick="order(${product.id})">Order</button>
                    `;
                }
                tableBody.appendChild(row);
            });
        }

        function back() {
            window.location.href = `index.php`;
        }

        function order(id) {
            window.location.href = `order.php?id=${id}`;
        }

        function editProduct(id) {
            window.location.href = `editProduct.php?id=${id}`;
        }

        function deleteProduct(id) {
            window.location.href = `deleteProduct.php?id=${id}`;
        }

        window.onload = fetchProducts;
    </script>
</body>
</html>