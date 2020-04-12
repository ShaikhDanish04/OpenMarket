<?php include('../../connect.php');

$search_product = $_POST['search'];

if ($search_product != '') {
    $result = $conn->query("SELECT * FROM `seller_product_stock` INNER JOIN sellers ON sellers.id = seller_product_stock.shop_id WHERE product_name LIKE '$search_product%'");
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
            echo '' .
                '<div class="card searched-product-card mb-3">' .
                '    <div class="card product" data-toggle="collapse" data-target="#collapse_' . $row['shop_id'] . '">' .
                '        <img class="card-side-img" src="holder.js/100x180/" alt="">' .
                '        <div class="card-body">' .
                '            <p class="card-title">' . $row['product_name'] . '</p>' .
                '            <p class="card-text"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity . ' </b></p>' .
                '            <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / <span class="sold_by">' . $row['sold_by'] . '</span></b></p>' .
                '            <button class="mt-3 btn btn-success btn-sm w-100"><i class="fa fa-shopping-bag"></i> Book</button>' .
                '        </div>' .
                '    </div>' .
                '    <div id="collapse_' . $row['shop_id'] . '" class="collapse small m-2">' .
                '        <div class="d-flex align-items-center justify-content-between p-1 mb-2">' .
                '            <p class="ml-1"><b>11</b> Product in stock</p>' .
                '            <button class="btn btn-primary btn-sm"><i class="fa fa-shopping-basket"></i></button>' .
                '        </div>' .
                '        <p class="address"><i class="fa fa-map-marker text-danger"></i> ' . $row['area'] . ', ' . $row['sub-district'] . ', ' . $row['district'] . ', ' . $row['state'] . '</p>' .
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
}
