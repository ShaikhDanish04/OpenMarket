<?php include('../../connect.php');

$search_product = $_POST['search'];

if ($search_product != '') {
    $result = $conn->query("SELECT * FROM `seller_product_stock` INNER JOIN sellers ON sellers.id = seller_product_stock.shop_id WHERE product_name LIKE '%$search_product%'");

    echo '<p class="text-center"><b>' . $result->num_rows . '</b> Result Found for <b>"' . $search_product . '"</b></p>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['quantity_of_items'];

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

            $product_incart = false;
            $product_quantity = 0;
            $product_result = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id'");
            while ($product_row = $product_result->fetch_assoc()) {

                if ($row['shop_id'] == $product_row['shop_id'] && $row['product_name'] == $product_row['product_name']) {
                    $product_incart = true;
                    $product_quantity = $product_row['quantity_of_items'];
                }
            }
            $shop_id = $row['shop_id'];

            echo '' .
                '<div class="card searched-product-card mb-3" data-product-id="' . $row['product_name'] . '" data-shop-id="' . $row['shop_id'] . '">' .
                '    <div class="card product" >' .
                '        <div class="card-side-img" data-toggle="collapse" data-target="#collapse_' . $row['shop_id'] . '_' . $row['product_name'] . '"><img height="100%" width="100%" src="../product_list/' . $row['product_name'] . '.jpg" alt=""></div>' .
                '        <i class="fa fa-shopping-cart ' . (($product_incart) ? '' : 'd-none') . ' incart"></i>' .
                '        <div class="card-body">' .
                '            <p class="card-title">' . $row['product_name'] . '</p>' .
                '            <p class="card-text"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity . ' </b></p>' .
                '            <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / <span class="sold_by">' . $row['sold_by'] . '</span></b></p>' .
                '            <form action="" class="product_form mt-3" method="post">' .
                '                <input type="hidden" name="sold_by" value="' . $row['sold_by'] . '">' .
                '                <input type="hidden" name="price_per_item" value="' . $row['price_per_item'] . '">' .
                '                <button ' . (($product_incart) ? 'style="display:none"' : '') . ' class="add_product btn btn-sm btn-success w-100" data-op="add_product"><i class="fa fa-shopping-bag"></i> Add to Cart</button>' .
                '                <div  ' . ((!$product_incart) ? 'style="display:none"' : '') . ' class="update_product">' .
                '                    <button data-op="update_product" class="btn btn-danger btn-sm minus-val" tabindex="-1"><i class="fa fa-minus"></i></button>' .
                '                    <input type="number" step="0.005" value="' . $product_quantity . '" name="quantity_of_items" class="form-control btn-sm mx-1 text-center">' .
                '                    <button data-op="update_product" class="btn btn-success btn-sm plus-val" tabindex="-1"><i class="fa fa-plus"></i></button>' .
                '                </div>' .
                '            </form>' .
                '            <div class="estimation text-center font-weight-bold small mt-2"></div>' .
                '            <div class="price text-center small"></div>' .
                '        </div>' .
                '    </div>' .
                '    <div id="collapse_' . $row['shop_id'] . '_' . $row['product_name'] . '" class="collapse small m-2 mt-3">' .
                '        <div class="d-flex align-items-center justify-content-between p-1 mb-2">' .
                '            <p class="ml-1"><b>' . $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'")->num_rows . '</b> Product in stock</p>' .
                '            <button class="btn btn-primary btn-sm visit-btn"><i class="fa fa-shopping-basket"></i></button>' .
                '        </div>' .
                '        <div class="address"> ' .
                '           <p class="mb-1"><b>Address : </b> ' . $row['address'] . '</p>' .
                '           <i class="fa fa-map-marker text-danger"></i> ' . $row['area'] . ' - ' . $row['region'] . ', ' . $row['district'] . ', ' . $row['state'] . ' - ' . $row['pincode'] .
                '        </div>' .
                '    </div>' .
                '    <div class="d-flex align-items-center justify-content-between p-2">' .
                '        <div>' .
                '            <p class="font-weight-bold small text-capitalize">' . $row['name'] . '</p>' .
                '            <p class="small text-uppercase">' . $row['category'] . '</p>' .
                '        </div>' .
                '        <div class="rating">' .
                '            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i>' .
                '            <span class="value">4.5</span>' .
                '        </div>' .
                '    </div>' .
                '    <div class="next_span btn btn-primary btn-sm"> <i class="fa fa-chevron-right"></i> </div>' .
                '</div>';
        }
    } else {
        echo "No results found";
    }
} ?>

<style>
    .searched-product-card {
        transition: .15s all;
        z-index: 2;
    }

    .searched-product-card .product {
        z-index: 1;
    }

    .next_span {
        position: absolute;
        right: 40px;
        top: 50px;
        transform: translateY(50%);
    }
</style>
<script>
    $('[name="quantity_of_items"]').click(function() {
        $(this).select();
    })


    $('[name="quantity_of_items"]').focusout(function() {
        $($(this).closest('.product_form')).submit()
    })

    $('.product_form').submit(function(e) {
        e.preventDefault();

        var $card = $(this).closest('.searched-product-card');
        var $product_name = $card.attr('data-product-id');
        var $shop_id = $card.attr('data-shop-id');
        var $input = $card.find('[name="quantity_of_items"]');
        var $button = $(this).find("button:focus");
        var $operation = 'update_cart';

        console.log($card);

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
                "shop_id": $shop_id,
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
        $price.text("Price : ₹ " + parseFloat(Number($price_per_item.val() * value)).toFixed(2));

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

    $('.searched-product-card .visit-btn').click(function() {
        var $card = $(this).closest('.card');
        var shop_id = $card.attr('data-shop-id');

        window.sessionStorage.setItem('shop_id', shop_id);
        $('[name="shop_id"]').val(shop_id);

        $('#buyer_process').carousel("next");
    })

    var mousedownX, mousemoveX, $card, $process = false;
    $(".all-product-card-list").on({
        "vmousedown": function(event) {
            $card = $(event.target).closest('.searched-product-card');
            $next = $card.find('.next_span');
            $img = $card.find('.card-side-img');
            mousedownX = event.clientX;
        },
        "vmousemove": function(event) {
            if ($card.hasClass('searched-product-card')) {
                Xpos = (event.clientX - (mousedownX));
                if (Xpos < -50 && Xpos > -120) {
                    if (Xpos < -80) {
                        $process = true;
                    } else {
                        $process = false;
                    }
                    $card.css('transform', 'translateX(' + Xpos + 'px)');
                    $next.css('right', 'calc(' + Xpos + 'px + 35px)');
                }
                if (Xpos > 50 && Xpos < 80) {
                    $card.css('transform', 'translateX(' + Xpos + 'px)');
                    $img.click();
                }
            }
            console.log(Xpos);
        },
        "vmouseup": function(event) {
            if ($process) {
                var shop_id = $card.attr('data-shop-id');
                window.sessionStorage.setItem('shop_id', shop_id);
                $('#buyer_process').carousel("next");
                $process = false;
            }
            $card.css('transform', '');
            $next.css('right', '50px');

        }
    });
</script>