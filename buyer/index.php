<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Buyer</title>
    <?php include('../head.php') ?>

    <?php

    if (!isset($_SESSION['id'])) {
        echo "<script type='text/javascript'>document.location.href = 'login.php';</script>";
    }

    $result = $conn->query("SELECT * FROM buyers WHERE id = '$id'");
    $row = $result->fetch_assoc();
    ?>
</head>

<body class="">
    <div class="side-bar">
        <div class="display">
            <!-- <img src="" alt="" width="50px" height="50px" class="user-img"> -->
            <p class="user-img"><i class="fa fa-shopping-bag"></i></p>
            <p class="user-name"><?php echo $row['fname'] . " " . $row['lname'] ?> </p>
            <p class="small font-weight-bold mb-0">User ID : <?php echo $row['id'] ?></p>
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
                <a type="button" class="btn text-light <?php echo ($_GET['page'] == '') ? '' : 'd-none'?>" data-toggle="collapse" data-target=".main"><i class="fa fa-shopping-cart"></i></a>
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu mt-3 dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-list-alt"></i> Token List</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?logout=true"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>
        </div>
        <div class="screen">

            <div class="main collapse container cart-list">

            </div>

            <div class="main collapse show">
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
    </div>

    <script>
        $('[data-target=".main"]').click(function() {
            $('.cart-list').load('request/cart_list.php');
        })

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