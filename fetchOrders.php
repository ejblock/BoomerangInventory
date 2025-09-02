<?php
include 'config.php';
include 'checkLogin.php';
$sql = "SELECT vendors.name AS vendor_name, products.name AS product_name, orders.id AS id, orders.quantity AS quantity, orders.date AS order_date
        FROM orders 
        JOIN vendors ON orders.vendor_id = vendors.id
        JOIN products ON products.id = orders.product_id";
$result = $conn->query($sql);
$shots = array();
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$shots[] = $row;
}
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($shots);
?>