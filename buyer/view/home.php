<div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
    <div class="carousel-inner">
        <div class="carousel-item shop-carousel active">
            <div class="container py-3">
                <form id="search_all_products" autocomplete="off" action="" class="mb-3">
                    <div class="autocomplete d-flex">
                        <input id="search_input" class="form-control  mr-2" type="text" name="search" placeholder="Search for products" required>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                        <button type="button" class="btn btn-danger" style="display: none"><i class="fa fa-times"></i></button>
                    </div>
                </form>


                <?php include("search.php") ?>

                <div class="all-product-card-list"></div>
                <div class="shop-card-list"></div>
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
<script>
    $(document).ready(function() {

        $('.shop-card-list').load('request/shop_list.php');

        $("#buyer_process").on('slid.bs.carousel', function() {
            if ($('.shop-carousel').hasClass('active')) {
                $('#search_all_products .btn-success').show();
                $('#search_all_products .btn-danger').hide();
                $('.shop-card-list').load('request/shop_list.php');
                // console.log('shop-carousel');
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
                });
                // console.log('product-carousel');
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
                // console.log('cart-carousel');
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
            // console.log('product-modalshow');
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
            // console.log('product-modal-hide');
        });
    })
</script>