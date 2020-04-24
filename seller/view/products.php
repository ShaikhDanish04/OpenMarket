<?php include('../../connect.php'); ?>

<div class="container py-3">
    <p class="h2 text-center font-weight-light mb-3">Products In Shop</p>


    <?php
    $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$id'");

    if ($result->num_rows > 0) {
        echo '<div class="col-12"><p class="text-center"><i class="fa fa-archive text-primary"></i> You have <b>' . $result->num_rows . '</b> Item in Shop</p></div>';

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
                '<div class="card product-flat-card">' .
                '    <div class="card-side-img">' .
                '        <img src="../product_list/' . $row["product_name"] . '.jpg" height="100%" alt="" class="">' .
                '    </div>' .
                '    <div class="card-body">' .
                '        <p class="card-title">' . $row["product_name"] . '</p>' .
                '        <div class="d-flex align-items-center justify-content-between px-1">' .
                '            <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : ' . $quantity  . '</p>' .
                '            <p class="card-text mb-0"><i class="fa fa-money text-success"></i> : ₹ ' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</p>' .
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
        display: flex;
        flex-direction: row;
        margin-bottom: .75rem;
        transform: scaleY(0.95);
    }

    .product-flat-card:active {
        transform: scale(1.05);
    }

    .product-flat-card .card-body {
        padding: .5rem 0.75rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-flat-card .card-title {
        font-size: 12px;
        margin-bottom: 0.25rem;
        font-weight: 600;
        padding-bottom: .25rem;
        border-bottom: 1px solid rgba(0, 0, 0, .25);
    }

    .product-flat-card .card-text {
        font-size: 11px;
        font-weight: 500;
    }

    .product-flat-card .card-side-img {
        height: 70px;
        position: relative;
        transform: scaleY(1.05);
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        overflow: hidden;
    }
</style>