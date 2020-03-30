<?php include('../../connect.php');

if ($_POST['operation'] == "get_product") {
    $shop_id = $_POST['shop_id'];
    $product_name = $_POST['product_name'];
    $quantity = 0;
    $quantity_of_items = "";
    $price = '';

    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id = '$shop_id' AND product_name='$product_name'");
    $row = $result->fetch_assoc();

    $product_result = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id' AND product_name='$product_name' AND `status`='in'");
    while ($product_row = $product_result->fetch_assoc()) {
        // print_r($row);
        $quantity = $product_row['quantity_of_items'];

        $quantity_of_items = $product_row['quantity_of_items'];

        $unit = explode('.', strval($product_row['quantity_of_items']));
        if ($row['sold_by'] == "Kg") {
            $quantity_of_items = $unit[0] . ' kilo ' . substr(strval($product_row['quantity_of_items'] * 1000), '-3') . ' gram';
        }
        if ($row['sold_by'] == "Liter") {
            $quantity_of_items = $unit[0] . ' liter ' . substr(strval($product_row['quantity_of_items'] * 1000), '-3') . ' ml';
        }
        if ($row['sold_by'] == "Unit") {
            $quantity_of_items = $unit[0] . ' Unit ';
        }
        $price = "Total Price : ₹ " . ($quantity * $row['price_per_item']);
    }

    echo '' .
        '<img class="card-img-top" src="img/shop_dummy.jpg" height="250px" alt="">' .
        '<div class="card-body">' .
        '    <p class="card-title h5">' . $row['product_name'] . '</p>' .
        '    <p class="card-text small">Price : ₹ ' . $row['price_per_item'] . '</p>' .
        '    <input type="hidden" name="sold_by" value="' . $row['sold_by'] . '">' .
        '    <input type="hidden" name="price_per_item" value="' . $row['price_per_item'] . '">' .
        '    <input type="hidden" name="operation" value="add_to_cart">' .
        '    <div class="form-group">' .
        '        <label for="">Enter Quantity in Number</label>' .
        '        <div class="d-flex">' .
        '            <button type="button" class="btn btn-danger minus-val btn-sm" tabindex="-1"><i class="fa fa-minus"></i></button>' .
        '            <input type="number" step="0.005" value="' . $quantity . '" min="0" max="' . $row['quantity_of_items'] . '" name="quantity_of_items" class="form-control mx-2 btn-sm text-center" required="">' .
        '            <button type="button" class="btn btn-success plus-val btn-sm" tabindex="-1"><i class="fa fa-plus"></i></button>' .
        '        </div>' .
        '        <p class="h4 mt-3 text-center estimation">' . $quantity_of_items . '</p>' .
        '        <p class="h6 mt-3 text-center price">' . $price . '</p>' .
        '        <small class="text-muted">*Required</small>' .
        '    </div>' .
        '    <div class="form-group d-flex justify-content-between">' .
        '        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>' .
        '        <button type="submit" class="btn btn-success">Submit</button>' .
        '    </div>' .
        '</div>';
} ?>

<script>
    $('#book_product form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "request/manage_cart.php",
            data: $(this).serialize() + '&' + $.param({
                "shop_id": $('[name="shop_id"]').val(),
                "product_name": $('[name="product_name"]').val()
            }),
            success: function(data) {
                console.log(data);
                $('#book_product').modal("hide");
            }
        });
    })

    $('.minus-val').click(function() {
        $(this).next().val(Number($(this).next().val()) - Number(1));
        $(this).next().change();
    })
    $('.plus-val').click(function() {
        $(this).prev().val(Number($(this).prev().val()) + Number(1));
        $(this).prev().change();
    })
    $('[name="quantity_of_items"],.modal-body').on('change click', function() {
        var value = $('[name="quantity_of_items"]').val();
        var unit = value.toString().split(".");

        if ($('[name="sold_by"]').val() == "Kg") {
            $('.estimation').text(unit[0] + ' kilo ' + Number((value * 1000).toString().slice(-3)) + ' gram');
        }
        if ($('[name="sold_by"]').val() == "Liter") {
            $('.estimation').text(unit[0] + ' liter ' + Number((value * 1000).toString().slice(-3)) + ' ml');
        }
        if ($('[name="sold_by"]').val() == "Unit") {
            $('.estimation').text(unit[0] + ' Unit ');
            $(this).attr('step', '1');
        } else {
            $(this).attr('step', '0.005');
        }
        $('.price').text("Total Price : ₹ " + parseFloat(Number($('[name="price_per_item"]').val() * value)).toFixed(2));
    })
</script>