<?php include('../../connect.php');

$shop_id = $_POST['shop_id'];
$token_pending = false;
$product_list = array();
$result = $conn->query("SELECT * FROM `token_list` WHERE (shop_id='$shop_id' AND buyer_id='$id' AND `status`='pending') OR (shop_id='$shop_id' AND buyer_id='$id' AND `status`='active')");
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

            if (!isset($product_row['product_name']))
                $button = '<button class="mt-3 btn btn-success btn-sm w-100 book-btn"><i class="fa fa-shopping-bag"></i> Book</button>';
            else $button = '' .
                '<div class="text-center mt-3">' .
                '   <p class="mb-2 small text-danger font-weight-bold">Added to Cart</p>' .
                '   <button class="btn btn-warning btn-sm w-100 edit-btn"><i class="fa fa-edit"></i> Edit</button>' .
                '</div>';
        }

        if ($quantity == 0) {
            $button = '<p class="mb-2 text-danger small text-center font-weight-bold">Out of Stock</p>';
        }

        echo '' .
            '<div class="col-6">' .
            '    <div class="card product-card" data-id="' . $row["product_name"] . '">' .
            '        <div class="card-img-top"><img width="100%" src="../product_list/' . $row["product_name"] . '.jpg" alt=""></div>' .
            '        <i class="fa fa-shopping-cart ' . ((isset($product_row['product_name'])) ? '' : 'd-none') . ' incart"></i>' .
            '        <div class="card-body">' .
            '            <div class="">' .
            '                <p class="card-title">' . $row["product_name"] . '</p>' .
            '                <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . '</b></p>' .
            '                <p class="card-text mb-0"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / <span class="sold_by">' . $row['sold_by'] . '</span></b></p>' .
            '            </div>' .
            '            <form action="" class="product_form mt-3" method="post">' .
            '                <input type="hidden" name="sold_by" value="' . $row['sold_by'] . '">' .
            '                <input type="hidden" name="price_per_item" value="' . $row['price_per_item'] . '">' .
            '                <button ' . ((isset($product_row['product_name'])) ? 'style="display:none"' : '') . ' class="add_product btn btn-success w-100" data-op="add_product"><i class="fa fa-shopping-bag"></i> Add to Cart</button>' .
            '                <div  ' . ((!isset($product_row['product_name'])) ? 'style="display:none"' : '') . ' class="update_product">' .
            '                    <button data-op="update_product" class="btn btn-danger minus-val" tabindex="-1"><i class="fa fa-minus"></i></button>' .
            '                    <input type="number" step="0.005" value="' . $product_row['quantity_of_items'] . '" name="quantity_of_items" class="form-control mx-2 text-center">' .
            '                    <button data-op="update_product" class="btn btn-success plus-val" tabindex="-1"><i class="fa fa-plus"></i></button>' .
            '                </div>' .
            '            </form>' .
            '            <div class="estimation text-center font-weight-bold small mt-2"></div>' .
            '            <div class="price text-center"></div>' .
            '        </div>' .
            '    </div>' .
            '</div>';
    }
    if (!$token_pending) {

        echo '' .
            '<div class="card fixed-card w-100">' .
            '    <div class="card-body p-2">' .
            '        <button class="btn btn-primary w-100 view-cart" ><i class="fa fa-shopping-cart"></i> View Cart</button>' .
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
?>


<script>
    $('[name="quantity_of_items"]').focusout(function() {
        $($(this).closest('.product_form')).submit()
    })

    $('.product_form').submit(function(e) {
        e.preventDefault();

        var $card = $(this).closest('.product-card');
        var $product_name = $card.attr('data-id');
        var $input = $card.find('[name="quantity_of_items"]');
        var $button = $(this).find("button:focus");
        var $operation = 'update_cart';


        if ($button.attr('data-op') == 'add_product') {
            $input.val(Number(1));
            $operation = 'add_to_cart';
        }
        if ($button.attr('data-op') == 'update_product') {
            $operation = 'update_cart';

            if ($button.hasClass('plus-val')) {
                $input.val(Number($($input).val()) + Number(1));

            } else if ($button.hasClass('minus-val')) {
                $input.val(Number($($input).val()) - Number(1));

            }
        }

        $.ajax({
            type: "POST",
            url: "request/manage_cart.php",
            data: $(this).serialize() + '&' + $.param({
                "shop_id": window.sessionStorage.getItem('shop_id'),
                "product_name": $product_name,
                "operation": $operation
            }),
            success: function(data) {
                console.log(data);
                $('.cart-btn .badge').load('request/count_carts.php');
            }
        });

        $sold_by = $card.find('[name="sold_by"]');
        $price_per_item = $card.find('[name="price_per_item"]');
        $estimation = $card.find('.estimation');
        $price = $card.find('.price');

        var value = $input.val();
        var unit = value.toString().split(".");

        if ($sold_by.val() == "Kg") {
            $estimation.text(unit[0] + ' kilo ' + Number((value * 1000).toString().slice(-3)) + ' gram');
        }
        if ($sold_by.val() == "Liter") {
            $estimation.text(unit[0] + ' liter ' + Number((value * 1000).toString().slice(-3)) + ' ml');
        }
        if ($sold_by.val() == "Unit") {
            $estimation.text(unit[0] + ' Unit ');
            $(this).attr('step', '1');
        } else {
            $(this).attr('step', '0.005');
        }
        $price.text("Total Price : ₹ " + parseFloat(Number($price_per_item.val() * value)).toFixed(2));

        if (Number($input.val()) > 0) {
            $card.find('.update_product').fadeIn();
            $card.find('.add_product').fadeOut();
            $card.find('.incart').removeClass('d-none');
        } else {
            $card.find('.update_product').fadeOut();
            $card.find('.add_product').fadeIn();
            $card.find('.incart').addClass('d-none');
            $price.html('');
            $estimation.html('');
        }

    })

    $('.product-card .card-img-top').click(function() {
        $('.product-card').removeClass('open');
        $('.col-6').removeClass('col-12');

        if ($(this).hasClass('active')) {
            $('.product-card .card-img-top').removeClass('active');
        } else {
            $($(this).closest('.product-card')).toggleClass('open');
            $($(this).closest('.col-6')).toggleClass('col-12');
            $(this).addClass('active');
        }
    })

    $('.view-cart').click(function() {
        $('.screen').load('view/cart.php');
    })
</script>