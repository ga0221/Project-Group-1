<?php
    session_start();
    include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');

    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<?php

$user_id = $_SESSION['id'];
$orderID=$_GET['orderID'];

$result = mysqli_query($dbConnection, "UPDATE `order details` SET OrderStatus = 'Deleted' WHERE OrderID=$orderID");

header('location: Order_details_admin.php');
?>
