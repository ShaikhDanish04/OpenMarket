<?php include('../../connect.php');

$shop_id = $_POST['shop_id'];
$token_pending = false;
$product_list = array();

$row_seller = $conn->query("SELECT * FROM `sellers` WHERE id='$shop_id'")->fetch_assoc();
echo '' .
    '<img class="card-side-img" src="" alt="">' .
    '<div class="col-12 d-flex align-items-center justify-content-between">' .
    '    <div class="d-flex align-items-center">' .
    '        <a href="#buyer_process" data-slide="prev" class="btn btn-dark"><i class="fa fa-chevron-left"></i> Back</a>' .
    '    </div>' .
    '    <div class="text-right">' .
    '        <p class="m-0 h5">' . $row_seller['name'] . '</p>' .
    '        <p class="m-0 text-uppercase small">' . $row_seller['category'] . '</p>' .
    '    </div>' .
    '</div>' .
    '<div class="col-12 divider my-2"></div>';

$result = $conn->query("SELECT DISTINCT token_number FROM `token_list` WHERE shop_id='$shop_id' AND buyer_id='$id' AND `status`='pending'");
if ($result->num_rows > 0) {
    $token_list = "";
    $token_pending = true;

    while ($row = $result->fetch_assoc()) {
        // print_r($row);
        $token_list .= '' .
            '<div class="card mb-2 px-3 py-2" style="background:#f7f7f7">' .
            '    <div class="d-flex align-items-center justify-content-between">' .
            '    <div>' .
            '        <p class="h6 mb-0">Token No : ' . $row['token_number'] . '</p>' .
            '        <p class="card-title mb-0 small">27 / 02 / 2020 - 10:00 AM</p>' .
            '    </div>' .
            '    <button class="btn btn-danger btn-sm delete_token"><i class="fa fa-times"></i></button>' .
            '    </div>' .
            '</div>';
    }
    // echo $token_list;
    echo '' .
        '<div class="col-12 my-2">' .
        '   <div class="card">' .
        '      <div class="card-body d-flex align-items-center flex-column">' .
        '         <p class="text-justify small mb-3"><b>Note : </b> You have token from this shop check it before you proccess for more order.</p>' .
        '         <div class="w-100 m-2">' . $token_list . '</div>' .
        '         <a class="btn btn-primary btn-sm w-100 view-token text-light"><i class="fa fa-list-alt"></i> Token List</a>' .
        '      </div>' .
        '   </div>' .
        '</div>';
}

$result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$shop_id'");
if ($result->num_rows > 0) {
    echo '<div class="col-12 d-flex align-items-center justify-content-center mb-2">' .
        '   <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>' .
        '   <p class="text-center mb-0"><i class="fa fa-archive text-primary"></i> There are <b>' . $result->num_rows . '</b> Item in Shop</p>' .
        '</div>' .
        '<div id="filter_product" class="container collapse mb-3">' .
        '   <input type="text" name="search_product" class="form-control" placeholder="Search">' .
        '</div>';
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

        $product_result = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
        $product_row = $product_result->fetch_assoc();
        // print_r($product_row);


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
            '        <button class="btn btn-primary w-100 view-cart" ' . (($product_result->num_rows > 0) ? '' : 'disabled') . '><i class="fa fa-shopping-cart"></i> View Cart</button>' .
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

        $.ajax({
            type: "POST",
            url: "request/selected_count_cart.php",
            data: {
                "shop_id": window.sessionStorage.getItem('shop_id'),
            },
            success: function(data) {
                console.log(data);
                if (data > 0) $('.view-cart').removeAttr('disabled')
                else $('.view-cart').attr('disabled', 'true')
            }
        });

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
    $('.view-token').click(function() {
        $('.screen').load('view/token-list.php');
    })
</script>