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
                    <div class="carousel-item active">
                        <p class="text-center h4 font-weight-normal mb-3">List of Shops</p>
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <p class="card-title h6 mb-1">My Dairy</p>
                                        <p class="card-sub-title small text-uppercase mb-0">dairy</p>
                                    </div>
                                    <div class="cart-display">
                                        <div class="badge badge-warning">2</div>
                                        <button class="btn btn-primary" href="#self_service" data-slide="next"><i class="fa fa-list-alt"></i> Orders</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a class="btn text-dark btn-link" href="#self_service" data-slide="prev"><i class="fa fa-chevron-left"></i> Back</a>
                            <p class="text-center h4 font-weight-normal mb-0">List of Tokens</p>
                        </div>
                        <div class="token-card card mb-3 pending" data-shop-id="a87ff679a2f3e71d9181a67b7542122c" data-token-number="1">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="card-title h6 mb-0">Token No : 1</p>
                                        <p class="card-title mb-0 small">27 / 02 / 2020 - 10:00 AM</p>
                                    </div>
                                    <div class="cart-display">
                                        <div class="badge badge-warning">2</div>
                                        <button class="btn btn-primary" href="#shop_a87ff679a2f3e71d9181a67b7542122c" data-toggle="collapse"><i class="fa fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body collapse py-0" id="shop_a87ff679a2f3e71d9181a67b7542122c">
                                <div class="d-flex my-3">
                                    <div class="card-side-img"><img height="100%" width="100%" src="../product_list/Egg.jpg" alt=""></div>
                                    <div class="pl-2 pt-2 w-100">
                                        <div class="d-flex align-items-center justify-content-between pl-1 mb-1">
                                            <p class="mb-1 h6 small">Egg</p>
                                            <p class="text-success px-2 mb-0"><i class="fa fa-check"></i></p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between pl-1">
                                            <p class=" mb-0 card-title small font-weight-bold">₹5 </p>
                                            <p class=" mb-0 card-title small font-weight-bold">1 Unit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex my-3">
                                    <div class="card-side-img"><img height="100%" width="100%" src="../product_list/Milk.jpg" alt=""></div>
                                    <div class="pl-2 pt-2 w-100">
                                        <div class="d-flex align-items-center justify-content-between pl-1 mb-1">
                                            <p class="mb-1 h6 small">Milk</p>
                                            <p class="text-success px-2 mb-0"><i class="fa fa-check"></i></p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between pl-1">
                                            <p class=" mb-0 card-title small font-weight-bold">₹69 </p>
                                            <p class=" mb-0 card-title small font-weight-bold">1 liter 500 ml</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="h6 p-3 text-center mb-0">Total Price : ₹ <b>74</b></p>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- Tab panes -->
</div>

<style>
    #home .token-card {
        flex-shrink: 0;
        margin-right: 5px;
        overflow-y: scroll;
    }

    .token-card .card-side-img {
        width: 70px;
        height: 70px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        flex-shrink: 0;
    }
</style>