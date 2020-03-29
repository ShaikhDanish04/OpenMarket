<?php include('../../connect.php');

$result = $conn->query("SELECT * FROM sellers");
while ($row = $result->fetch_assoc()) {
    $shop_id = $row['id'];
    $shops = $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'");
    echo '' .
        '<div class="card mb-3 shop-card">' .
        '    <img class="card-side-img" />' .
        '    <div class="card-body">' .
        '        <div class="">' .
        '            <p class="card-title">' . $row['name'] . '</p>' .
        '            <p class="small text-uppercase">' . $row['category'] . '</p>' .
        '        </div>' .
        '        <div class="d-flex align-items-center justify-content-between">' .
        '            <p class="m-0"><b>' . $shops->num_rows . '</b> Item</p>' .
        '            <button class="btn btn-primary btn-sm" data-shop="' . $shop_id . '"><i class="fa fa-shopping-basket"></i> Visit</button>' .
        '        </div>' .
        '    </div>' .
        '</div>';
} ?>

<script>
    $('[data-shop]').click(function() {
        $('[name="shop_id"]').val($(this).attr('data-shop'));

        $.ajax({
            type: "POST",
            url: "request/product_list.php",
            data: {
                "shop_id": $(this).attr('data-shop'),
                "operation": "get_list"
            },
            success: function(data) {
                $('.product_list_container').html(data);
                $('#buyer_process').carousel("next");
            }
        })
    })
</script>