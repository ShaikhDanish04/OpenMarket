<?php include('../../connect.php'); ?>

<div class="container py-3">
    <p class="h2 text-center font-weight-light mb-3">Products In Shop</p>

    <?php
    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$id'");

    if ($result->num_rows > 0) {
        echo '<div class="col-12"><p class="text-center"><i class="fa fa-archive text-primary"></i> You have <b>' . $result->num_rows . '</b> Item in Shop</p></div>';

        echo '<input type="text" name="" class="form-control mb-3" placeholder="Search">';
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
                '<div class="product-flat-card">' .
                '    <div class="card product" data-toggle="collapse" href="#details_' . $row['product_name'] . '">' .
                '        <div class="card-side-img"> <img src="../product_list/' . $row['product_name'] . '.jpg" height="100%" alt="" class=""> </div>' .
                '        <div class="card-body">' .
                '            <p class="card-title">' . $row['product_name'] . '</p>' .
                '            <div class="d-flex align-items-center justify-content-between px-1">' .
                '                <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : ' . $quantity . ' </p>' .
                '                <p class="card-text mb-0"><i class="fa fa-money text-success"></i> : ₹ ' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</p>' .
                '            </div>' .
                '        </div>' .
                '    </div>' .
                '    <div id="details_' . $row['product_name'] . '" class="collapse details" data-parent=".container">' .

                '        <div class="form-group mb-1">' .
                '            <label for="">Sold By</label>' .
                '            <select name="sold_by" class="form-control" required>' .
                '                ' . (isset($row['sold_by']) ? '<option value="' . $row['sold_by'] . '"><b>' . $row['sold_by'] . '</b></option>' : '<option value="">--- Select ---</option>') .
                '                <option value="Unit">Unit</option>' .
                '                <option value="Kg">Kg</option>' .
                '                <option value="Liter">Liter</option>' .
                '            </select>' .
                '        </div>' .
                '        <div class="form-group mb-1">' .
                '            <label for="">Quantity</label>' .
                '            <div class="update_product">' .
                '                <button type="button" data-op="update_product" class="btn btn-danger minus-val" tabindex="-1"><i class="fa fa-minus"></i></button>' .
                '                <input type="number" step="0.005" value="' . $row['quantity_of_items'] . '" name="quantity_of_items" class="form-control mx-2 text-center">' .
                '                <button type="button" data-op="update_product" class="btn btn-success plus-val" tabindex="-1"><i class="fa fa-plus"></i></button>' .
                '            </div>' .
                '        </div>' .
                '        <div class="form-group mb-3">' .
                '            <label for="">Enter Price Per Quantity</label>' .
                '            <input type="number" name="price_per_item" placeholder="' . $row['price_per_item'] . '" class="form-control text-center" required>' .
                '        </div>' .
                '        <div class="form-group d-flex mb-2 justify-content-between">' .
                '            <button type="submit" class="btn btn-sm btn-warning ml-1"><i class="fa fa-times"></i> Remove</button>' .
                '            <button type="submit" class="btn btn-sm btn-primary ml-1"><i class="fa fa-pencil-square-o"></i> Update</button>' .
                '        </div>' .
                '    </div>' .
                '</div>';
        }
    } else {
        echo '' .
            '<div class="text-center mx-auto mt-3">' .
            '    <p class="display-4">Empty</p>  ' .
            '    <p class="h6">No Products Available</p>' .
            '</div>';
    }
    ?>
</div>
<style>
    .product-flat-card {
        margin-bottom: .75rem;
    }

    .product-flat-card .product {
        display: flex;
        flex-direction: row;
        transform: scaleY(0.95);
        z-index: 8;
    }

    .product-flat-card .details {
        position: relative;
        z-index: 0;
        margin-top: -5px;
        background: #fff;
        transform: scaleX(0.95);
        padding: .5rem 1rem 5px;
        border-radius: 5px;
        background: linear-gradient(43deg, #f0f0f0, #ffffff);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25)
    }

    .product-flat-card .product:active {
        transform: scale(1.05);
    }

    .product-flat-card .card-body {
        padding: .5rem 0.75rem;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-radius: 5px;
        justify-content: space-between;
        background: linear-gradient(43deg, #ffffff, #f0f0f0);
    }

    .product-flat-card .card-title {
        font-size: 15px;
        margin-bottom: 0.25rem;
        font-weight: 600;
        padding-bottom: .25rem;
        /* border-bottom: 1px solid rgba(0, 0, 0, .25); */
    }

    .product-flat-card .card-text {
        font-size: 11px;
        font-weight: 500;
    }

    .product-flat-card .card-side-img {
        height: 20vw;
        position: relative;
        transform: scaleY(1.05);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        overflow: hidden;
    }

    .product-flat-card label {
        font-size: 12px;
        font-weight: 600;
    }
</style>