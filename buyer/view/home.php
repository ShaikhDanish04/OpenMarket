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
        height: 100%;
    }

    .cart-card .card-side-img,
    .product-card .card-side-img {
        width: auto;
        height: 135px;
    }
</style>

<script>
    $('[name="search_shop"]').on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".shop-list .shop-card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>

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

                <div class="shop-card-list"></div>
            </div>
        </div>
        <div class="carousel-item product-carousel">
            <input type="hidden" name="shop_id">
            <input type="hidden" name="product_name">

            <div class="container py-3">
                <div class="form-group d-flex align-items-center justify-content-between">
                    <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
                    <p class="h6 mb-0">Products</p>
                    <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
                </div>
                <div id="filter_product" class="container collapse">
                    <input type="text" name="search_shop" class="form-control mb-3" placeholder="Search">
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

<script>
    $(document).ready(function() {

        $('.shop-card-list').load('request/shop_list.php');

        $("#buyer_process").on('slid.bs.carousel', function() {
            if ($('.shop-carousel').hasClass('active')) {
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
            console.log('product-modal');
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
                }
            })
            console.log('product-modal');
        });

    })
</script>