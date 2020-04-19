<?php include('../../connect.php');

$count = $conn->query("SELECT * FROM token_list WHERE buyer_id = '$id' AND (`status` = 'pending' OR `status` = 'active')")->num_rows;
if ($count > 0) {
    echo $count;
}
