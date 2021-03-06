<?php include('../../connect.php');?>
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

<div class="container py-3">
    <p class="display-4 text-center">My Tokens</p>

    <div class="mb-3 d-flex justify-content-between card-display">
        <button data-trigger="pending" class="btn btn-primary btn-sm w-100 mx-1">Pending</button>
        <button data-trigger="active" class="btn btn-success btn-sm w-100 mx-1">Active</button>
        <button data-trigger="deleted" class="btn btn-warning btn-sm w-100 mx-1">Deleted</button>
    </div>
    <div class="mb-3 d-flex justify-content-between card-display align-items-center">
        <span class="small font-weight-bold ml-1" style="flex-shrink:0">From Seller :</span>
        <button data-trigger="accepted" class="btn btn-success btn-sm w-100 mx-1">Accepted</button>
        <button data-trigger="rejected" class="btn btn-danger btn-sm w-100 mx-1">Rejected</button>
    </div>

    <script>
        $('.card-display button').click(function() {
            $(this).toggleClass('btn-light');
            $('.card.' + $(this).attr('data-trigger')).toggle();
        })
    </script>
    <!-- list my tokens -->
    <?php $result = $conn->query("SELECT * FROM token_list WHERE shop_id='$id'");

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $token_number = $row['token_number'];
            $shop_id = $row['shop_id'];
            $buyer_id = $row['buyer_id'];
            $token_status = $row['status'];

            $row_shop = $conn->query("SELECT * FROM buyers WHERE id = '$buyer_id'")->fetch_assoc();

            $cart_product_list = "";
            $total_cost = 0;

            $row_token = $conn->query("SELECT * FROM token_list WHERE shop_id = '$shop_id' AND `status`='active'")->fetch_assoc();
            if (isset($row_token['token_number'])) $active_token = $row_token['token_number'];
            else $active_token = '<span class="badge badge-secondary p-2">No Active Token</span>';

            $result_cart = $conn->query("SELECT * FROM cart WHERE token_number = '$token_number' AND `shop_id`='$shop_id' AND `status`='tokened'");
            while ($row_cart = $result_cart->fetch_assoc()) {

                $product_name = $row_cart['product_name'];
                $items_in_cart = $row_cart['quantity_of_items'];

                $result_product = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name = '$product_name'");
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

                $total_cost = ($row_product['price_per_item'] * $items_in_cart) + $total_cost;
                $cart_product_list .= '' .
                    '<p class="m-0 h6 small"><i class="fa fa-dot-circle-o text-primary"></i> ' . $product_name . '</p>' .
                    '<div class="d-flex align-items-center justify-content-between p-2">' .
                    '      <p class="card-title small font-weight-bold">' . $quantity . '</p>' .
                    '      <p class="card-title small font-weight-bold">₹ ' . ($row_product['price_per_item'] * $items_in_cart) . '</p>' .
                    '</div>';
            }

            switch ($token_status) {
                case "pending":
                    $active_status = '<span class="badge badge-primary p-2">Token Pending</span>';
                    $delete_token = '';
                    $cart = '' .
                        '         <div class="cart-display">' .
                        '             <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
                        '             <button class="btn btn-primary" href="#shop_' . $row_shop['id'] . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
                        '         </div>' .
                        '       </div>' .
                        '       <div id="shop_' . $row_shop['id'] . '" class="collapse my-3">' . $cart_product_list .
                        '           <p class="h6 p-2 text-center">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
                        '       </div>';
                    break;

                case "active":
                    $active_status = '<span class="badge badge-success p-2">Token Active</span>';
                    $delete_token = '';
                    $cart = '' .
                        '         <div class="cart-display">' .
                        '             <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
                        '             <button class="btn btn-primary" href="#shop_' . $row_shop['id'] . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
                        '         </div>' .
                        '       </div>' .
                        '       <div id="shop_' . $row_shop['id'] . '" class="collapse my-3">' . $cart_product_list .
                        '           <p class="h6 p-2 text-center">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
                        '       </div>';
                    break;

                case "deleted":
                    $active_status = '<span class="badge badge-warning p-2">Token Deleted</span>';
                    $delete_token = '';
                    $cart = '</div>';
                    break;

                case "rejected":
                    $active_status = '<span class="badge badge-danger p-2">Token Rejected</span>';
                    $delete_token = '';
                    $cart = '</div>';
                    break;

                default:
                    $active_status = '';
                    $cart = '</div>';
                    $delete_token = '';
            }
            echo '' .
                '<div class="card mb-3 ' . $token_status . '" data-shop-id="' . $row_shop['id'] . '" data-token-number="' . $token_number . '">' .
                '   <div class="card-header">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '             <p class="card-title h6 mb-0">Your Token No : ' . $token_number . '</p>' . $delete_token .
                '       </div>' .
                '   </div>' .
                '   <div class="card-body">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '         <div class="">' .
                '             <p class="card-title h6 mb-1">' . $row_shop['fname'] . ' ' . $row_shop['lname'] . '</p>' .
                '             <p class="card-sub-title small mb-0">' . $row_shop['username'] . '</p>' .
                '         </div>' .
                '   ' . $cart .
                '   <p class="mt-3 mb-0 text-center">' . $active_status . '</p>' .
                '   </div>' .
                '</div>';
        }
    

        echo '<button class="btn btn-danger d-block mx-auto delete_token_history"><i class="fa fa-list-alt"></i> | <i class="fa fa-times"></i> Clear Token History</button>';
    } else {
        echo '' .
            '<div class="card mx-auto">' .
            '    <div class="card-body d-flex align-items-center flex-column">' .
            '        <p class="display-4">Empty</p>' .
            '        <p class="h6">No Token Available</p>' .
            '        <a class="btn btn-primary mt-3" href="?"><i class="fa fa-home"></i> Home</a>' .
            '    </div>' .
            '</div>';
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
                        <button type="button" class="btn mx-2 btn-success delete_token_button">Yes</button>
                    </div>
                    <p class="small text-justify"><b>Note :</b> Your Token number will be set rejected and all your items will be sent back to your cart.</p>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $('.delete_token_history').click(function() {

        var $card = $(this).closest('.card');

        $('#card_delete_modal').attr('data-token-number', $card.attr('data-token-number'));
        $('#card_delete_modal').attr('data-shop-id', $card.attr('data-shop-id'));
        $('#card_delete_modal').attr('data-operation', "clear_token_history");

        $('#card_delete_modal p.h3').text("Clear Token History");

        console.log($('#card_delete_modal p.small').html("<b>Note : </b> This will not delete the active and pending tokens."));
        $('#card_delete_modal').modal('show');
    });

    $('.delete_token_button').click(function() {

        // $(this).attr('disabled', 'true');

        $.ajax({
            type: "POST",
            url: "request/manage_token.php",
            data: {
                "shop_id": '<?php echo $id ?>',
                "operation": $(this).closest('.modal').attr('data-operation')
            },
            success: function(data) {
                console.log(data);
                location.reload();
            }
        })
    })
</script>