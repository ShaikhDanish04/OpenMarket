<?php

include('../../connect.php');

if ($_POST['operation'] == "add_to_cart") {

    $buyer_id = $_SESSION['id'];
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    $result = $conn->query("SELECT * FROM cart WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
    $row = $result->fetch_assoc();
    if ($quantity_of_items == 0) {
        $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$buyer_id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    }

    if ($result->num_rows > 0) {
        $conn->query("UPDATE `cart` SET `quantity_of_items` = '$quantity_of_items' WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
        echo "echo";
    } else {
        $conn->query("INSERT INTO `cart` (`buyer_id`, `shop_id`, `product_name`, `quantity_of_items`) VALUES ('$buyer_id', '$shop_id', '$product_name', '$quantity_of_items')");
    }
}

if ($_POST['operation'] == "remove_from_cart") {

    $buyer_id = $_SESSION['id'];
    $product_name = $_POST['product_name'];
    $shop_id = $_POST['shop_id'];

    $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$buyer_id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    $conn->error;
}
