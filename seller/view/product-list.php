<?php include('../../connect.php'); ?>

<style>
    .product {
        padding: .25rem !important;
        margin-bottom: 1rem;
    }

    .product .card-img-top {
        height: 130px;
        background: #ccc;
        margin-bottom: 0px;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        flex-shrink: 0;
        box-shadow: 0 0 10px #ccc;
        border-radius: 5px;
    }


    .product .card {
        height: 100%;
        font-size: 12px;
        max-width: 220px;
        margin: auto;
    }

    .product .card-body {
        padding-top: .5rem;

        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product .card-title {
        font-weight: 500;
        font-variant-caps: titling-caps;
        font-size: 15px;
        padding-bottom: .25rem;
        margin-bottom: .25rem;
        border-bottom: 1px solid #ccc;
    }

    .modal .card-img-top {
        height: 250px;
        background: #ccc;
        margin-bottom: 0px;
    }

    .modal .card-title {
        font-weight: 500;
        font-variant-caps: titling-caps;
        font-size: 25px;
        padding-bottom: .25rem;
        margin-bottom: .25rem;
        border-bottom: 1px solid #ccc;

    }

    .modal .card {
        border: 0;
        box-shadow: 0 0 0;
    }

    [name="price_per_item"] {
        font-size: 30px;
        letter-spacing: 5px;
    }

    .seller-card.card {
        position: relative;
    }

    .seller-card.card [data-remove] {
        opacity: 0;
        transition: .3s;
        border-radius: 50%;
        position: absolute;
        box-shadow: 0 0 5px #8b8b8b;
        top: -10px;
        right: -8px;
        font-size: 8px;
        padding: 6px 8px;
    }

    .seller-card.card:hover [data-remove] {
        opacity: 1;
    }
</style>
<div class="container py-3">
    <p class="display-4 text-center">Products</p>
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-group">
                <input type="text" name="search_product" class="form-control" placeholder="Search">
            </div>
            <div class="btn-group w-100 align-items-center">
                <i class="fa fa-cart-plus mr-2"></i>
                <select name="product_name" class="form-control">
                    <option value="">--- Manage Product ---</option>
                </select>
                <button class="btn btn-sm btn-success ml-2 rounded add-product" style="display: none"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-danger ml-2 rounded remove-product" style="display: none"><i class="fa fa-minus"></i></button>
            </div>
        </div>
    </div>
    <div class="product-list row no-gutters">
        <div class="col-6">
            <div class="card product-card" data-id="Amul Butter (100 Grams)">
                <div class="card-img-top"><img width="100%" src="../product_list/Amul Butter (100 Grams).jpg" alt=""></div> <i class="fa fa-shopping-cart d-none incart"></i>
                <div class="card-body">
                    <div class="">
                        <p class="card-title">Amul Butter (100 Grams)</p>
                        <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>13 Unit </b></p>
                        <p class="card-text mb-0"><i class="fa fa-money text-success"></i> : ₹ <b>40 / <span class="sold_by">Unit</span></b></p>
                    </div>
                    <form action="" class="product_form mt-3" method="post"> <input type="hidden" name="sold_by" value="Unit"> <input type="hidden" name="price_per_item" value="40"> <button class="add_product btn btn-success w-100" data-op="add_product"><i class="fa fa-shopping-bag"></i> Add to Cart</button>
                        <div style="display:none" class="update_product"> <button data-op="update_product" class="btn btn-danger minus-val" tabindex="-1"><i class="fa fa-minus"></i></button> <input type="number" step="0.005" value="" name="quantity_of_items" class="form-control mx-2 text-center"> <button data-op="update_product" class="btn btn-success plus-val" tabindex="-1"><i class="fa fa-plus"></i></button> </div>
                    </form>
                    <div class="estimation text-center font-weight-bold small mt-2"></div>
                    <div class="price text-center"></div>
                </div>
            </div>
        </div>

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
                    '<div class="col-6 product">' .
                    '   <div class="card seller-card">' .
                    '        <button class="btn btn-danger top-remove" data-remove="' . $row["product_name"] . '"><i class="fa fa-times"></i></button>' .
                    '       <img class="card-img-top" src="../product_list/' . $row["product_name"] . '.jpg" alt="">' .
                    '       <div class="card-body">' .
                    '           <p class="card-title">' . $row["product_name"] . '</p>' .
                    '           <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . ' </b></p>' .
                    '           <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</b></p>' .
                    '           <button data-toggle="modal" data-target="#edit_product" class="btn btn-warning btn-sm w-100" data-name="' . $row["product_name"] . '"><i class="fa fa-edit"></i> Edit</button>' .
                    '       </div>' .
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
</div>
<!-- </div> -->
<div class="modal fade" id="product_delete_modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">

            <div class="modal-body text-center">
                <p class="h3 mb-4 mt-3">Delete Product</p>
                <p class="">Are Your Sure ?</p>
                <div class="d-flex justify-content-center mb-3">
                    <button type="button" class="btn mx-2 btn-danger" data-dismiss="modal">No</button>
                    <button type="button" class="btn mx-2 btn-success remove-product">Yes</button>
                </div>
                <p class="small text-justify"><b>Note :</b> Your Token number will be set rejected and all your items will be sent back to your cart.</p>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        fetch('request/get_product_list.php')
            .then(function(response) {
                response.json().then(function(data) {
                    $.each(data, function(index, data) {
                        $('[name="product_name"]').append('<option value="' + data + '">' + data + '</option>');
                    });
                });
            })

        $('[name="search_product"]').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $('.product-list .product').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('[name="product_name"]').change(function() {
            console.log($(this).val());
            $('.add-product').hide();
            $('.remove-product').hide();

            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "check",
                    "product_name": $('[name="product_name"]').val()
                },
                success: function(data) {
                    // add-product
                    $.ajax({
                        type: "POST",
                        url: "request/manage_product_in_shop.php",
                        data: {
                            "operation": "add",
                            "product_name": $('[name="product_name"]').val()
                        },
                        success: function(data) {
                            // product-details

                            $('.modal [name="operation"]').val('update_product');
                            $.ajax({
                                type: "POST",
                                url: "request/manage_product_in_shop.php",
                                data: {
                                    "operation": "get_data",
                                    "product_name": $('[name="product_name"]').val()
                                },
                                success: function(data) {
                                    var productObj = JSON.parse(data);
                                    $('.modal .card-title').text(productObj.product_name);
                                    $('.modal [name="product_name"]').val(productObj.product_name);


                                    $('.modal [name="sold_by"]').val(productObj.sold_by);
                                    $('.modal [name="quantity_of_items"]').val(productObj.quantity_of_items);
                                    $('.modal [name="price_per_item"]').val(productObj.price_per_item);

                                    $('#edit_product').modal("show");
                                }
                            });
                        }
                    });
                }
            });

        });

        $('[data-remove]').click(function() {
            $('#product_delete_modal').attr('data-id', $(this).attr('data-remove'));
            $('#product_delete_modal').modal('show');
        })

        $('.remove-product').click(function() {
            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "remove",
                    "product_name": $('#product_delete_modal').attr('data-id')
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
        $('[data-name]').click(function() {
            $('.modal [name="operation"]').val('update_product');

            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "get_data",
                    "product_name": $(this).attr('data-name')
                },
                success: function(data) {
                    var productObj = JSON.parse(data);
                    $('.modal .card-title').text(productObj.product_name);
                    $('.modal [name="product_name"]').val(productObj.product_name);

                    $('.modal .card-img-top').attr("src", "../product_list/" + productObj.product_name + ".jpg");

                    $('.modal [name="sold_by"]').val(productObj.sold_by);
                    $('.modal [name="quantity_of_items"]').val(productObj.quantity_of_items);
                    $('.modal [name="price_per_item"]').val(productObj.price_per_item);
                }
            });
        })
    })
</script>


<script>
    $('form').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            type: "POST",
            url: "request/manage_product_in_shop.php",
            data: $(this).serialize(), // serializes the form's elements.
            success: function(data) {
                location.reload();
            }
        });
    })
</script>

<script>
    $('.product-card .card-img-top').click(function() {
        $('.product-card').removeClass('open');
        $('.col-6').removeClass('col-12');

        if ($(this).hasClass('active')) {
            $('.product-card .card-img-top').removeClass('active');
        } else {
            $($(this).closest('.product-card')).toggleClass('open');
            $($(this).closest('.col-6')).toggleClass('col-12');
            $(this).addClass('active');
        }
    })
</script>