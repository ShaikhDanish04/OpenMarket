<?php include("../../connect.php");

if ($_POST['operation'] == 'generate_token') {

    $shop_id = $_POST['shop_id'];
    $result = $conn->query("SELECT * FROM `token_list` WHERE shop_id='$shop_id' ORDER BY token_number DESC LIMIT 1");
    $row = $result->fetch_assoc();

    if ($row['token_number'] == null) {
        $token_number = 1;
    } else {
        $token_number = $row['token_number'] + 1;
    }

    $result = $conn->query("SELECT * FROM `cart` WHERE shop_id='$shop_id' AND buyer_id = '$id'");
    while ($row = $result->fetch_assoc()) {
        $product_name = $row['product_name'];
        $quantity_of_items = $row['quantity_of_items'];


        $conn->query("INSERT INTO token_list (`token_number`,`shop_id`,`buyer_id`,`product_name`,quantity_of_items,`datetime`,`type`) 
                      VALUES ('$token_number','$shop_id','$id','$product_name',$quantity_of_items,'$datetime','self-service')");
        echo $conn->error;

        $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$id' AND `shop_id` = '$shop_id' AND `product_name` = '$product_name'");

        $product_row = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$product_name'")->fetch_assoc();
        // print_r($product_row);

        echo $new_quantity_of_items = $product_row['quantity_of_items'] - $row['quantity_of_items'];

        $conn->query("UPDATE `seller_product_stock` SET `quantity_of_items`='$new_quantity_of_items' WHERE product_name='$product_name'");
        echo $conn->error;
    }
}

if ($_POST['operation'] == 'delete_token') {
    print_r($_POST);
    $token_number = $_POST['token_number'];
    $shop_id = $_POST['shop_id'];

    $token_result = $conn->query("SELECT * FROM `token_list` WHERE token_number='$token_number' AND buyer_id='$id' AND shop_id='$shop_id'");

    while ($token_row = $token_result->fetch_assoc()) {
        $product_name = $token_row['product_name'];
        $product_row = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$product_name'")->fetch_assoc();

        $new_quantity_of_items = $product_row['quantity_of_items'] + $token_row['quantity_of_items'];

        $conn->query("UPDATE `seller_product_stock` SET `quantity_of_items`='$new_quantity_of_items' WHERE product_name='$product_name'");
        $conn->query("UPDATE token_list SET `status` = 'deleted' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND token_number='$token_number'");
    }
}
