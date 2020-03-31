<style>
    .cart-display {
        position: relative;
    }

    .cart-display .badge {
        position: absolute;
        top: -8px;
        right: -8px;

    }
</style>
<?php
if (isset($_POST['start_selling'])) {
    $row = $conn->query("SELECT * FROM token_list WHERE shop_id='$id' AND `status`='pending'")->fetch_assoc();
    $token_number = $row['token_number'];

    $conn->query("UPDATE `token_list` SET `status`='active' WHERE token_number='$token_number' AND shop_id='$id'");
}
?>
<div class="container my-3">
    <p class="display-4 text-center">Active Tokens</p>

    <!-- list my tokens -->
    <?php $result = $conn->query("SELECT * FROM token_list WHERE (shop_id='$id' AND `status`='active') OR (shop_id='$id' AND `status` = 'pending')");

    if ($pending_tokens = $result->num_rows > 0) {

        $result = $conn->query("SELECT * FROM token_list WHERE shop_id='$id' AND `status`='active'");
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $token_number = $row['token_number'];
                $buyer_id = $row['buyer_id'];

                $row_buyer = $conn->query("SELECT * FROM buyers WHERE id = '$buyer_id'")->fetch_assoc();

                $cart_product_list = "";
                $total_cost = 0;

                $result_cart = $conn->query("SELECT * FROM cart WHERE token_number = '$token_number'");
                while ($row_cart = $result_cart->fetch_assoc()) {

                    $product_name = $row_cart['product_name'];
                    $items_in_cart = $row_cart['quantity_of_items'];

                    $result_product = $conn->query("SELECT * FROM seller_product_stock WHERE product_name = '$product_name'");
                    $row_product = $result_product->fetch_assoc();

                    $unit = explode('.', strval($row_cart['quantity_of_items']));
                    if ($row_product['sold_by'] == "Kg") {
                        $quantity = $unit[0] . ' kilo ' . substr(strval($row_cart['quantity_of_items'] * 1000), '-3') . ' gram';
                    }
                    if ($row_product['sold_by'] == "Liter") {
                        $quantity = $unit[0] . ' liter ' . substr(strval($row_cart['quantity_of_items'] * 1000), '-3') . ' ml';
                    }
                    if ($row_product['sold_by'] == "Unit") {
                        $quantity = $unit[0] . ' Unit ';
                    }

                    $total_cost = ($row_product['quantity_of_items'] * $items_in_cart) + $total_cost;
                    $cart_product_list .= '' .
                        '<p class="m-0 h6 small"><i class="fa fa-dot-circle-o text-primary"></i> ' . $product_name . '</p>' .
                        '<div class="d-flex align-items-center justify-content-between p-2">' .
                        '      <p class="card-title small font-weight-bold">' . $quantity . '</p>' .
                        '      <p class="card-title small font-weight-bold">₹ ' . ($row_product['quantity_of_items'] * $items_in_cart) . '</p>' .
                        '</div>';
                }

                echo '' .
                    '<div class="card mb-3" data-id="' . $buyer_id . '">' .
                    '   <div class="card-header">' .
                    '       <div class="d-flex align-items-center justify-content-between">' .
                    '             <p class="card-title h6 mb-0">Your Token No : ' . $token_number . '</p>' .
                    '             <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#card_delete_modal"><i class="fa fa-times"></i></button>' .
                    '       </div>' .
                    '   </div>' .
                    '   <div class="card-body">' .
                    '       <div class="d-flex align-items-center justify-content-between">' .
                    '         <div class="">' .
                    '             <p class="card-title h6 mb-1">' . $row_buyer['fname'] . ' ' . $row_buyer['lname'] . '</p>' .
                    '             <p class="card-sub-title small text-uppercase mb-0">' . $row_buyer['username'] . '</p>' .
                    '         </div>' .
                    '         <div class="cart-display">' .
                    '             <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
                    '             <button class="btn btn-primary" href="#buyer_' . $row_buyer['id'] . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
                    '         </div>' .
                    '       </div>' .
                    '       <div id="buyer_' . $row_buyer['id'] . '" class="collapse my-3 show">' . $cart_product_list .
                    '           <p class="h6 p-2 text-center">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
                    '       </div>' .
                    '   <button class="btn btn-success w-100 mt-3"><i class="fa fa-check"></i> Accept</button>' .
                    '   </div>' .
                    '</div>';
            }
        } else {
            echo '' .
                '<form method="post" action="">' .
                '   <div class="card mx-auto">' .
                '       <div class="card-body d-flex align-items-center flex-column">' .
                '           <p class="display-4">' . $pending_tokens . '</p>' .
                '           <p class="h6">Token Available</p>' .
                '           <button type="submit" class="btn btn-success mt-3" name="start_selling"><i class="fa fa-flag"></i> Start Selling</button>' .
                '       </div>' .
                '    </div>' .
                '</form>';
        }
    } else {
        echo '' .
            '<div class="card mx-auto">' .
            '    <div class="card-body d-flex align-items-center flex-column">' .
            '        <p class="display-4">Empty</p>' .
            '        <p class="h6">No Active Token Available</p>' .
            '        <a href="?" class="btn btn-primary mt-3"><i class="fa fa-refresh"></i> Try Refresh</a>' .
            '    </div>' .
            ' </div>';
    }
    ?>




    <!-- The Modal -->
    <div class="modal fade" id="card_delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <p class="h3 mb-4 mt-3">Delete Token</p>
                    <p class="">Are Your Sure ?</p>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" class="btn mx-2 btn-danger" data-dismiss="modal">No</button>
                        <button type="button" class="btn mx-2 btn-success">Yes</button>
                    </div>
                    <p class="small text-justify"><b>Note :</b> Your Token number will be set rejected and all your items will be sent back to your cart.</p>
                </div>

            </div>
        </div>
    </div>
</div>