<style>
    .carousel-item {
        min-height: 95vh;
    }

    .shop-card.card,
    .product-card.card {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 1rem;
    }


    .cart-card .card-side-img,
    .shop-card .card-side-img,
    .product-card .card-side-img {
        height: auto;
        width: 135px;
        background: #999997;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        flex-shrink: 0;
    }

    .modal img.card-img-top {
        height: 225px;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        flex-shrink: 0;
    }

    .shop-card .card-body,
    .product-card .card-body {
        padding: 0.75rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


    .shop-card .card-title,
    .product-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
    }

    .shop-card .card-text,
    .product-card .card-text {
        font-size: 12px;
    }

    .product-card.card {
        flex-direction: column;
        margin-left: 5px;
        margin-right: 5px;
    }

    .cart-card .card-side-img,
    .product-card .card-side-img {
        width: auto;
        height: 135px;
    }


    .cart-carousel {
        padding-bottom: 50px;
    }

    .modal .card-side-img {
        width: auto;
        height: 300px;
    }
</style>

<script>
    $('[name="search_shop"]').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".shop-list .shop-card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('.minus-val').click(function() {
        $(this).next().val(Number($(this).next().val()) - Number(1));
        $(this).next().change();
    })
    $('.plus-val').click(function() {
        $(this).prev().val(Number($(this).prev().val()) + Number(1));
        $(this).prev().change();
    })
</script>


<a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
<a href="#buyer_process" data-slide="next" class="btn"><i class="fa fa-chevron-right text-dark"></i></a>

<div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
    <div class="carousel-inner">
        <div class="carousel-item shop-carousel active">
            <div class="container py-3">
                <div class="form-group d-flex">
                    <input type="text" name="search_shop" class="form-control" placeholder="Search">
                    <button class="btn btn-secondary ml-2" data-toggle="collapse" data-target="#filter_container"><i class="fa fa-filter"></i></button>
                </div>
                <div id="filter_container" class="container collapse">
                    <div class="card mb-3">
                        <div class="card-body"></div>
                    </div>
                </div>

                <div class="shop-card-list">
                    <div class="card mb-3 shop-card">
                        <img class="card-side-img" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <div class="">
                                <p class="card-title">Danish Shaikh</p>
                                <p class="small text-uppercase">general store</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="m-0"><b>4</b> Item</p>
                                <button class="btn btn-primary btn-sm" href="#buyer_process" data-slide="next" data-shop="1"><i class="fa fa-shopping-basket"></i> Visit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item product-carousel">
            <div class="container py-3">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
                    <p class="h6 mb-0">Products</p>
                    <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
                </div>
                <div id="filter_product" class="container collapse">
                    <input type="text" name="search_shop" class="form-control mb-3" placeholder="Search">
                </div>

                <div class="row no-gutters product-card-list">
                    <div class="col-6">
                        <div class="card product-card">
                            <img class="card-side-img" src="holder.js/100x180/" alt="">
                            <div class="card-body">
                                <div class="mb-3">
                                    <p class="card-title">Barley</p>
                                    <p class="card-text mb-0"><i class="fa fa-archive text-primary"></i> : <b>4 Unit </b></p>
                                    <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>12 / <span class="sold_by">Unit</span></b></p>
                                </div>
                                <button data-toggle="modal" data-target="#book_product" class="btn btn-success btn-sm w-100" data-product-name="Barley"><i class="fa fa-shopping-bag"></i> Book</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item cart-carousel">
            <div class="container py-3">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
                    <p class="h6 mb-0"><i class="fa fa-shopping-cart"></i> Cart</p>
                    <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
                </div>

                <div class="cart-card-list">
                    <div class="card cart-card mb-3">
                        <img class="card-side-img" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title h6">Barley : <b>0 kilo 0 gram</b></p>
                            <p class="card-text"><i class="fa fa-money text-success"></i> : ₹ <b>12 / <span class="sold_by">Kg</span></b></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            <button class="btn btn-sm btn-warning" href="#buyer_process" data-slide="prev"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>

                <div class="card fixed-card">
                    <div class="card-body p-2">
                        <button class="btn btn-success w-100"><i class="fa fa-list-alt"></i> Get Token</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="book_product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fa fa-shopping-bag"></i> Book</span>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title h5">Barley</p>
                            <input type="hidden" name="operation" value="update_product">
                            <input type="text" name="product_name">

                            <div class="form-group">
                                <label for="">Enter Quantity in Number</label>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-danger minus-val btn-sm" tabindex="-1"><i class="fa fa-minus"></i></button>
                                    <input type="number" step="0.005" value="0" min="0" name="quantity_of_items" class="form-control mx-2 btn-sm text-center" required="">
                                    <button type="button" class="btn btn-success plus-val btn-sm" tabindex="-1"><i class="fa fa-plus"></i></button>
                                </div>
                                <p class="h4 mt-3 text-center estimation"></p>
                                <small class="text-muted">*Required</small>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <button type="button" class="btn btn-danger " data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal" href="#buyer_process" data-slide="next">Submit</button>
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
        $('.shop-list').load('request/shop_list.php');

        $("#buyer_process").on('slid.bs.carousel', function() {
            // if ($('.product-carousel').hasClass('active')) {
            //     $.ajax({
            //         type: "POST",
            //         url: "request/manage_order_list.php",
            //         data: {
            //             "operation": "get_order_list",
            //             "shop_id": $('[name="shop_id"]').val()
            //         },
            //         success: function(data) {
            //             $('.items-in-list').html(data);
            //             if (data != '') {
            //                 $('.order-list').slideDown();
            //             }
            //         }
            //     });
            // } else {
            //     $('.order-list').slideUp();
            // }
            console.log($('.shop-carousel').hasClass('active'))
            console.log($('.product-carousel').hasClass('active'))
            console.log($('.cart-carousel').hasClass('active'))
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

            // $.ajax({
            //     type: "POST",
            //     url: "request/manage_order_list.php",
            //     data: $(this).serialize(), // serializes the form's elements.
            //     success: function(data) {
            //         // location.reload();
            //         console.log(data);
            //     }
            // });
        })
    })
</script>