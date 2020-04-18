<?php

include('../../connect.php');

print_r($_POST);
if ($_POST['operation'] == "add_to_cart") {

    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    $conn->query("INSERT INTO `cart` (`buyer_id`, `shop_id`, `product_name`, `quantity_of_items`) VALUES ('$id', '$shop_id', '$product_name', '$quantity_of_items')");
}

if ($_POST['operation'] == "update_cart") {
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    if ($quantity_of_items > 0) {
        $conn->query("UPDATE `cart` SET `quantity_of_items` = '$quantity_of_items' WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
    } else {
        $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    }
}
if ($_POST['operation'] == "remove_from_cart") {

    $product_name = $_POST['product_name'];
    $shop_id = $_POST['shop_id'];

    $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    $conn->error;
}
?>
<script>
    $('.cart-btn .badge').load('request/count_carts.php');
</script>