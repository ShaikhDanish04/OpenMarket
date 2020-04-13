<?php include("../../connect.php");

if ($_POST['operation'] == 'clear_token_history') {
    $shop_id = $_POST['shop_id'];
    // print_r($_POST);

    $result_token = $conn->query("SELECT * FROM `token_list` WHERE shop_id = '$shop_id' AND (`status` != 'active' AND `status` != 'pending')");
    while ($token_row = $result_token->fetch_assoc()) {
        $token_number = $token_row['token_number'];
        $buyer_id = $token_row['buyer_id'];

        $conn->query("DELETE FROM `token_list` WHERE `token_number` = '$token_number' AND `shop_id` = '$id'");
        echo $conn->error;
    }





    // $shop_id = $token_row['shop_id'];
    // print_r($token_row);

    // $result_cart = $conn->query("SELECT * FROM `cart` WHERE token_number='$token_number' AND shop_id='$shop_id' AND `status`= 'tokened'");
    // while ($cart_row = $result_cart->fetch_assoc()) {
    //     $procuct_name = $cart_row['product_name'];
    //     $product_row = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$procuct_name'")->fetch_assoc();

    //     $new_quantity_of_items = $product_row['quantity_of_items'] + $cart_row['quantity_of_items'];

    //     $conn->query("UPDATE `seller_product_stock` SET `quantity_of_items`='$new_quantity_of_items' WHERE product_name='$procuct_name'");
    //     $conn->query("UPDATE cart SET token_number = '$token_number', `status` = 'in' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND product_name = '$procuct_name'");
    //     $conn->query("UPDATE token_list SET `status` = 'deleted' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND token_number='$token_number'");
    // }
}
