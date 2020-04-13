<?php include('../../connect.php');

$result = $conn->query("SELECT * FROM sellers");
while ($row = $result->fetch_assoc()) {
    $shop_id = $row['id'];
    // print_r($row);
    echo '' .
        '<div class="card mb-3 shop-card" data-id="' . $row['id'] . '">' .
        '    <div class="shop-head card">' .
        '        <img class="card-side-img" src="holder.js/100x180/" alt="">' .
        '        <div class="card-body">' .
        '            <div class="">' .
        '                <p class="card-title">' . $row['name'] . '</p>' .
        '                <p class="small text-uppercase">' . $row['category'] . '</p>' .
        '            </div>' .
        '            <div class="d-flex align-items-center justify-content-between">' .
        '                <p class="m-0"><b>' . $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'")->num_rows . '</b> Item</p>' .
        '                <button class="btn btn-primary btn-sm visit-btn"><i class="fa fa-shopping-basket"></i> Visit</button>' .
        '            </div>' .
        '        </div>' .
        '    </div>' .
        '    <div id="collapse_' . $row['id'] . '" class="small m-2 collapse">' .
        '        <p class="address mb-0"><i class="fa fa-map-marker text-danger"></i> ' . $row['area'] . ', ' . $row['sub-district'] . ', ' . $row['district'] . ', ' . $row['state'] . '</p>' .
        '    </div>' .
        '    <div class="d-flex align-items-center justify-content-between p-2">' .
        '        <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#collapse_' . $row['id'] . '"><i class="fa fa-map-marker"></i></button>' .
        '        <div class="rating">' .
        '            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i> <span class="value">4.5</span>' .
        '        </div>' .
        '    </div>' .
        '</div>';
} ?>

<script>
    $('.shop-card .visit-btn').click(function() {
        var $card = $(this).closest('.shop-card');
        var shop_id = $card.attr('data-id');

        $('[name="shop_id"]').val(shop_id);

        $('#buyer_process').carousel("next");


    })
</script>