<?php include('../../connect.php');

if ($_POST['operation'] == "add") {
    $product_name = $_POST['product_name'];
    $conn->query("INSERT INTO `packed_products` (`shop_id`, `product_name`, `quantity_of_items`, `price_per_item`) VALUES ('$id', '$product_name', '0', '0')");
}
if ($_POST['operation'] == "remove") {
    $product_name = $_POST['product_name'];
    $conn->query("DELETE FROM `packed_products` WHERE `shop_id`='$id' AND `product_name`='$product_name' ");
}
if ($_POST['operation'] == "check") {
    $product_name = $_POST['product_name'];
    $result = $conn->query("SELECT * FROM `packed_products` WHERE shop_id='$id' AND product_name='$product_name'");
    echo $result->num_rows;
}
if ($_POST['operation'] == "get_data") {
    $product_name = $_POST['product_name'];
    $result = $conn->query("SELECT * FROM `packed_products` WHERE shop_id='$id' AND product_name='$product_name'");
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
if ($_POST['operation'] == "update_product") {
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];
    $price_per_item = $_POST['price_per_item'];

    $conn->query("UPDATE `packed_products` SET `quantity_of_items` = '$quantity_of_items', `price_per_item` = '$price_per_item' WHERE `shop_id` = '$id' AND `product_name` = '$product_name'");
}