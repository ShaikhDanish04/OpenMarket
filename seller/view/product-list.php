<style>
    .product {
        padding: .25rem !important;
        margin-bottom: 1rem;
        ;
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
    <!-- Nav pills -->
    <ul class="nav nav-pills nav-justified mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#packed_product">Packed Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#loose_product">Loose Product</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="packed_product">
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
                        $result = $conn->query("SELECT * FROM `packed_products` WHERE shop_id='$id'");
                        while ($row = $result->fetch_assoc()) {
                            echo '' .
                                '<div class="col-6 product">' .
                                '   <div class="card">' .
                                '       <img class="card-img-top" src="holder.js/100x180/" alt="">' .
                                '       <div class="card-body">' .
                                '           <p class="card-title">' . $row["product_name"] . '</p>' .
                                '           <p class="card-text mb-0">Quantity : <b>' . $row['quantity_of_items'] . ' </b></p>' .
                                '           <p class="card-text">Price : <b>' . $row['price_per_item'] . ' Rs</b></p>' .
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
        <script>

        </script>
        <div class="tab-pane fade" id="loose_product">
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
                </div>
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
                            <div class="form-group">
                                <label for="">Enter Quantity in Number</label>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-danger minus-val btn-lg" tabindex="-1"><i class="fa fa-minus"></i></button>
                                    <input type="number" value="0" min="0" name="quantity_of_items" class="form-control mx-2 btn-lg text-center" required>
                                    <button type="button" class="btn btn-success plus-val btn-lg" tabindex="-1"><i class="fa fa-plus"></i></button>
                                </div>
                                <small class="text-muted">*Required</small>
                            </div>
                            <div class="form-group">
                                <label for="">Enter Price Per Item</label>
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
        fetch('request/get_packed_product_list.php')
            .then(function(response) {
                response.json().then(function(data) {
                    $.each(data, function(index, data) {
                        $('#packed_product [name="product_name"]').append('<option value="' + data + '">' + data + '</option>');
                    });
                });
            })

        $('#packed_product [name="search_product"]').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $('#packed_product .product-list .product').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#packed_product [name="product_name"]').change(function() {
            console.log($(this).val());
            $('#packed_product .add-product').hide();
            $('#packed_product .remove-product').hide();

            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "check",
                    "product_name": $('#packed_product [name="product_name"]').val()
                },
                success: function(data) {
                    console.log(data);
                    if (data == 0) $('#packed_product .add-product').show();
                    else $('#packed_product .remove-product').show();
                }
            });

        });
        $('#packed_product .add-product').click(function() {
            $.ajax({
                type: "POST",
                url: "request/manage_product_in_shop.php",
                data: {
                    "operation": "add",
                    "product_name": $('#packed_product [name="product_name"]').val()
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
        $('#packed_product .remove-product').click(function() {
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
        $('#packed_product [data-name]').click(function() {
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


                    $('.modal [name="quantity_of_items"]').val(productObj.quantity_of_items);
                    $('.modal [name="price_per_item"]').val(productObj.price_per_item);
                }
            });
        })
    })
</script>

<script>
    $(document).ready(function() {
        fetch('request/get_loose_product_list.php')
            .then(function(response) {
                response.json().then(function(data) {
                    $.each(data, function(index, data) {
                        $('#loose_product [name="product_name"]').append('<option value="' + data + '">' + data + '</option>');
                    });
                });
            })
        $('#loose_product [name="search_product"]').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $('#loose_product .product-list .product').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
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

    $('.minus-val').click(function() {
        $(this).next().val(Number($(this).next().val()) - Number(1));
    })
    $('.plus-val').click(function() {
        $(this).prev().val(Number($(this).prev().val()) + Number(1));
    })
</script>