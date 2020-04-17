<p class="display-4 text-center"><i class="fa fa-shopping-cart"></i> Cart List</p>
<?php
include('../../connect.php');

$shop_list = array();
$result = $conn->query("SELECT DISTINCT sellers.* FROM sellers INNER JOIN cart ON cart.shop_id = sellers.id WHERE buyer_id = '$id' AND `status` = 'in'");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $cart_product_list = "";
        $total_cost = 0;
        $shop_id = $row['id'];

        $result_cart = $conn->query("SELECT * FROM cart WHERE shop_id='$shop_id' AND buyer_id = '$id' AND `status` = 'in'");
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
                '      <p class=" mb-0 card-title small font-weight-bold">' . $quantity . '</p>' .
                '      <p class=" mb-0 card-title small font-weight-bold">₹ ' . ($row_product['price_per_item'] * $items_in_cart) . '</p>' .
                '</div>' .
                '<div class="d-flex align-items-center justify-content-between p-2">' .
                '    <button class="btn btn-sm btn-warning edit-product" data-product-id="' . $row_product['product_name'] . '"><i class=" fa fa-edit"></i> Edit</button>' .
                '    <button class="btn btn-sm btn-danger delete-product" data-product-id="' . $row_product['product_name'] . '"><i class=" fa fa-times"></i> Delete</button>' .
                '</div>' .
                '<div class="divider mt-1 mb-2"></div>';
        }
        echo '' .
            '<div class="cart-list-card card mb-2" data-shop-id="' . $row['id'] . '" >' .
            '    <div class="card-body">' .
            '        <div class="d-flex align-items-center justify-content-between">' .
            '            <div class="">' .
            '                <p class="card-title h6 mb-1">' . $row['name'] . '</p>' .
            '                <p class="card-sub-title small text-uppercase mb-0">' . $row['category'] . '</p>' .
            '            </div>' .
            '            <div class="cart-display">' .
            '                <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
            '                <button class="btn btn-primary" href="#shop_' . $row['id'] . '" data-toggle="collapse" aria-expanded="true"><i class="fa fa-shopping-cart"></i></button>' .
            '            </div>' .
            '        </div>' .
            '        <div id="shop_' . $row['id'] . '" class="collapse pt-3">' .
            '        <div class="divider mt-1 mb-2"></div>' . $cart_product_list .
            '            <p class="h6 p-2 text-center">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
            '            <button class="btn btn-success w-100 check-out-cart" data-shop-id="' . $row['id'] . '"><i class=" fa fa-list-alt"></i> Get Token</button>' .
            '        </div>' .
            '    </div>' .
            '</div>';
    }
} else {
    echo '<div class="card mt-3 text-center"><div class="card-body"><p class="h6 m-0">!!! No Cart Available</p></div></div>';
}
?>
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




<!-- <div class="cart-card-list"></div> -->

<script>
    $('.cart-btn .badge').load('request/count_carts.php');
    
    $('.check-out-cart').click(function() {

        $(this).attr('disabled', 'true');

        $.ajax({
            type: "POST",
            url: "request/manage_token.php",
            data: {
                "shop_id": $(this).attr('data-shop-id'),
                "operation": "generate_token"
            },
            success: function(data) {}
        })
        location.href = "?page=token-list";
    });

    $('.cart-list-card .edit-product').click(function() {

        var $card = $(this).closest('.card.cart-list-card');

        var shop_id = $card.attr('data-shop-id');
        var product_id = $(this).attr('data-product-id');

        $('[name="shop_id"]').val(shop_id);
        $('[name="product_name"]').val(product_id);

        $('#book_product').modal('show');
    });

    $('.cart-list-card .delete-product').click(function() {
        var $card = $(this).closest('.card');

        if (confirm("Are You Sure ?")) {
            $.ajax({
                type: "POST",
                url: "request/manage_cart.php",
                data: {
                    "shop_id": $card.attr('data-shop-id'),
                    "product_name": $(this).attr('data-product-id'),
                    "operation": "remove_from_cart"
                },
                success: function(data) {
                    $('.cart-list').load('request/cart_list.php');
                }
            })
        }
    })
</script>