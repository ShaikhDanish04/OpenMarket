<?php

include('../../connect.php');

if ($_POST['operation'] == "add_order") {

    $buyer_id = $_POST['buyer_id'];
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    $conn->query("INSERT INTO `product_in_buyers_list` (`buyer_id`, `shop_id`, `product_name`, `quantity_of_items`) VALUES ('$buyer_id', '$shop_id', '$product_name', '$quantity_of_items')");
}

if ($_POST['operation'] == "get_order_list") {

    $shop_id = $_POST['shop_id'];
    $result = $conn->query("SELECT * FROM `product_in_buyers_list` WHERE shop_id='$shop_id'");
    while ($row = $result->fetch_assoc()) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
}
