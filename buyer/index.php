<!DOCTYPE html>
<html lang="en">

<head>
    <title>Open Market : Buyer</title>
    <?php include('../head.php') ?>

    <?php

    if (!isset($_SESSION['id']) || $_SESSION['type'] != "buyer") {
        session_unset();
        session_destroy();
        echo "<script type='text/javascript'>document.location.href = 'login.php';</script>";
    }

    $result = $conn->query("SELECT * FROM buyers WHERE id = '$id'");
    $row = $result->fetch_assoc();
    ?>
</head>

<style>
    .cart-display.cart-btn {
        position: relative;
        cursor: pointer;
    }

    .cart-display.cart-btn .badge {
        position: absolute;
        top: -8px;
        right: -12px;
    }
</style>

<body class="">
    <input type="hidden" name="shop_id">
    <input type="hidden" name="product_name">

    <div class="side-bar">

        <div class="menu-list">
            <a href="?" class="list-item"><i class="fa fa-home"></i> Home</a>
            <a href="?page=token-list" class="list-item"><i class="fa fa-list-alt"></i> Token List</a>
            <a href="?page=location" class="list-item"><i class="fa fa-map-marker"></i> My Location</a>
        </div>
    </div>

    <div class="content-view">
        <div class="action-bar">
            <div class="start">
                <p class="text-light m-0 ml-1"><i class="fa fa-shopping-bag"></i> OpenMarket</p>
            </div>
            <div class="end">
                <span class="cart-display cart-btn <?php echo ($_GET['page'] == '') ? '' : 'd-none' ?>" data-toggle="collapse" data-target=".main">
                    <a type="button" class="btn text-light"><i class="fa fa-shopping-cart"></i></a>
                </span>
                <a type="button" class="btn text-light home-btn <?php echo ($_GET['page'] == '') ? '' : 'd-none' ?>" data-toggle="collapse" data-target=".main"><i class="fa fa-home"></i></a>
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                <div class="dropdown-menu mt-3 dropdown-menu-right ">
                    <a class="dropdown-item" href="?logout=true"><i class="fa fa-sign-out"></i> Logout</a>
                    <div class="dropdown-divider"></div>
                    <div class="display alert-primary m-2 rounded p-2 text-center">
                        <p class="m-0"><?php echo $row['fname'] . " " . $row['lname'] ?> </p>
                        <p class="small font-weight-bold"><?php echo $row['username'] ?></p>
                        <button class="btn btn-dark btn-sm" data-screen="settings"><i class="fa fa-cog"></i> Settings</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="alert-area">
            <?php if ($row['pincode'] == '0') {
                echo '' .
                    '<div class="alert alert-warning fade show mb-0">' .
                    '    <button type="button" class="close" data-dismiss="alert">&times;</button>' .
                    '    <strong>Warning !!!</strong>' .
                    '    <p class="mt-1 mb-1"><i class="fa fa-map-marker text-danger"></i> Please Set Your Location Pointer</p>' .
                    '    <div class="divider"></div>' .
                    '    <a href="?page=location" class="alert-link text-decoration-underline"><i class="fa fa-hand-o-right"></i> Click Here</a>' .
                    '</div>';
            } ?>
        </div>

        <div class="screen my-5"></div>
        <script>
            $(document).ready(function() {
                $('.screen').load('view/home.php');

                $('[data-screen]').click(function() {
                    $('[data-screen]').removeClass('active');
                    $(this).addClass('active');

                    $('.screen').load('view/' + $(this).attr('data-screen') + '.php');
                })
            })
        </script>
        <div class="bottom-nav nav">
            <a class="list-item" data-screen="location">
                <i class="fa fa-map-marker"></i>
                <p class="">Location</p>
            </a>
            <a class="list-item" data-screen="token-list">
                <i class="fa fa-list-alt"></i>
                <p class="">Token</p>
            </a>
            <a class="list-item active" data-screen="home">
                <div class="home-nav">
                    <i class="fa fa-home"></i>
                    <p class="">Home</p>
                </div>
            </a>
            <a class="list-item cart-display cart-btn" data-screen="cart">
                <i class="fa fa-shopping-cart"></i>
                <p class="">Cart</p>
                <span class="badge badge-warning"></span>
            </a>
            <a class="list-item" href="?">
                <i class="fa fa-search"></i>
                <p class="">search</p>
            </a>
        </div>

        <style>
            .bottom-nav {
                display: inline-grid;
                background: #fff;
                padding: 8px 0px;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                grid-auto-flow: column;
                grid-auto-columns: 1fr;
                box-shadow: 0 0 5px #ccc;
                justify-items: center;
            }

            .bottom-nav .list-item {
                text-decoration: none;
                color: #000;
                text-align: center;
            }


            .bottom-nav .list-item p {
                font-size: 11px;
                margin-bottom: 0px;
            }

            .bottom-nav a.list-item.active {
                color: #351fb1;
                text-shadow: 0 0 1px;
            }

            .home-nav {
                position: relative;
                top: -50%;
                background: #1c0d70;
                color: #fff;
                border-radius: 50%;
                height: 55px;
                width: 55px;
                margin-bottom: -50%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                box-shadow: 0 0 20px #aaa;

            }
        </style>
    </div>

    <script>
        $('.menu-toggle').click(function() {
            $('body').toggleClass('menu-open');
        })
        $('.content-view .screen').click(function() {
            $('body').removeClass('menu-open');
        })
    </script>

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

                            <div class="product-detail"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>