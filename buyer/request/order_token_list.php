<?php include('../../connect.php');

$shop_id = $_POST['shop_id'];
$result_token = $conn->query("SELECT DISTINCT token_number FROM token_list WHERE buyer_id='$id' AND shop_id= '$shop_id'");
while ($row_token = $result_token->fetch_assoc()) {
    $token_number = $row_token['token_number'];

    $product_list = "";
    $total_cost = 0;

    $result_product = $conn->query("SELECT * FROM token_list WHERE buyer_id='$id' AND shop_id= '$shop_id' AND token_number='$token_number'");
    while ($row_product = $result_product->fetch_assoc()) {

        $product_name = $row_product['product_name'];
        $items_in_cart = $row_product['quantity_of_items'];
        $token_status = $row_product['status'];

        $row_product_seller = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name = '$product_name'")->fetch_assoc();

        $unit = explode('.', strval($row_product['quantity_of_items']));
        if ($row_product_seller['sold_by'] == "Kg") {
            $quantity = $unit[0] . ' kilo ' . substr(strval($row_product['quantity_of_items'] * 1000), '-3') . ' gram';
        }
        if ($row_product_seller['sold_by'] == "Liter") {
            $quantity = $unit[0] . ' liter ' . substr(strval($row_product['quantity_of_items'] * 1000), '-3') . ' ml';
        }
        if ($row_product_seller['sold_by'] == "Unit") {
            $quantity = $unit[0] . ' Unit ';
        }
        switch ($token_status) {
            case "deleted":
                $print_token_status = '<p class="text-danger px-2 mb-0"><i class="fa fa-times"></i></p>';
                break;
            case "pending":
                $print_token_status = '<p class="text-warning px-2 mb-0"><i class="fa fa-exclamation-circle"></i></p>';
                break;
            case "accepted":
                $print_token_status = '<p class="text-success px-2 mb-0"><i class="fa fa-check"></i></p>';
                break;
            case "rejected":
                $print_token_status = '<p class="text-danger px-2 mb-0"><i class="fa fa-times"></i></p>';
                break;
            case "active":
                $print_token_status = '<p class="text-warning px-2 mb-0"><i class="fa fa-exclamation-circle"></i></p>';
                break;
            default:
                $print_token_status = '<p class="text-warning px-2 mb-0"><i class="fa fa-exclamation-circle"></i></p>';
        }

        $total_cost = ($row_product_seller['price_per_item'] * $items_in_cart) + $total_cost;
        $product_list .= '' .
            '<div class="d-flex my-3">' .
            '    <div class="card-side-img"><img height="100%" width="100%" src="../product_list/' . $row_product['product_name'] . '.jpg" alt=""></div>' .
            '        <div class="pl-2 pt-2 w-100">' .
            '            <div class="d-flex align-items-center justify-content-between pl-1 mb-1">' .
            '                <p class="mb-1 h6 small">' . $product_name . '</p>' . $print_token_status .
            '            </div>' .
            '            <div class="d-flex align-items-center justify-content-between pl-1">' .
            '                <p class=" mb-0 card-title small font-weight-bold">₹' . ($row_product_seller['price_per_item'] * $items_in_cart) . ' </p>' .
            '                <p class=" mb-0 card-title small font-weight-bold">' . $quantity . '</p>' .
            '            </div>' .
            '        </div>' .
            '</div>';
    }
    echo '' .
        '<div class="token-card card mb-3" data-shop-id="' . $shop_id . '" data-token-number="' . $token_number . '">' .
        '   <div class="card-header" href="#shop' . $shop_id . '_' . $token_number . '" data-toggle="collapse">' .
        '       <div class="d-flex align-items-center justify-content-between">' .
        '           <div>' .
        '               <p class="card-title h6 mb-0">Token No : ' . $token_number . '</p>' .
        '               <p class="card-title mb-0 small">27 / 02 / 2020 - 10:00 AM</p>' .
        '           </div>' .
        '           <div class="cart-display">' .
        '               <div class="badge badge-warning">' . $result_product->num_rows . '</div>' .
        '               <button class="btn btn-primary" href="#shop' . $shop_id . '_' . $token_number . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
        '           </div>' .
        '       </div>' .
        '   </div>' .
        '<div class="card-body collapse py-0" id="shop' . $shop_id . '_' . $token_number . '">' . $product_list . '</div>' .
        '<p class="h6 p-3 text-center mb-0">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
        '</div>';
}
