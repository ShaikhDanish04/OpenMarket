<?php include('../../connect.php');

$search_product = $_POST['search'];

if ($search_product != '') {
    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE product_name LIKE '$search_product%'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            print_r($row);
        }
    } else {
        echo "No results found";
    }
}
