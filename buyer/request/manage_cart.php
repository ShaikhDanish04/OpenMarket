<?php

include('../../connect.php');

if ($_POST['operation'] == "add_to_cart") {

    $buyer_id = $_SESSION['id'];
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    $result = $conn->query("SELECT * FROM cart WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
    $row = $result->fetch_assoc();
    if ($quantity_of_items == 0) {
        $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$buyer_id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    }

    if ($result->num_rows > 0) {
        $conn->query("UPDATE `cart` SET `quantity_of_items` = '$quantity_of_items' WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name'");
        echo "echo";
    } else {
        $conn->query("INSERT INTO `cart` (`buyer_id`, `shop_id`, `product_name`, `quantity_of_items`) VALUES ('$buyer_id', '$shop_id', '$product_name', '$quantity_of_items')");
    }

    echo $conn->error;
}

if ($_POST['operation'] == "get_cart_list") {
    $total_cost = 0;
    $shop_id = $_POST['shop_id'];
    $result = $conn->query("SELECT * FROM `cart` WHERE shop_id='$shop_id' AND `status`='in'");

    // echo '<p class="h5 my-3 text-center">' . $result->num_rows . ' Items in this cart</p>';
    while ($row = $result->fetch_assoc()) {

        $product_name = $row['product_name'];
        $product_result = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id' AND product_name='$product_name'");
        $product_row = $product_result->fetch_assoc();

        // echo "<pre>";
        // print_r($product_row);
        // print_r($row);
        // echo "</pre>";
        $quantity = $row['quantity_of_items'];

        // $quantity_of_items = ;
        $cost = $product_row['price_per_item'] * $row['quantity_of_items'];
        $total_cost = $total_cost + $cost;

        $unit = explode('.', strval($row['quantity_of_items']));
        if ($product_row['sold_by'] == "Kg") {
            $quantity = $unit[0] . ' kilo ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' gram';
        }
        if ($product_row['sold_by'] == "Liter") {
            $quantity = $unit[0] . ' liter ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' ml';
        }
        if ($product_row['sold_by'] == "Unit") {
            $quantity = $unit[0] . ' Unit ';
        }
        echo '' .
            '<div class="card cart-card mb-3" data-id="' . $row['product_name'] . '">' .
            '    <img class="card-side-img" src="holder.js/100x180/" alt="">' .
            '    <div class="card-body">' .
            '        <p class="card-title h6">' . $row['product_name'] . '</p>' .
            '        <p class="card-text mb-0">Quantity : <b>' . $quantity . '</b></p>' .
            '        <p class="card-text mb-0">Price : ₹ <b>' . $cost . '</b></p>' .
            '    </div>' .
            '    <div class="card-footer d-flex justify-content-between">' .
            '        <button class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i></button>' .
            '        <button class="btn btn-sm btn-warning edit-cart"><i class="fa fa-edit"></i> Edit</button>' .
            '    </div>' .
            '</div>';
    }

    echo '' .
        '<div class="card fixed-card">' .
        '    <div class="card-body p-2">' .
        '       <p class="h6 p-2 text-center">Total Price : ₹ <b>' . $total_cost . '</b></p>' .
        '        <button class="btn btn-success w-100 check-out-cart"><i class="fa fa-list-alt"></i> Get Token</button>' .
        '    </div>' .
        '</div>';
}

if ($_POST['operation'] == "remove_from_cart") {

    $buyer_id = $_SESSION['id'];
    $product_name = $_POST['product_name'];
    $shop_id = $_POST['shop_id'];

    $conn->query("DELETE FROM `cart` WHERE `buyer_id` = '$buyer_id' AND `shop_id`='$shop_id' AND `product_name`='$product_name' ");
    $conn->error;
}
?>

<script>
    $('.cart-card button.delete').click(function() {
        var $card = $(this).closest('.card');

        $.ajax({
            type: "POST",
            url: "request/manage_cart.php",
            data: {
                "shop_id": $('[name="shop_id"]').val(),
                "product_name": $card.attr('data-id'),
                "operation": "remove_from_cart"
            },
            success: function(data) {
                $.ajax({
                    type: "POST",
                    url: "request/manage_cart.php",
                    data: {
                        "shop_id": $('[name="shop_id"]').val(),
                        "operation": "get_cart_list"
                    },
                    success: function(data) {
                        $('.cart-card-list').html(data);
                    }
                })
            }
        })
    })
    $('.cart-card button.edit-cart').click(function() {
        var $card = $(this).closest('.card');
        var product_id = $card.attr('data-id');

        $('[name="product_name"]').val(product_id);
        $('#buyer_process').carousel("prev");

        $('#book_product').modal('show');

    })

    $('.check-out-cart').click(function() {
        $(this).attr('disabled', 'true');

        $.ajax({
            type: "POST",
            url: "request/manage_token.php",
            data: {
                "shop_id": $('[name="shop_id"]').val(),
                "operation": "generate_token"
            },
            success: function(data) {
                location.reload();
            }
        })
    })
</script>