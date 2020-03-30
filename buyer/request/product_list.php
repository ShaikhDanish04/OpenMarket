<?php include('../../connect.php');

if ($_POST['operation'] == "get_list") {
    $shop_id = $_POST['shop_id'];
    $token_pending = false;
    $product_list = array();
    $result = $conn->query("SELECT * FROM `token_list` WHERE shop_id='$shop_id' AND buyer_id='$id' AND `status`='pending'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // print_r($row);
        $token_pending = true;
        echo '' .
            '<div class="col-12">' .
            '   <div class="card mb-3">' .
            '       <div class="card-header">' .
            '           <p class="h6 mb-0">Your Token No : ' . $row['token_number'] . '</p>' .
            '       </div>' .
            '       <div class="card-body d-flex align-items-center flex-column">' .
            '           <p class="text-justify small mb-0"><b>Note : </b> You cannot book more items with pending token, Complete your order or Delete Token.</p>' .
            '           <a class="btn btn-primary mt-3 btn-sm w-100" href="?page=token-list"><i class="fa fa-list-alt"></i> Token List</a>' .
            '       </div>' .
            '   </div>' .
            '</div>';
    }


    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$shop_id'");

    if ($result->num_rows > 0) {
        echo '<div class="col-12"><p class="text-center"><i class="fa fa-archive text-primary"></i> There are <b>' . $result->num_rows . '</b> Item in Shop</p></div>';
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['quantity_of_items'];
            $product_name = $row['product_name'];

            $unit = explode('.', strval($row['quantity_of_items']));

            if ($row['sold_by'] == "Kg") {
                $quantity = $unit[0] . ' kilo ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' gram';
            }
            if ($row['sold_by'] == "Liter") {
                $quantity = $unit[0] . ' liter ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' ml';
            }
            if ($row['sold_by'] == "Unit") {
                $quantity = $unit[0] . ' Unit ';
            }

            $product_result = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name' AND `status`='in'");
            $product_row = $product_result->fetch_assoc();
            // print_r($product_row);

            if ($token_pending) {
                $button = '';
            } else {

                if (!isset($product_row['product_name'])) $button = '<button class="mt-3 btn btn-success btn-sm w-100 book-btn"><i class="fa fa-shopping-bag"></i> Book</button>';
                else $button = '' .
                    '<div class="text-center mt-3">' .
                    '   <p class="mb-2 small text-danger font-weight-bold">Added to Cart</p>' .
                    '   <button class="btn btn-warning btn-sm w-100 edit-btn"><i class="fa fa-edit"></i> Edit</button>' .
                    '</div>';
            }

            echo '' .
                '<div class="col-6 mb-3">' .
                '    <div class="card product-card" data-id="' . $row["product_name"] . '">' .
                '        <img class="card-side-img" src="holder.js/100x180/" alt="">' .
                '        <div class="card-body">' .
                '            <div class="">' .
                '                <p class="card-title">' . $row['product_name'] . '</p>' .
                '                <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . '</b></p>' .
                '                <p class="card-text mb-0"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / <span class="sold_by">' . $row['sold_by'] . '</span></b></p>' .
                '            </div>' . $button .
                '        </div>' .
                '    </div>' .
                '</div>';
        }
        if (!$token_pending) {

            echo '' .
                '<div class="card fixed-card w-100">' .
                '    <div class="card-body p-2">' .
                '        <button class="btn btn-primary w-100" href="#buyer_process" data-slide="next"><i class="fa fa-shopping-cart"></i> View Cart</button>' .
                '    </div>' .
                '</div>';
        }
    } else {
        echo '' .
            '<div class="card mx-auto">' .
            '    <div class="card-body d-flex align-items-center flex-column">' .
            '        <p class="display-4">Sorry</p>' .
            '        <p class="h6">No Products Available</p>' .
            '        <button class="btn btn-danger mt-3" href="#buyer_process" data-slide="prev"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i> Back</button>' .
            '    </div>' .
            '</div>';
    }
} ?>



<script>
    $('.product-card .book-btn').click(function() {
        var $card = $(this).closest('.card');
        var product_id = $card.attr('data-id');

        $('[name="product_name"]').val(product_id);

        $('#book_product').modal('show');
    });

    $('.product-card .edit-btn').click(function() {
        var $card = $(this).closest('.card');
        var product_id = $card.attr('data-id');

        $('[name="product_name"]').val(product_id);

        $('#book_product').modal('show');

    })
</script>