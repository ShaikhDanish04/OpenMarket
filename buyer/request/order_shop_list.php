<?php include('../../connect.php');

$result_shops = $conn->query("SELECT DISTINCT shop_id FROM token_list WHERE buyer_id='$id'");
while ($row_shops = $result_shops->fetch_assoc()) {
    $shop_id = $row_shops['shop_id'];

    $row_seller = $conn->query("SELECT * FROM sellers WHERE id='$shop_id'")->fetch_assoc();
    echo '' .
        '<div class="card order-shop-card mb-3" data-shop-id=' . $shop_id . '>' .
        '    <div class="card-body p-2 pr-3">' .
        '        <div class="d-flex align-items-center justify-content-between">' .
        '            <div class="d-flex align-items-center">' .
        '               <div class="card-side-img"><img width="100%" height="100%" src="" alt=""></div>' .
        '               <div class="ml-2">' .
        '                   <p class="card-title h6 mb-1">' . $row_seller['name'] . '</p>' .
        '                   <p class="card-sub-title small text-uppercase mb-0">' . $row_seller['category'] . '</p>' .
        '               </div>' .
        '            </div>' .
        '            <div class="cart-display">' .
        '                <div class="badge badge-warning">' . $count_token = $conn->query("SELECT DISTINCT token_number FROM `token_list` WHERE buyer_id='$id' AND shop_id='$shop_id'")->num_rows . '</div>' .
        '                <button class="btn btn-primary view-tokens"><i class="fa fa-list-alt"></i></button>' .
        '            </div>' .
        '        </div>' .
        '    </div>' .
        '</div>';
} ?>
<style>
    .order-shop-card {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .order-shop-card .card-side-img {
        height: 65px;
        width: 65px;
        background: #999997;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        flex-shrink: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        z-index: 1;
        border-radius: .25rem;
        transform: scale(1);
    }
</style>

<script>
    $('.order-shop-card .view-tokens').click(function() {
        var $card = $(this).closest('.order-shop-card');
        var shop_id = $card.attr('data-shop-id');

        window.sessionStorage.setItem('shop_id', shop_id);
        $('#self_service').carousel("next");
    })
</script>