<?php
include('connection.php');
$retrieveQuery = "Select * from product";
$stmt = $dbconnection->prepare($retrieveQuery);
$stmt->execute();
$resultSet = $stmt->get_result();
$data = $resultSet->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['ac'])) {
    if (!isset($_SESSION['uname'])) {
        echo "<script>alert('Please Login First To Order items...')</script>";
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], "pid");
            if (in_array($_POST['id'], $item_array_id)) {
                echo "<script>alert('Product is already added in the cart..!')</script>";    
            } else {
                // $count = count($_SESSION['cart']);
                // $item_array = array('pid' => $_POST['id']);
                // $_SESSION['cart'][$count] = $item_array;
                echo "<script>alert('Please Order First')</script>";    
            }
        } 
        else {
            $item_array = array('pid' => $_POST['id']);
            // Create new session variable
            $_SESSION['cart'][0] = $item_array;
        }
    }
}
