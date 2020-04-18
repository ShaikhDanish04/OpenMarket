<?php include('../../connect.php');

$count = $conn->query("SELECT DISTINCT shop_id FROM cart WHERE buyer_id = '$id' AND `status` = 'in'")->num_rows;
if($count > 0) {
    echo $count;
}