<?php include('../../connect.php') ?>

<div class=" py-3">
    <p class="font-weight-light h1 text-center mb-3"><i class="fa fa-calendar-check-o small"></i> Your Orders</p>

    <div class="card mb-3">
        <div class="card-body p-1">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item btn-sm">
                    <a class="nav-link active " data-toggle="pill" href="#home">Self-Service</a>
                </li>
                <li class="nav-item  btn-sm">
                    <a class="nav-link disabled" data-toggle="pill" href="#menu1">Home Delivery</a>
                </li>
            </ul>
        </div>
    </div>


    <div class="tab-content">
        <div class="tab-pane container active" id="home">
            <div id="self_service" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item shop-carousel active ">
                        <p class="text-center h4 font-weight-normal mb-3">List of Shops</p>

                        <div class="order-shop-list"></div>
                    </div>
                    <div class="carousel-item order-carousel">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a class="btn text-dark btn-link" href="#self_service" data-slide="prev"><i class="fa fa-chevron-left"></i> Back</a>
                            <p class="text-center h4 font-weight-normal mb-0">List of Tokens</p>
                        </div>

                        <div class="order-token-list"></div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- Tab panes -->
</div>

<script>
    $(document).ready(function() {
        $('.order-shop-list').load('request/order_shop_list.php');

        $("#self_service").on('slid.bs.carousel', function() {
            if ($('.shop-carousel').hasClass('active')) {

                $('.order-shop-list').load('request/order_shop_list.php');
                $('.order-token-list').html('');
                // console.log('shop-carousel');

            }
            if ($('.order-carousel').hasClass('active')) {

                $.ajax({
                    type: "POST",
                    url: "request/order_token_list.php",
                    data: {
                        "shop_id": window.sessionStorage.getItem('shop_id'),
                    },
                    success: function(data) {
                        $('.order-token-list').html(data);
                    }
                });
                // console.log('order-carousel');
            }
        });
    })
</script>

<style>

</style>