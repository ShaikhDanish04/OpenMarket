<style>
    .product {
        padding: .25rem !important;
        margin-bottom: 1rem;
    }

    .product .card-img-top {
        height: 130px;
        background: #ccc;
        margin-bottom: 0px;
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
</style>
<div class="container py-3">
    <p class="display-4 text-center">Products</p>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <input type="text" name="search_product" class="form-control" placeholder="Search">
            </div>
            <div class="btn-group w-100 mb-3 align-items-center">
                <i class="fa fa-cart-plus mr-2"></i>
                <select name="product_name" class="form-control">
                    <option value="">--- Manage Product ---</option>
                </select>
                <button class="btn btn-sm btn-success ml-2 rounded add-product" style="display: none"><i class="fa fa-plus"></i></button>
                <button class="btn btn-sm btn-danger ml-2 rounded remove-product" style="display: none"><i class="fa fa-minus"></i></button>
            </div>
            <div class="product-list row no-gutters">
                <?php
                $result = $conn->query("SELECT * FROM `seller_product_stock` WHERE shop_id='$id'");
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
                        '   <div class="card">' .
                        '       <img class="card-img-top" src="holder.js/100x180/" alt="">' .
                        '       <div class="card-body">' .
                        '           <p class="card-title">' . $row["product_name"] . '</p>' .
                        '           <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>' . $quantity  . ' </b></p>' .
                        '           <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>' . $row['price_per_item'] . ' / ' . $row['sold_by'] . '</b></p>' .
                        '           <button data-toggle="modal" data-target="#edit_product" class="btn btn-warning btn-sm w-100" data-name="' . $row["product_name"] . '"><i class="fa fa-edit"></i> Edit</button>' .
                        '       </div>' .
                        '    </div>' .
                        '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="edit_product">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body p-0">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-edit"></i> Edit Product</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title"></p>
                            <input type="hidden" name="operation">
                            <input type="hidden" name="product_name">

                            <div class="form-group mt-3">
                                <label for="">Sold By</label>
                                <select name="sold_by" class="form-control" required>
                                    <option value="">--- Select ---</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Liter">Liter</option>
                                </select>
                                <small class="text-muted">*Required</small>
                            </div>

                            <div class="form-group">
                                <label for="">Enter Quantity in Number</label>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-danger minus-val btn-lg" tabindex="-1"><i class="fa fa-minus"></i></button>
                                    <input type="number" step="0.005" value="0" min="0" name="quantity_of_items" class="form-control mx-2 btn-lg text-center" required>
                                    <button type="button" class="btn btn-success plus-val btn-lg" tabindex="-1"><i class="fa fa-plus"></i></button>
                                </div>
                                <p class="h4 mt-3 text-center estimation"></p>
                                <small class="text-muted">*Required</small>
                            </div>
                            <script>
                                $('.minus-val').click(function() {
                                    $(this).next().val(Number($(this).next().val()) - Number(1));
                                    $(this).next().change();
                                })
                                $('.plus-val').click(function() {
                                    $(this).prev().val(Number($(this).prev().val()) + Number(1));
                                    $(this).prev().change();
                                })
                                $('[name="quantity_of_items"],.modal-body').on('change click', function() {
                                    var value = $('[name="quantity_of_items"]').val();
                                    var unit = value.toString().split(".");

                                    if ($('[name="sold_by"]').val() == "Kg") {
                                        $('.estimation').text(unit[0] + ' kilo ' + Number((value * 1000).toString().slice(-3)) + ' gram');
                                    }
                                    if ($('[name="sold_by"]').val() == "Liter") {
                                        $('.estimation').text(unit[0] + ' liter ' + Number((value * 1000).toString().slice(-3)) + ' ml');
                                    }
                                    if ($('[name="sold_by"]').val() == "Unit") {
                                        $('.estimation').text(unit[0] + ' Unit ');
                                        $(this).attr('step', '1');
                                    } else {
                                        $(this).attr('step', '0.005');
                                    }
                                })
                            </script>
                            <div class="form-group">
                                <label for="">Enter Price Per Quantity</label>
                                <input type="text" name="price_per_item" class="form-control" required>
                                <small class="text-muted">*Required</small>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                    console.log(data);
                    if (data == 0) $('.add-product').show();
                    else $('.remove-product').show();
                }
            });

        });
        $('.add-product').click(function() {
            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "add",
                    "product_name": $('[name="product_name"]').val()
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
        $('.remove-product').click(function() {
            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "remove",
                    "product_name": $('[name="product_name"]').val()
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