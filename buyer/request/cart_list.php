<?php include('../../connect.php');


$shop_list = array();
$result = $conn->query("SELECT DISTINCT sellers.* FROM sellers INNER JOIN cart ON cart.shop_id = sellers.id WHERE buyer_id = '$id'");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $cart_product_list = "";
        $total_cost = 0;
        $shop_id = $row['id'];

        $result_cart = $conn->query("SELECT * FROM cart WHERE shop_id='$shop_id' AND buyer_id = '$id' ");
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
                '<div class="d-flex mb-3">' .
                '   <div class="card-side-img" ><img height="100%" width="100%" src="../product_list/' . $row_product['product_name'] . '.jpg" alt=""></div>' .
                '   <div class="pl-2 pt-2 w-100">' .
                '       <div class="d-flex align-items-center justify-content-between pl-1 mb-1">' .
                '           <p class="mb-1 h6 small">' . $product_name . '</p>' .
                '           <button class="btn btn-sm btn-danger delete-product small" data-product-id="' . $row_product['product_name'] . '"><i class=" fa fa-times"></i></button>' .
                '       </div>' .
                '       <div class="d-flex align-items-center justify-content-between pl-1">' .
                '           <p class=" mb-0 card-title small font-weight-bold">₹' . ($row_product['price_per_item'] * $items_in_cart) . ' </p>' .
                '           <p class=" mb-0 card-title small font-weight-bold">' . $quantity . '</p>' .
                '       </div>' .
                '   </div>' .
                '</div>';
        }
        echo '' .
            '<div class="cart-list-card card mb-2" data-shop-id="' . $row['id'] . '" >' .
            '    <div class="card-body">' .
            '        <div class="d-flex align-items-center justify-content-between">' .
            '            <div class="">' .
            '                <p class="card-title h6 mb-1">' . $row['name'] . '</p>' .
            '                <p class="card-sub-title small text-uppercase mb-0">' . $row['category'] . '</p>' .
            '            </div>' .
            '           <div class="d-flex">' .
            '               <button class="btn btn-warning edit-cart"><i class=" fa fa-edit"></i></button>' .
            '               <div class="cart-display ml-1">' .
            '                   <div class="badge badge-warning">' . $result_cart->num_rows . '</div>' .
            '                   <button class="btn btn-primary" href="#shop_' . $row['id'] . '" data-toggle="collapse" aria-expanded="true"><i class="fa fa-shopping-cart"></i></button>' .
            '               </div>' .
            '            </div>' .
            '        </div>' .
            '        <div id="shop_' . $row['id'] . '" class="collapse pt-3">' .
            '        <div class="divider mt-1 mb-3"></div>' . $cart_product_list . '<div class="divider mt-3 mb-3"></div>' .
            '            <select class="form-control mb-3" name="service_type">' .
            '                <option value="self-service">Self-Service</option>' .
            '                <option value="" disabled>Home Delivery</option>' .
            '            </select>' .
            '            <p class="h6 text-center">Sub-Total Price : ₹ <b>' . $total_cost . '</b></p>' .
            '            <p class="text-center small">Shipping Chargers : ₹ <b>0</b></p>' .
            '            <p class="h5 text-center mb-3">Total Cost : ₹ <b>' . $total_cost . '</b></p>' .
            '            <button class="btn btn-success w-100 check-out-cart" data-shop-id="' . $row['id'] . '"><i class=" fa fa-list-alt"></i> Check Out Order</button>' .
            '            <p class="text-muted mb-0 mt-2 text-justify" style="font-size: 11px;">*In self-service you will get a token number and code and have to collected the product by your self from shop using valid credentials.</p>' .
            '        </div>' .
            '    </div>' .
            '</div>';
    }
} else {
    echo '<div class="card mt-3 text-center"><div class="card-body"><p class="h6 m-0">!!! No Cart Available</p></div></div>';
}
?>
<style>
    .cart-list-card .card-side-img {
        width: 70px;
        height: 70px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        flex-shrink: 0;
    }
</style>
<script>
    $('.cart-btn .badge').load('request/count_carts.php');

    $('[id="shop_' + window.sessionStorage.getItem('shop_id') + '"]').addClass('show')

    $('.check-out-cart').click(function() {

        $(this).attr('disabled', 'true');
        var $card = $(this).closest('.card');
        $service_type = $card.find('[name="service_type"]');

        $.ajax({
            type: "POST",
            url: "request/manage_token.php",
            data: {
                "shop_id": $(this).attr('data-shop-id'),
                "service_type": $service_type.val(),
                "operation": "generate_token"
            },
            success: function(data) {
                $('.token-btn .badge').load('request/count_tokens.php');
                $('.cart-btn .badge').load('request/count_carts.php');
                $('.screen').load('view/token-list.php');
                console.log(data);
            }
        })
    });

    $('.cart-list-card .edit-cart').click(function() {
        $('.screen').load('view/home.php');
        var $card = $(this).closest('.card');

        window.sessionStorage.setItem('shop_id', $card.attr('data-shop-id'));
        window.sessionStorage.setItem('product_id', $(this).attr('data-product-id'));
        window.sessionStorage.setItem('carousel', '1');
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
                    $('.cart-card-list').load('request/cart_list.php');
                }
            })
        }
    })
</script>