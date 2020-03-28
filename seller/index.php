<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Seller</title>
    <?php include('../head.php') ?>

    <?php
    
    if (!isset($_SESSION['id'])) {
        echo "<script type='text/javascript'>document.location.href = 'login.php';</script>";
    }
    
    $result = $conn->query("SELECT * FROM sellers WHERE id = '$id'");
    $row = $result->fetch_assoc();
    ?>
</head>

<body class="">
    <style>
        .action-bar {
            display: flex;
            background: #ee1565;
            padding: 8px;
            align-items: center;
            justify-content: space-between;
        }

        .action-bar .middle {
            font-weight: 500
        }

        .side-bar {
            position: fixed;
            width: 230px;
            background: #6b6868;
            height: 100%;
            left: -230px;
            transition: .5s;
            z-index: 1;
        }

        .content-view {
            width: 100%;
            overflow: hidden;
            margin: 0px;
            transition: .5s;
        }

        .menu-open .side-bar {
            left: 0px;
            box-shadow: 0 2px 6px #aaa;
        }

        .menu-open .content-view {
            left: 0px;
            margin-left: 230px;
        }

        .side-bar .display {
            background: #1c0d70;
            color: #fff;
            padding: 1rem;
            box-shadow: -2px 2px 5px #555;
        }

        .display .user-img {
            border: 2px solid #a2a2a2;
            border-radius: 50%;
            height: 50px;
            width: 50px;
            display: block;
            background: #fff;
            margin-bottom: 1rem;
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .display .user-name {
            margin-bottom: 0px;
            font-weight: 600
        }

        .menu-list .list-item {
            display: block;
            padding: .75rem 1rem;
            background: #c4c4c4;
            color: #000;
            margin: 10px 8px;
            border-radius: 10px;
        }

        .menu-list .list-item:nth-child(even) {
            background: #a8a8a8;
        }

        .menu-list .list-item:hover {
            background: #1e1e1e;
            color: #fff;
            text-decoration: none;
        }
    </style>
    <div class="side-bar">
        <div class="display">
            <!-- <img src="" alt="" width="50px" height="50px" class="user-img"> -->
            <p class="user-img"><i class="fa fa-shopping-bag"></i></p>
            <p class="user-name"><?php echo $row['name'] ?></p>
            <p class="small text-uppercase"><?php echo $row['category'] ?></p>
            <p class="small font-weight-bold mb-0">Seller ID : <?php echo $row['id'] ?></p>
        </div>
        <div class="menu-list">
            <a href="?" class="list-item"><i class="fa fa-home"></i> Home</a>
            <a href="?page=add-product" class="list-item"><i class="fa fa-cart-plus"></i> Add New Product</a>
            <a href="?page=product-list" class="list-item"><i class="fa fa-archive"></i> Get Product List</a>
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
                <button type="button" class="btn" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                <div class="dropdown-menu mt-3">
                    <a class="dropdown-item" href="?logout=true">Logout</a>
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