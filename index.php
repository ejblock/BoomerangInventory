<?php
include 'checkLogin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boomerang Inventory</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <img src="logo.png" alt="Company Logo" width="500" height="250">
    <h1>Inventory Management</h1>
        <button onclick="seeOnline()">Online Inventory</button>
        <button onclick="seeSysco()">Sysco Inventory</button>
        <button onclick="seeBlackDiesel()">Black Diesel Inventory</button>
        <button onclick="seeWholesale()">Wholesale Inventory</button>
        <button onclick="seeDaily()">Daily Inventory</button>

    <div id="manager">
    <!-- Manager tools populated !-->
    </div>  
    <br>
    <br>
    <br>   
    <button onclick="logOut()">Log Out</button>
    <script>
        function seeOnline() {
            window.location.href = `online.php`;
        }

        function seeSysco() {
            window.location.href = `sysco.php`;
        }

        function seeBlackDiesel() {
            window.location.href = `blackDiesel.php`;
        }

        function seeWholesale() {
            window.location.href = `wholesale.php`;
        }

        function seeDaily() {
            window.location.href = `daily.php`;
        }

        function seeOrders() {
            window.location.href = `viewOrders.php`;
        }

        function seeVendors() {
            window.location.href = `vendors.php`;
        }

        function addProduct() {
            window.location.href = `addProduct.php`;
        }

        function logOut() {
           window.location.href = `logout.php`; 
        }

        function managerTools() {
            if ("<?php echo $_SESSION['person_status']; ?>" === 'manager') {
                const row = document.querySelector('#manager');
                row.innerHTML = `
                        <br>
                        <br>
                        <br>
                        <h1>Advanced Tools</h1>
                        <button onclick="seeOrders()">Orders</button>
                        <button onclick="seeVendors()">See Vendors</button>
                        <button onclick="addProduct()">Add Product</button>
                `;
            }
        }
        
        window.onload = managerTools;
    </script>
</body>
    </html>
