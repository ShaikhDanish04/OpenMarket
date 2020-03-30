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

<div class="container my-3">
    <p class="display-4 text-center">My Tokens</p>

    <!-- list my tokens -->
    <?php $result = $conn->query("SELECT * FROM token_list WHERE buyer_id='$id'");

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $token_number = $row['token_number'];
            $shop_id = $row['shop_id'];

            $row_shop = $conn->query("SELECT * FROM sellers WHERE id = '$shop_id'")->fetch_assoc();

            $cart_product_list = "";

            $result_cart = $conn->query("SELECT * FROM cart WHERE token_number = '$token_number'");
            while ($row_cart = $result_cart->fetch_assoc()) {
                $cart_product_list .= '<p class="m-0 small"><i class="fa fa-dot-circle-o mx-1 text-primary"></i> ' . $row_cart['product_name'] . '</p>';
            }

            echo '' .
                '<div class="card mb-3" data-id="' . $shop_id . '">' .
                '   <div class="card-header">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '             <p class="card-title h6 mb-0">Your Token No : ' . $token_number . '</p>' .
                '             <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#card_delete_modal"><i class="fa fa-times"></i></button>' .
                '       </div>' .
                '   </div>' .
                '   <div class="card-body">' .
                '       <div class="d-flex align-items-center justify-content-between">' .
                '         <div class="">' .
                '             <p class="card-title h6 mb-1">' . $row_shop['name'] . '</p>' .
                '             <p class="card-sub-title small text-uppercase mb-0">' . $row_shop['category'] . '</p>' .
                '         </div>' .
                '         <div class="cart-display">' .
                '             <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
                '             <button class="btn btn-primary" href="#shop_' . $row_shop['name'] . '" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>' .
                '         </div>' .
                '       </div>' .
                '       <div id="shop_' . $row_shop['name'] . '" class="collapse my-3">' . $cart_product_list . '</div>' .
                '   <p class="mt-3 mb-0">Active Token : <b>0</b></p>' .
                '   </div>' .
                '</div>';
        }
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
                        <button type="button" class="btn mx-2 btn-success">Yes</button>
                    </div>
                    <p class="small text-justify"><b>Note :</b> Your Token number will be set rejected and all your items will be sent back to your cart.</p>
                </div>

            </div>
        </div>
    </div>





</div>