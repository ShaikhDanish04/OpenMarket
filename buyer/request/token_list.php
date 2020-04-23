<?php include('../../connect.php');

$result = $conn->query("SELECT DISTINCT shop_id FROM token_list WHERE buyer_id='$id' AND `status`='pending'");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $shop_id = $row['shop_id'];

        $row_shop = $conn->query("SELECT * FROM sellers WHERE id = '$shop_id'")->fetch_assoc();

        $shop_name = $row_shop['name'];
        $category = $row_shop['category'];
        $username = $row_shop['username'];

        $result_token = $conn->query("SELECT DISTINCT token_number FROM token_list WHERE buyer_id='$id' AND shop_id= '$shop_id'AND `status`='pending' ORDER BY `datetime` DESC ");
        while ($row_token = $result_token->fetch_assoc()) {
            $token_number = $row_token['token_number'];

            $product_list = "";
            $total_cost = 0;
            $datetime;

            $result_product = $conn->query("SELECT * FROM token_list WHERE buyer_id='$id' AND shop_id= '$shop_id' AND token_number='$token_number' AND `status`='pending'");
            while ($row_product = $result_product->fetch_assoc()) {
                // print_r($row_product);

                $product_name = $row_product['product_name'];
                $items_in_cart = $row_product['quantity_of_items'];

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

                $total_cost = ($row_product_seller['price_per_item'] * $items_in_cart) + $total_cost;
                $product_list .= '' .
                    '<div class="d-flex mb-3">' .
                    '   <div class="card-side-img" ><img height="100%" width="100%" src="../product_list/' . $row_product['product_name'] . '.jpg" alt=""></div>' .
                    '   <div class="pl-2 pt-2 w-100">' .
                    '       <div class="d-flex align-items-center justify-content-between pl-1 mb-1">' .
                    '           <p class="mb-1 h6 small">' . $product_name . '</p>' .
                    '           <p class="text-warning px-2 mb-0"><i class="fa fa-exclamation-circle"></i></p>' .
                    '       </div>' .
                    '       <div class="d-flex align-items-center justify-content-between pl-1">' .
                    '           <p class=" mb-0 card-title small font-weight-bold">₹' . ($row_product_seller['price_per_item'] * $items_in_cart) . ' </p>' .
                    '           <p class=" mb-0 card-title small font-weight-bold">' . $quantity . '</p>' .
                    '       </div>' .
                    '   </div>' .
                    '</div>';
                $datetime = date('d / m / Y - h:i A', strtotime($row_product['datetime']));
            }
            echo '' .
                '<div class="token-card card mb-3" data-shop-id="' . $shop_id . '" data-token-number="' . $token_number . '">' .
                '   <div class="card-header"  href="#shop_' . $shop_id . '_' . $token_number . '" data-toggle="collapse">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '             <div>' .
                '               <p class="card-title h6 mb-0">Your Token No : ' . $token_number . '</p>' .
                '               <p class="card-title mb-0 small">' . $datetime . '</p>' .
                '             </div>' .
                '             <button class="btn btn-danger btn-sm delete_token_button"><i class="fa fa-times"></i></button>' .
                '       </div>' .
                '   </div>' .
                '   <div class="card-body py-3">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '         <div class="">' .
                '             <p class="card-title h6 mb-1">' . $row_shop['name'] . '</p>' .
                '             <p class="card-sub-title small text-uppercase mb-0">' . $row_shop['category'] . '</p>' .
                '         </div>' .
                '         <div class="cart-display">' .
                '             <div class="badge badge-warning">' . $result_product->num_rows . '</div>' .
                '             <button class="btn btn-primary" href="#shop_' . $shop_id . '_' . $token_number . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
                '         </div>' .
                '       </div>' .
                '       <div id="shop_' . $shop_id . '_' . $token_number . '" class="collapse mt-3">' . $product_list .
                '           <p class="h6 p-2 text-center mb-0">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
                '       </div>' .
                '   </div>' .
                '</div>';
        }
    }
} else {
    echo '' .
        '<div class="card mx-auto">' .
        '    <div class="card-body d-flex align-items-center flex-column">' .
        '        <p class="display-4">Empty</p>' .
        '        <p class="h6">No Pending Token Available</p>' .
        '    </div>' .
        '</div>';
} ?>

<script>
    $('.delete_token_button').click(function() {

        $card = $(this).closest('.token-card');
        // $(this).attr('disabled', 'true');
        cconfirm('Delete Token', 'The is not reversable and the token will be deleted, you can still see this in orders record',
            function() {
                // Do something
                $.ajax({
                    type: "POST",
                    url: "request/manage_token.php",
                    data: {
                        "shop_id": $card.attr('data-shop-id'),
                        "token_number": $card.attr('data-token-number'),
                        "operation": "delete_token"
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.token-card-list').load('request/token_list.php')
                        // location.reload();
                    }
                })
            }
        );

        // if (confirm('Are Your Sure')) {
        //     console.log('Deleted');
        // } else {

        //     console.log('Not Deleted');
        // }

    })
</script>