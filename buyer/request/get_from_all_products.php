<?php include('../../connect.php');

$search_product = $_POST['search'];

if ($search_product != '') {
    $result = $conn->query("SELECT * FROM `seller_product_stock` INNER JOIN sellers ON sellers.id = seller_product_stock.shop_id WHERE product_name LIKE '%$search_product%'");

    echo '<p class="text-center"><b>' . $result->num_rows . '</b> Result Found for <b>"' . $search_product . '"</b></p>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quantity = $row['quantity_of_items'];

            $unit = explode('.', strval($row['quantity_of_items']));

            if ($row['sold_by'] == "Kg") {
                $quantity = $unit[0] . ' kilo ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' gram';
            }
            if ($row['sold_by'] == "Liter") {
                $quantity = $unit[0] . ' liter ' . substr(strval($row['quantity_of_items'] * 1000), '-3') . ' ml';
            }
            if ($row['sold_by'] == "Unit") {
                $quantity = $unit[0] . ' Unit ';
            }

            $product_incart = false;
            $product_result = $conn->query("SELECT * FROM `cart` WHERE buyer_id='$id' AND `status`='in'");
            while ($product_row = $product_result->fetch_assoc()) {

                if ($row['shop_id'] == $product_row['shop_id'] && $row['product_name'] == $product_row['product_name']) {
                    $product_incart = true;
                }
            }
            $shop_id = $row['shop_id'];

            echo '' .
                '<div class="card searched-product-card mb-3" data-product-id="' . $row['product_name'] . '" data-shop-id="' . $row['shop_id'] . '">' .
                '    <div class="card product" data-toggle="collapse" data-target="#collapse_' . $row['shop_id'] . '_' . $row['product_name'] . '">' .
                '        <img class="card-side-img" src="holder.js/100x180/" alt="">' .
                '        <div class="card-body">' .
                '            <p class="card-title">' . $row['product_name'] . '</p>' .
                '            <p class="card-text"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity . ' </b></p>' .
                '            <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / <span class="sold_by">' . $row['sold_by'] . '</span></b></p>' .
                (($product_incart) ?
                    '               <p class="mb-2 small text-center text-danger font-weight-bold">Already In Cart</p>' :
                    '            <button class="mt-3 btn btn-success btn-sm w-100 book-btn"><i class="fa fa-shopping-bag"></i> Book</button> ') .
                '        </div>' .
                '    </div>' .
                '    <div id="collapse_' . $row['shop_id'] . '_' . $row['product_name'] . '" class="collapse small m-2">' .
                '        <div class="d-flex align-items-center justify-content-between p-1 mb-2">' .
                '            <p class="ml-1"><b>' . $conn->query("SELECT * FROM seller_product_stock WHERE shop_id='$shop_id'")->num_rows . '</b> Product in stock</p>' .
                '            <button class="btn btn-primary btn-sm visit-btn"><i class="fa fa-shopping-basket"></i></button>' .
                '        </div>' .
                '        <div class="address"> ' .
                '           <p class="mb-1"><b>Address : </b> ' . $row['address'] . '</p>' .
                '           <i class="fa fa-map-marker text-danger"></i> ' . $row['area'] . ' - ' . $row['region'] . ', ' . $row['district'] . ', ' . $row['state'] . ' - ' . $row['pincode'] .
                '        </div>' .
                '    </div>' .
                '    <div class="d-flex align-items-center justify-content-between p-2">' .
                '        <div>' .
                '            <p class="font-weight-bold small text-capitalize">' . $row['name'] . '</p>' .
                '            <p class="small text-uppercase">' . $row['category'] . '</p>' .
                '        </div>' .
                '        <div class="rating">' .
                '            <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i>' .
                '        </div>' .
                '    </div>' .
                '</div>';
        }
    } else {
        echo "No results found";
    }
} ?>
<script>
    $('.searched-product-card .book-btn').click(function() {
        var $card = $(this).closest('.card.searched-product-card');
        var product_id = $card.attr('data-product-id');
        var shop_id = $card.attr('data-shop-id');

        // console.log(product_id);
        $('[name="shop_id"]').val(shop_id);
        $('[name="product_name"]').val(product_id);

        $('#book_product').modal('show');
    });
    $('.searched-product-card .visit-btn').click(function() {
        var $card = $(this).closest('.card');
        var shop_id = $card.attr('data-shop-id');

        $('[name="shop_id"]').val(shop_id);

        $('#buyer_process').carousel("next");


    })
</script>