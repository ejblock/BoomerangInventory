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
    <title>Vendors</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Vendors</h1>
        <button onclick="addVendor()">Add Vendor</button>
        <button onclick="back()">Back</button>
    <table id="vendorsTable">
        <thead>
            <tr>
                <th>Vendor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
    <script>
        async function fetchVendors() {
            const response = await fetch('fetchVendors.php');
            const products = await response.json();
            const tableBody = document.querySelector('#vendorsTable tbody');
            tableBody.innerHTML = '';
            products.forEach(vendor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${vendor.name}</td>
                    <td>
                        <button onclick="editVendor(${vendor.id})">Edit</button>
                        <button onclick="deleteVendor(${vendor.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function back() {
            window.location.href = `index.php`;
        }

        function addVendor() {
            window.location.href = `addVendor.php`;
        }

        function deleteVendor(id) {
            window.location.href = `deleteVendor.php?id=${id}`;
        }

        function editVendor(id) {
            window.location.href = `editVendor.php?id=${id}`;
        }

        window.onload = fetchVendors;
    </script>
</body>
</html>