<?php include("../../connect.php");

if ($_POST['operation'] == 'generate_token') {

    $shop_id = $_POST['shop_id'];
    $result = $conn->query("SELECT * FROM `token_list` WHERE shop_id='$shop_id'  ORDER BY token_number DESC LIMIT 1");
    $row = $result->fetch_assoc();

    if ($row['token_number'] == null) {
        $token_number = 1;
    } else {
        $token_number = $row['token_number'] + 1;
    }

    if ($conn->query("INSERT INTO token_list (`token_number`,`shop_id`,`buyer_id`) VALUES ('$token_number','$shop_id','$id')") === TRUE) {
        $result = $conn->query("SELECT * FROM `cart` WHERE shop_id='$shop_id' AND `status`='in'");
        while ($row = $result->fetch_assoc()) {
            $procuct_name = $row['product_name'];

            $product_result = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$procuct_name'");
            $product_row = $product_result->fetch_assoc();

            $new_quantity_of_items = $product_row['quantity_of_items'] - $row['quantity_of_items'];

            $conn->query("UPDATE `seller_product_stock` SET `quantity_of_items`='$new_quantity_of_items' WHERE product_name='$procuct_name'");
            $conn->query("UPDATE cart SET token_number = '$token_number', `status` = 'tokened' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND product_name = '$procuct_name'");
        }
    }
}

if ($_POST['operation'] == 'delete_token') {
    $token_number = $_POST['token_number'];
    $shop_id = $_POST['shop_id'];

    $token_row = $conn->query("SELECT * FROM `token_list` WHERE token_number='$token_number' AND shop_id='$shop_id'")->fetch_assoc();
    $shop_id = $token_row['shop_id'];
    print_r($token_row);

    $result_cart = $conn->query("SELECT * FROM `cart` WHERE token_number='$token_number' AND shop_id='$shop_id' AND `status`= 'tokened'");
    while ($cart_row = $result_cart->fetch_assoc()) {
        $procuct_name = $cart_row['product_name'];
        $product_row = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$procuct_name'")->fetch_assoc();

        $new_quantity_of_items = $product_row['quantity_of_items'] + $cart_row['quantity_of_items'];

        $conn->query("UPDATE `seller_product_stock` SET `quantity_of_items`='$new_quantity_of_items' WHERE product_name='$procuct_name'");
        $conn->query("UPDATE cart SET token_number = NULL, `status` = 'in' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND product_name = '$procuct_name'");
        $conn->query("UPDATE token_list SET `status` = 'deleted' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND token_number='$token_number'");
    }
}
