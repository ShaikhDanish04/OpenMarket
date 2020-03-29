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
            <a href="?page=product-list" class="list-item"><i class="fa fa-archive"></i> Products In Shop</a>
            <a href="?page=location" class="list-item"><i class="fa fa-map-marker"></i> My Location</a>
            <a href="?page=token-history" class="list-item"><i class="fa fa-list-alt"></i> Token History</a>
        </div>
    </div>
    <div class="content-view">
        <div class="action-bar">
            <div class="start">
                <button class="btn menu-toggle"><i class="fa fa-bars"></i></button>
            </div>
            <div class="middle text-light">
                Dashboard
            </div>
            <div class="end">
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu mt-3 dropdown-menu-right">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-list-alt"></i> Token List</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?logout=true"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </div>
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



</body>

</html>