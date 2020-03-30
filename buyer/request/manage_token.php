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

    if($conn->query("INSERT INTO token_list (`token_number`,`shop_id`,`buyer_id`) VALUES ('$token_number','$shop_id','$id')") === TRUE) {

        $result = $conn->query("SELECT * FROM `cart` WHERE shop_id='$shop_id' AND `status`='in'");
        while ($row = $result->fetch_assoc()) {
            $procuct_name = $row['product_name'];
            if($conn->query("UPDATE cart SET token_number = '$token_number', `status` = 'tokened' WHERE buyer_id = '$id' AND shop_id = '$shop_id' AND product_name = '$procuct_name'") == TRUE) {
                echo "ok";
            } else {
                $conn->query("DELETE FROM `token_list` WHERE token_number = '$token_number' AND `shop_id`='$shop_id'");
            }
         }
    }
}
