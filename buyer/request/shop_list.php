<?php include('../../connect.php');

$result = $conn->query("SELECT * FROM sellers");
while ($row = $result->fetch_assoc()) {
    $shop_id = $row['id'];
    // print_r($row);
    echo '' .
        '<div class="card mb-3 shop-card" data-id="' . $row['id'] . '">' .
        '    <div class="shop-head card">' .
        '        <img class="card-side-img" src="" alt="" data-toggle="collapse" data-target="#collapse_' . $row['id'] . '">' .
        '        <div class="card-body visit-btn">' .
        '            <div class="">' .
        '                <p class="card-title">' . $row['name'] . '</p>' .
        '                <p class="small text-uppercase">' . $row['category'] . '</p>' .
        '            </div>' .
        '            <div class="d-flex flex-column align-items-center justify-content-between">' .
        '                <button class="btn btn-primary btn-sm mb-2"><i class="fa fa-shopping-basket"></i> Visit</button>' .
        '                <p class="m-0 small"><b>' . $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'")->num_rows . '</b> Product In Shop</p>' .
        '            </div>' .
        '        </div>' .
        '    </div>' .
        '    <div id="collapse_' . $row['id'] . '" class="small m-2 collapse">' .
        '        <div class="address"> ' .
        '           <p class="mb-1"><b>Address : </b> ' . $row['address'] . '</p>' .
        '           <i class="fa fa-map-marker text-danger"></i> ' . $row['area'] . ' - ' . $row['region'] . ', ' . $row['district'] . ', ' . $row['state'] . ' - ' . $row['pincode'] .
        '        </div>' .
        '    </div>' .
        '    <div class="d-flex align-items-center justify-content-between p-2">' .
        '        <div class="badge badge-warning p-2 ml-1"><i class="fa fa-shopping-bag"></i> ' . $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id' AND `status`='in'")->num_rows . '</div>' .
        '        <div class="d-flex">   ' .
        '           <div class="rating">' .
        '               <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i> <span class="value">4.5</span>' .
        '           </div>' .
        '           <div><i class="fa fa-bookmark-o"></i></div>' .
        '       </div>   ' .
        '    </div>' .
        '</div>';
} ?>
<style>
    .shop-card {
        transition: .3s all;
    }
</style>

<script>
    $('.shop-card .visit-btn').click(function() {
        var $card = $(this).closest('.shop-card');
        var shop_id = $card.attr('data-id');

        $('[name="shop_id"]').val(shop_id);
        window.sessionStorage.setItem('shop_id', shop_id);

        $('#buyer_process').carousel("next");
    })

    var mousedownX, mousemoveX, $card, $process = false;
    $("body").on({
        "vmousedown": function(event) {
            $card = $(event.target).closest('.shop-card');
            mousedownX = event.clientX;
        },
        "vmousemove": function(event) {
            if ($card.hasClass('shop-card')) {
                Xpos = (event.clientX - (mousedownX));
                if (Xpos < 0 && Xpos > -100) {
                    if (Xpos < -80) {
                        $process = true;
                    } else {
                        $process = false;

                    }
                    $card.css('transform', 'translateX(' + Xpos + 'px)');
                }
            }
        },
        "vmouseup": function(event) {
            if ($process) {
                var shop_id = $card.attr('data-id');
                window.sessionStorage.setItem('shop_id', shop_id);
                $('#buyer_process').carousel("next");
            }
            $card.css('transform', '');
        }
    });
</script>