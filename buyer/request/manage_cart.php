<?php

include('../../connect.php');

if ($_POST['operation'] == "add_to_cart") {

    $buyer_id = $_SESSION['id'];
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity_of_items = $_POST['quantity_of_items'];

    $conn->query("INSERT INTO `cart` (`buyer_id`, `shop_id`, `product_name`, `quantity_of_items`) VALUES ('$buyer_id', '$shop_id', '$product_name', '$quantity_of_items')");
    echo $conn->error;
}

if ($_POST['operation'] == "get_cart_list") {

    $shop_id = $_POST['shop_id'];
    $result = $conn->query("SELECT * FROM `cart` WHERE shop_id='$shop_id'");
    while ($row = $result->fetch_assoc()) {
        echo '' .
            '<div class="card cart-card mb-3" data-id="' . $row['product_name'] . '">' .
            '    <img class="card-side-img" src="holder.js/100x180/" alt="">' .
            '    <div class="card-body">' .
            '        <p class="card-title h6">' . $row['product_name'] . ' : <b>0 kilo 0 gram</b></p>' .
            '        <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>12 / <span class="sold_by">Kg</span></b></p>' .
            '    </div>' .
            '    <div class="card-footer d-flex justify-content-between">' .
            '        <button class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i></button>' .
            '        <button class="btn btn-sm btn-warning" href="#buyer_process" data-slide="prev"><i class="fa fa-edit"></i> Edit</button>' .
            '    </div>' .
            '</div>';
    }
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
</script>