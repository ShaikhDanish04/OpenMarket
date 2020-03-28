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
                        <input type="text" name="search_product" id="" class="form-control" placeholder="Search">
                    </div>
                    <div class="btn-group w-100 mb-3">
                        <select name="product_name" class="form-control">
                            <option value="">--- Select Product ---</option>
                        </select>
                        <button class="btn btn-success ml-1 rounded add-product" style="display: none"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-danger ml-1 rounded remove-product" style="display: none"><i class="fa fa-minus"></i></button>
                    </div>
                    <script>
                        $(document).ready(function() {
                            fetch('request/get_packed_product_list.php')
                                .then(function(response) {
                                    response.json().then(function(data) {
                                        $.each(data, function(index, data) {
                                            $('[name="product_name"]').append('<option value="' + data + '">' + data + '</option>');
                                        });
                                    });
                                })

                            $('[name="search_product"]').on("keyup", function() {
                                var value = $(this).val().toLowerCase();
                                $(".product-list .product").filter(function() {
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

                            })
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
                            })
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
                            })
                        })
                    </script>
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
                                '           <button class="btn btn-warning btn-sm w-100"><i class="fa fa-edit"></i> Edit</button>' .
                                '       </div>' .
                                '    </div>' .
                                '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="loose_product">
        </div>
    </div>


</div>