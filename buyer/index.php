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
        top: -5px;
        right: 5px;
    }
</style>

<body class="">
    <input type="hidden" name="shop_id">
    <input type="hidden" name="product_name">

    <div class="side-bar">
        <div class="display">
            <!-- <img src="" alt="" width="50px" height="50px" class="user-img"> -->
            <p class="user-img"><i class="fa fa-shopping-bag"></i></p>
            <p class="user-name"><?php echo $row['fname'] . " " . $row['lname'] ?> </p>
            <p class="small font-weight-bold mb-0"><?php echo $row['username'] ?></p>
        </div>
        <div class="menu-list">
            <a href="?" class="list-item"><i class="fa fa-home"></i> Home</a>
            <a href="?page=token-list" class="list-item"><i class="fa fa-list-alt"></i> Token List</a>
            <a href="?page=location" class="list-item"><i class="fa fa-map-marker"></i> My Location</a>
        </div>
    </div>

    <div class="content-view">
        <div class="action-bar">
            <div class="start">
                <button class="btn menu-toggle"><i class="fa fa-bars"></i></button>
                <p class="text-light m-0 ml-3">Dashboard</p>
            </div>
            <div class="middle text-light">
            </div>
            <div class="end">
                <span class="cart-display cart-btn <?php echo ($_GET['page'] == '') ? '' : 'd-none' ?>" data-toggle="collapse" data-target=".main">
                    <a type="button" class="btn text-light"><i class="fa fa-shopping-cart"></i></a>
                    <span class="badge badge-warning"></span>
                </span>
                <a type="button" class="btn text-light home-btn <?php echo ($_GET['page'] == '') ? '' : 'd-none' ?>" data-toggle="collapse" data-target=".main"><i class="fa fa-home"></i></a>
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu mt-3 dropdown-menu-right">
                    <a class="dropdown-item" href="?page=token-list"><i class="fa fa-list-alt"></i> Token List</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?logout=true"><i class="fa fa-sign-out"></i> Logout</a>
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
        <div class="screen">
            <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] == '') {
                    $page = "home";
                } else {
                    $page = $_GET['page'];
                }
            } else {
                $page = "home";
            }
            include("view/" . $page . ".php");

            ?>

        </div>
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