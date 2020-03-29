<style>
    .shop-card {
        display: flex;
        height: 150px;
        flex-direction: row;
    }

    .card-side-img {
        height: 100%;
        width: 135px;
        background: #999997;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
    }

    .shop-card .card-body {
        padding: 0.75rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .shop-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
    }

    .product-card {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 1rem;
    }

    .product-card .card-side-img {
        height: auto;
        flex-shrink: 0;
    }

    .product-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
        font-size: 13px;
    }

    .product-card .card-text {
        font-size: 14px;
    }

    .order-list {
        position: fixed;
        border-radius: 5px;
        bottom: 10px;
        left: 10px;
        right: 10px;
        box-shadow: 0 0 12px #9c9c9c;
    }

    .order-list .items-in-list {
        max-height: 70vh;
        overflow-y: scroll;
    }

    .product-carousel {
        margin-bottom: 50px;
    }

    .carousel-item {
        min-height: 95vh;
    }
</style>


<div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container py-3">
                <div class="form-group d-flex">
                    <input type="text" name="search_shop" class="form-control" placeholder="Search">
                    <button class="btn btn-secondary ml-2" data-toggle="collapse" data-target="#filter_container"><i class="fa fa-filter"></i></button>
                </div>
                <div id="filter_container" class="container collapse">
                    <div class="card mb-3">
                        <div class="card-body">

                        </div>
                    </div>
                </div>

                <div class="shop-list"></div>

            </div>
        </div>
        <div class="carousel-item product-carousel">
            <div class="container py-3">
                <input type="hidden" name="shop_id">
                <input type="hidden" name="buyer_id" value="<?php echo $id ?>">

                <div class="form-group d-flex align-items-center justify-content-between">
                    <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
                    <p class="h6 mb-0">Products</p>
                    <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
                </div>
                <div id="filter_product" class="container collapse">
                    <input type="text" name="search_shop" class="form-control mb-3" placeholder="Search">
                </div>

                <div class="product_list_container"></div>

            </div>
        </div>
    </div>
</div>
<div class="order-list" style="display: none">
    <div id="check_list" class="collapse">
        <div class="card mb-1">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="h4 m-0">Order list</p>
                    <a class="btn close" data-toggle="collapse" data-target="#check_list">&times;</a>
                </div>
                <div class="items-in-list"></div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> Order</button>
                    <button class="btn btn-success"><i class="fa fa-check"></i> Get Token</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-body p-2">
            <button class="btn btn-primary w-100" data-toggle="collapse" data-target="#check_list"><i class="fa fa-list-alt"></i> Order List</button>
        </div>
    </div>
</div>

<div class="modal" id="book_product">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Book Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p class="">Product Name : <b class="product_name_get"></b></p>
                    <input type="hidden" name="operation" value="add_order">
                    <input type="hidden" name="buyer_id">
                    <input type="hidden" name="shop_id">
                    <input type="hidden" name="product_name">
                    <input type="hidden" name="sold_by">

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

                    <div class="mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[name="search_shop"]').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".shop-list .shop-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.shop-list').load('request/shop_list.php');

        $("#buyer_process").on('slid.bs.carousel', function() {
            if ($('.product-carousel').hasClass('active')) {
                $.ajax({
                    type: "POST",
                    url: "request/manage_order_list.php",
                    data: {
                        "operation": "get_order_list",
                        "shop_id": $('[name="shop_id"]').val()
                    },
                    success: function(data) {
                        $('.items-in-list').html(data);
                        if (data != '') {
                            $('.order-list').slideDown();
                        }
                    }
                });
            } else {
                $('.order-list').slideUp();
            }
        });
        $('[data-target="#check_list"]').click(function() {
            $.ajax({
                type: "POST",
                url: "request/manage_order_list.php",
                data: {
                    "operation": "get_order_list",
                    "shop_id": $('[name="shop_id"]').val()
                },
                success: function(data) {
                    $('.items-in-list').html(data);
                    if (data != '') {
                        $('.order-list').slideDown();
                    }
                }
            })
        });

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
        $('form').submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.

            $.ajax({
                type: "POST",
                url: "request/manage_order_list.php",
                data: $(this).serialize(), // serializes the form's elements.
                success: function(data) {
                    // location.reload();
                    console.log(data);
                    $('#book_product').modal('hide');


                    $.ajax({
                        type: "POST",
                        url: "request/manage_order_list.php",
                        data: {
                            "operation": "get_order_list",
                            "shop_id": $('[name="shop_id"]').val()
                        },
                        success: function(data) {
                            // location.reload();
                            // console.log(data);
                            $('.items-in-list').html(data);
                            if (data != '') {
                                $('.order-list').slideDown();
                            }
                        }
                    })
                }
            });
        })
    })
</script>