<!DOCTYPE html>
<html lang="en">

<head>
    <title>Open Market : Seller</title>
    <?php include('../head.php') ?>

    <?php

    if (!isset($_SESSION['id']) || $_SESSION['type'] != "seller") {
        session_unset();
        session_destroy();
        echo "<script type='text/javascript'>document.location.href = 'login.php';</script>";
    }

    $result = $conn->query("SELECT * FROM sellers WHERE id = '$id'");
    $row = $result->fetch_assoc();
    ?>
</head>

<body class="">
    <div class="content-view">
        <div class="action-bar">
            <div class="start">
                <p class="text-light m-0 ml-1"><i class="fa fa-shopping-bag"></i> OpenMarket</p>
            </div>
            <div class="end">
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                <div class="dropdown-menu mt-3 dropdown-menu-right ">
                    <div class="display alert-primary m-2 rounded p-2 text-center">
                        <p class="m-0"><?php echo $row['name'] ?> </p>
                        <p class="small text-uppercase mb-1"><?php echo $row['category'] ?></p>
                        <div class="divider"></div>
                        <p class="small font-weight-bold"><?php echo $row['username'] ?></p>
                        <button class="btn btn-dark btn-sm" data-screen="settings"><i class="fa fa-cog"></i> Settings</button>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="p-2">
                        <a class="dropdown-item alert-danger rounded" href="?logout=true"><i class="fa fa-sign-out"></i> Logout</a>
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

        <div class="bottom-nav">
            <a class="list-item" data-screen="location">
                <i class="fa fa-map-marker"></i>
                <p class="">Location</p>
            </a>
            <a class="list-item cart-display token-btn" data-screen="token-list">
                <i class="fa fa-list-alt"></i>
                <p class="">Token</p>
                <span class="badge badge-primary">0</span>
            </a>
            <a class="list-item active" data-screen="home">
                <div class="home-nav">
                    <i class="fa fa-home"></i>
                    <p class="">Home</p>
                    <i class="fa fa-circle-o-notch fa-spin loading"></i>
                </div>
            </a>
            <a class="list-item cart-display cart-btn" data-screen="product-list">
                <i class="fa fa-archive"></i>
                <p class="">Products</p>
                <span class="badge badge-warning"></span>
            </a>
            <a class="list-item" data-screen="products">
                <i class="fa fa-cog"></i>
                <p class="">settings</p>
            </a>
        </div>
    </div>
</body>
<script>
    $(document).ajaxStart(function() {
        $('.loading').fadeIn();
    });
    $(document).ajaxComplete(function() {
        $('.loading').fadeOut();
    })
    $(document).ajaxError(function() {
        // location.reload();
    })

    $(document).ready(function() {
        $('.screen').load('view/home.php');
        $('.cart-btn .badge').load('request/count_carts.php');
        $('.token-btn .badge').load('request/count_tokens.php');


        $('[data-screen]').click(function() {
            $('[data-screen]').removeClass('active');
            $(this).addClass('active');

            $('.screen').load('view/' + $(this).attr('data-screen') + '.php');
        })
    })
</script>


</html>