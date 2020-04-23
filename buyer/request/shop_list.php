<?php include('../../connect.php');


$result = $conn->query("SELECT * FROM sellers");
while ($row = $result->fetch_assoc()) {
    $shop_id = $row['id'];
    // print_r($row);
    $count_token = $conn->query("SELECT DISTINCT token_number FROM `token_list` WHERE buyer_id='$id' AND shop_id='$shop_id' AND `status`='pending'")->num_rows;
    if ($count_token > 0) $count_token = '<div class="badge badge-primary p-2 ml-1"><i class="fa fa-list-alt"></i> ' . $count_token . '</div>';
    else $count_token = '';

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
        '        <div class="d-flex">   ' .
        '           <div class="badge badge-warning p-2 ml-1"><i class="fa fa-shopping-bag"></i> ' . $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND shop_id='$shop_id'")->num_rows . '</div>' . $count_token .
        '        </div>   ' .
        '        <div class="d-flex">   ' .
        '           <div class="rating">' .
        '               <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i> <span class="value">4.5</span>' .
        '           </div>' .
        '           <div><i class="fa fa-bookmark-o"></i></div>' .
        '       </div>   ' .
        '    </div>' .
        '    <div class="next_span btn btn-primary btn-sm"> <i class="fa fa-chevron-right"></i> </div>' .
        '</div>';
} ?>
<style>
    .shop-card {
        transition: .15s all;
        z-index: 2;
    }

    .shop-card .shop-head {
        z-index: 1;
    }

    .next_span {
        position: absolute;
        right: 40px;
        top: 50px;
        transform: translateY(50%);
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

    var mousedownX, mousemoveX, $card, $slide_left = false;
    $(".shop-card-list").on({
        "vmousedown": function(event) {
            $card = $(event.target).closest('.shop-card');
            $next = $card.find('.next_span');
            $img = $card.find('.card-side-img');
            mousedownX = event.clientX;
        },
        "vmousemove": function(event) {
            if ($card.hasClass('shop-card')) {
                Xpos = (event.clientX - (mousedownX));
                if (Xpos < -50 && Xpos > -120) {
                    if (Xpos < -80) {
                        $slide_left = true;
                    } else {
                        $slide_left = false;
                    }
                    $card.css('transform', 'translateX(' + Xpos + 'px)');
                    $next.css('right', 'calc(' + Xpos + 'px + 35px)');
                }
                if (Xpos > 50 && Xpos < 80) {
                    $card.css('transform', 'translateX(' + Xpos + 'px)');
                    $img.click();
                }
            }
            console.log('shop_list');
        },
        "vmouseup": function(event) {
            if ($slide_left) {
                var shop_id = $card.attr('data-id');
                window.sessionStorage.setItem('shop_id', shop_id);
                $('#buyer_process').carousel("next");
            }
            $card.css('transform', '');
            $next.css('right', '50px');
        }
    });
</script>