<?php include('../../connect.php');

if ($_POST['operation'] == "get_list") {
    $shop_id = $_POST['shop_id'];
    $product_list = array();
    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$shop_id'");

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
                '<div class="card product-card">' .
                '    <img class="card-side-img" src="holder.js/100x180/" alt="">' .
                '    <div class="card-body">' .
                '        <p class="card-title">' . $row['product_name'] . '</p>' .
                '        <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . '</b></p>' .
                '        <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</b></p>' .
                '        <button data-toggle="modal" data-target="#edit_product" class="btn btn-success btn-sm w-100" data-name="' . $row["product_name"] . '"><i class="fa fa-shopping-bag"></i> Book</button>' .
                '    </div>' .
                '</div>';
        }
    } else {
        echo ''.
        '<div class="card">'.
        '    <div class="card-body d-flex align-items-center flex-column">'.
        '        <p class="display-4">Sorry</p>'.
        '        <p class="h6">No Products Available</p>'.
        '        <button class="btn btn-danger mt-3" href="#buyer_process" data-slide="prev"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i> Back</button>'.
        '    </div>'.
        '</div>';
    }
}
