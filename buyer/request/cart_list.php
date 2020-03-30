<p class="display-4 text-center my-3"><i class="fa fa-shopping-cart"></i> Cart List</p>
<?php
include('../../connect.php');

$shop_list = array();
$result = $conn->query("SELECT DISTINCT sellers.* FROM sellers INNER JOIN cart ON cart.shop_id = sellers.id WHERE buyer_id = '$id' AND `status` = 'in'");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $shop_id = $row['id'];
        $items = $conn->query("SELECT * FROM cart WHERE shop_id='$shop_id' AND buyer_id = '$id' AND `status` = 'in'");
        echo '' .
            '<div class="card mb-2">' .
            '    <div class="card-body py-2 d-flex justify-content-between align-items-center">' .
            '        <p class="mb-0"><span class="badge badge-warning">' . $items->num_rows . '</span> ' . $row['name'] . '</p>' .
            '        <button class="btn btn-sm btn-primary show-cart" data-id="' . $row['id'] . '"> <i class=" fa fa-shopping-cart"></i></button>' .
            '    </div>' .
            '</div>';
    }
} else {
    echo '<div class="card mt-3 text-center"><div class="card-body"><p class="h6 m-0">!!! No Cart Available</p></div></div>';
}
?>



<div class="cart-card-list"></div>

<script>
    $('.show-cart').click(function() {
        $('[name="shop_id"]').val($(this).attr('data-id'));

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
    })
</script>