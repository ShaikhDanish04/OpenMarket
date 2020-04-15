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


    .searched-product-card .card-side-img,
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

    .searched-product-card .card-body,
    .shop-card .card-body,
    .product-card .card-body {
        padding: 0.75rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }


    .searched-product-card .card-title,
    .shop-card .card-title,
    .product-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
    }

    .searched-product-card .card-text,
    .shop-card .card-text,
    .product-card .card-text {
        font-size: 12px;
    }

    .product-card.card {
        flex-direction: column;
        margin-left: 5px;
        margin-right: 5px;
        height: 100%;
    }

    .card.product-card .card-img-top {
        box-shadow: 0 0 10px #ccc;
        border-radius: 5px;
    }

    .cart-card .card-side-img,
    .product-card .card-side-img {
        width: auto;
        height: 135px;
    }
</style>


<div class="main collapse container cart-list pb-3"></div>
<div class="main collapse show">
    <div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
        <div class="carousel-inner">
            <div class="carousel-item shop-carousel active">
                <div class="container py-3">
                    <?php include("search.php") ?>

                    <style>
                        .shop-card.card {
                            flex-direction: column;
                        }

                        .shop-card .shop-head {
                            display: flex;
                            flex-direction: row;
                            min-height: inherit;
                        }

                        .rating i.fa {
                            color: #f8c100;
                        }

                        .rating span.value {
                            margin-right: .5rem;
                            font-weight: 600;
                            border-left: 1px solid rgba(0, 0, 0, .25);
                            padding-left: .25rem;
                        }

                        .address {
                            background: #f3f3f3;
                            border-radius: .5rem;
                            transition: .5s;
                            /* margin-bottom: .5rem; */
                            padding: .5rem 1rem;
                            text-align: justify;
                            box-shadow: 0px 4px 8px #ddd;
                        }
                    </style>

                    <div class="shop-card-list">

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
                    <div id="filter_produc" class="container">
                        <input type="text" name="search_product" class="form-control mb-3" placeholder="Search">
                    </div>

                    <div class="row no-gutters product-card-list"></div>
                </div>
            </div>
            <div class="carousel-item cart-carousel">
                <div class="container py-3">
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
                        <p class="h6 mb-0"><i class="fa fa-shopping-cart"></i> Cart</p>
                        <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
                    </div>

                    <div class="cart-card-list"></div>
                    <div class="card fixed-card mt-3">
                        <div class="card-body p-2">
                            <button class="btn btn-primary w-100" href="#buyer_process" data-slide="prev"><i class="fa fa-chevron-left"></i> Shop More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.home-btn').addClass('d-none');

        $('.shop-card-list').load('request/shop_list.php');

        $('.cart-btn .badge').load('request/count_carts.php');

        $("#buyer_process").on('slid.bs.carousel', function() {
            if ($('.shop-carousel').hasClass('active')) {
                $('#search_all_products .btn-success').show();
                $('#search_all_products .btn-danger').hide();
                $('.shop-card-list').load('request/shop_list.php');
                console.log('shop-carousel');
            }
            if ($('.product-carousel').hasClass('active')) {
                $.ajax({
                    type: "POST",
                    url: "request/product_list.php",
                    data: {
                        "shop_id": $('[name="shop_id"]').val(),
                        "operation": "get_list"
                    },
                    success: function(data) {
                        $('.product-card-list').html(data);

                    }
                })
                console.log('product-carousel');
            }
            if ($('.cart-carousel').hasClass('active')) {
                $.ajax({
                    type: "POST",
                    url: "request/manage_cart.php",
                    data: {
                        "shop_id": $('[name="shop_id"]').val(),
                        "operation": "get_cart_list"
                    },
                    success: function(data) {
                        $('.cart-card-list').html(data);
                    }
                })
                console.log('cart-carousel');
            }
        });

        $("#book_product").on('show.bs.modal', function() {
            $.ajax({
                type: "POST",
                url: "request/product_detail.php",
                data: {
                    "shop_id": $('[name="shop_id"]').val(),
                    "product_name": $('[name="product_name"]').val(),
                    "operation": "get_product"
                },
                success: function(data) {
                    $('.product-detail').html(data);
                    // console.log(data);
                }
            })
            console.log('product-modalshow');
        });
        $("#book_product").on('hide.bs.modal', function() {
            $.ajax({
                type: "POST",
                url: "request/product_list.php",
                data: {
                    "shop_id": $('[name="shop_id"]').val(),
                    "operation": "get_list"
                },
                success: function(data) {
                    $('.product-card-list').html(data);
                    $('#search_all_products').submit();
                    $('.cart-list').load('request/cart_list.php');
                }
            })
            console.log('product-modal-hide');
        });

        $('.main').on('hidden.bs.collapse', function() {
            if ($('.cart-list').hasClass('show')) {
                $('.cart-btn').addClass('d-none');
                $('.home-btn').removeClass('d-none');
            } else {
                $('.home-btn').addClass('d-none');
                $('.cart-btn').removeClass('d-none');
            }

            $('.cart-list').load('request/cart_list.php');
            $("#buyer_process").carousel(0);
        });

    })
</script>