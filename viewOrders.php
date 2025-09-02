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
    <title>Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Past Orders</h1>
        <button onclick="back()">Back</button>
    <table id="ordersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Vendor</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
    <script>
        async function fetchOrders() {
            const response = await fetch('fetchOrders.php');
            const shots = await response.json();
            const tableBody = document.querySelector('#ordersTable tbody');
            tableBody.innerHTML = '';
            shots.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.id}</td>
                    <td>${order.product_name}</td>
                    <td>${order.vendor_name}</td>
                    <td>${order.quantity}</td>
                    <td>${order.order_date}</td>
                    <td>
                        <button onclick="editOrder(${order.id})">Edit</button>
                        <button onclick="deleteOrder(${order.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }
        
        function back() {
            window.location.href = `index.php`;
        }

        function editOrder(id) {
            window.location.href = `editOrder.php?id=${id}`;
        }

        function deleteOrder(id) {
            window.location.href = `deleteOrder.php?id=${id}`;
        }

        window.onload = fetchOrders;
    </script>
</body>
</html>