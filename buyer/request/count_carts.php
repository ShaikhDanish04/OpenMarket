<?php include('../../connect.php');

echo $conn->query("SELECT DISTINCT shop_id FROM cart WHERE buyer_id = '$id' AND `status` = 'in'")->num_rows ?>