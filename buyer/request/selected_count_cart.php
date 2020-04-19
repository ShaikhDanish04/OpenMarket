<?php include('../../connect.php');

$shop_id = $_POST['shop_id'];
$count = 0;
$count = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id' AND `status`='in'")->num_rows;
if ($count > 0) {
    echo $count;
} else {
    echo 0;
}
