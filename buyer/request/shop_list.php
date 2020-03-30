<?php include('../../connect.php');

$result = $conn->query("SELECT * FROM sellers");
while ($row = $result->fetch_assoc()) {
    $shop_id = $row['id'];
    $shops = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'");
    echo '' .
        '<div class="card mb-3 shop-card" data-id="' . $row['id'] . '">' .
        '    <img class="card-side-img" src="holder.js/100x180/" alt="">' .
        '    <div class="card-body">' .
        '        <div class="">' .
        '            <p class="card-title">' . $row['name'] . '</p>' .
        '            <p class="small text-uppercase">' . $row['category'] . '</p>' .
        '        </div>' .
        '        <div class="d-flex align-items-center justify-content-between">' .
        '            <p class="m-0"><b>' . $shops->num_rows . '</b> Item</p>' .
        '            <button class="btn btn-primary btn-sm"><i class="fa fa-shopping-basket"></i> Visit</button>' .
        '        </div>' .
        '    </div>' .
        '</div>';
} ?>

<script>
    $('.shop-card button').click(function() {
        var $card = $(this).closest('.card');
        var shop_id = $card.attr('data-id');

        $('[name="shop_id"]').val(shop_id);

        $('#buyer_process').carousel("next");


    })
</script>