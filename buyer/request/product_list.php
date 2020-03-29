<?php include('../../connect.php');

if ($_POST['operation'] == "get_list") {
    $shop_id = $_POST['shop_id'];
    $product_list = array();
    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$shop_id'");

    echo '<input type="hidden" name="shop_id" value="' . $shop_id . '">';
    echo '<input type="hidden" name="buyer_id" value="' . $id . '">';
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
            echo '' .
                '<div class="card product-card">' .
                '    <img class="card-side-img" src="holder.js/100x180/" alt="">' .
                '    <div class="card-body">' .
                '        <p class="card-title">' . $row['product_name'] . '</p>' .
                '        <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . '</b></p>' .
                '        <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</b></p>' .
                '        <button data-toggle="modal" data-target="#book_product" class="btn btn-success btn-sm w-100" data-name="' . $row["product_name"] . '"><i class="fa fa-shopping-bag"></i> Book</button>' .
                '    </div>' .
                '</div>';
        }
    } else {
        echo '' .
            '<div class="card">' .
            '    <div class="card-body d-flex align-items-center flex-column">' .
            '        <p class="display-4">Sorry</p>' .
            '        <p class="h6">No Products Available</p>' .
            '        <button class="btn btn-danger mt-3" href="#buyer_process" data-slide="prev"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i> Back</button>' .
            '    </div>' .
            '</div>';
    }
} ?>

<script>
    $('[data-name]').click(function() {
        $('.modal [name="buyer_id"]').val($('[name="buyer_id"]').val());
        $('.modal [name="shop_id"]').val($('[name="shop_id"]').val());
        $('.modal [name="product_name"]').val($(this).attr('data-name'));
        $('.modal .product_name_get').text($(this).attr('data-name'));


    })
    $('form').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            type: "POST",
            url: "request/manage_order_list.php",
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data) {
                // location.reload();
                console.log(data);
                $.ajax({
                    type: "POST",
                    url: "request/manage_order_list.php",
                    data: {
                        "operation": "get_order_list",
                        "shop_id": $('[name="in_shop_id"]').val()
                    },
                    success: function(data) {
                        // location.reload();
                        // console.log(data);
                        $('.items-in-list').html(data);
                        if (data != '') {
                            $('.order-list').slideDown();
                        }
                    }
                })
            }
        });
    })
</script>