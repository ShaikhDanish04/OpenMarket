<?php include('../../connect.php');


$result = $conn->query("SELECT * FROM `packed_products` WHERE shop_id='$id'");
$product_list = array();

while ($row = $result->fetch_assoc()) {
    array_push($product_list, $row['product_name']);
}

echo json_encode($product_list);
// print_r($product_list);
