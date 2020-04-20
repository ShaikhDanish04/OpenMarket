<div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
    <div class="carousel-inner">
        <div class="carousel-item shop-carousel active">
            <div class="container py-2">
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
            <div class="row no-gutters product-card-list py-2 container"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#search_input').focusin(function() {
            $.getJSON('request/get_product_list.php', function(json) {
                autocomplete($("#search_input")[0], json);
            })
        })

        $('#search_all_products').submit(function(e) {
            $('#search_all_products .btn-success').hide();
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "request/get_from_all_products.php",
                data: $(this).serialize(),
                success: function(data) {
                    $('.all-product-card-list').html(data);
                    $('.shop-card-list').html('');
                    $('#search_all_products .btn-danger').show();
                }
            });
        });

        $('#search_all_products .btn-danger').click(function() {
            $('.shop-card-list').load('request/shop_list.php');
            $(this).hide();
            $('.all-product-card-list').html('');
            $('#search_all_products input').val('');
            $('#search_all_products .btn-success').show();
        });
        $('#search_all_products input').on('focus', function() {
            $('#search_all_products .btn-success').show();
            $('#search_all_products .btn-danger').hide();
        });
    })
</script> <!-- search products script -->

<style>
    .product-card-list {
        transition: all .3s;
    }
</style>
<script>
    $(document).ready(function() {
        $('.shop-card-list').load('request/shop_list.php');
        $('#buyer_process').carousel(Number(window.sessionStorage.getItem('carousel')));


        $("#buyer_process").on('slid.bs.carousel', function() {
            if ($('.shop-carousel').hasClass('active')) {

                $('#search_all_products .btn-success').show();
                $('#search_all_products .btn-danger').hide();

                // console.log('shop-carousel');
                $('.product-card-list').html('');
                $('.shop-card-list').load('request/shop_list.php');
            }
            if ($('.product-carousel').hasClass('active')) {
                // $('.all-product-card-list').html('');
                window.sessionStorage.setItem('carousel', '0');

                $.ajax({
                    type: "POST",
                    url: "request/product_list.php",
                    data: {
                        "shop_id": window.sessionStorage.getItem('shop_id'),
                    },
                    success: function(data) {
                        $('.product-card-list').html(data);
                    }
                });
                // console.log('product-carousel');
            }
        });

        var mousedownX, mousemoveX, $div;
        $("body").on({
            "vmousedown": function(event) {
                $div = $(event.target).closest('.product-card-list');
                mousedownX = event.clientX;
            },
            "vmousemove": function(event) {
                if ($div.hasClass('product-card-list')) {
                    Xpos = (event.clientX - (mousedownX));
                    if (Xpos > 100) {
                        if (Xpos > 180) {
                            $('#buyer_process').carousel("prev");
                        }
                        $div.css('transform', 'translateX(' + (Xpos - 50) + 'px)');
                    }
                }
            },
            "vmouseup": function(event) {
                $div.css('transform', '');
            }
        });

        $("#book_product").on('show.bs.modal', function() {
            $.ajax({
                type: "POST",
                url: "request/product_detail.php",
                data: {
                    "shop_id": window.sessionStorage.getItem('shop_id'),
                    "product_name": window.sessionStorage.getItem('product_id'),
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