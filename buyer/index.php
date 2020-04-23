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

<body class="">
    <input type="hidden" name="shop_id">
    <input type="hidden" name="product_name">

    <div class="content-view">
        <div class="action-bar">
            <div class="start">
                <p class="text-light m-0 ml-1"><i class="fa fa-shopping-bag"></i> OpenMarket</p>
            </div>
            <div class="end">
                <a type="button" class="btn text-light" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>

                <div class="dropdown-menu mt-3 dropdown-menu-right ">
                    <div class="display alert-primary m-2 rounded p-2 text-center">
                        <p class="m-0"><?php echo $row['fname'] . " " . $row['lname'] ?> </p>
                        <p class="small font-weight-bold"><?php echo $row['username'] ?></p>
                        <button class="btn btn-dark btn-sm" data-screen="settings"><i class="fa fa-cog"></i> Settings</button>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="p-2">
                        <a class="dropdown-item alert-danger rounded" href="?logout=true" data-ajax="false"><i class="fa fa-sign-out"></i> Logout</a>
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
                    '    <a data-screen="location" class="alert-link text-decoration-underline"><i class="fa fa-hand-o-right"></i> Click Here</a>' .
                    '</div>';
            } ?>
        </div>
        <!-- <button class="btn btn-dark submit-btn">Submit</button> -->

        <div class="screen"></div>

        <div class="bottom-nav">
            <a class="list-item" data-screen="location">
                <i class="fa fa-map-marker"></i>
                <p class="">Location</p>
            </a>
            <a class="list-item cart-display token-btn" data-screen="token-list">
                <i class="fa fa-list-alt"></i>
                <p class="">Tokens</p>
                <span class="badge badge-primary"></span>
            </a>
            <a class="list-item active" data-screen="home">
                <div class="home-nav">
                    <i class="fa fa-home"></i>
                    <p class="">Home</p>
                    <i class="fa fa-circle-o-notch fa-spin loading"></i>
                </div>
            </a>
            <a class="list-item cart-display cart-btn" data-screen="cart">
                <i class="fa fa-shopping-cart"></i>
                <p class="">Cart</p>
                <span class="badge badge-warning"></span>
            </a>
            <a class="list-item" data-screen="orders">
                <i class="fa fa-calendar-check-o"></i>
                <p class="">Orders</p>
            </a>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="confirm">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="h3 mb-4 mt-3 confirm-title"></p>
                    <p class="">Are Your Sure ?</p>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" class="btn mx-2 btn-danger" id="confirm_no">No</button>
                        <button type="button" class="btn mx-2 btn-success" id="confirm_yes">Yes</button>
                    </div>
                    <p class="small text-justify"><b>Note :</b> <span class="confirm-note"></span></p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function cconfirm(title, note, yes) {
        $('#confirm').find('.confirm-title').text(title);
        $('#confirm').find('.confirm-note').text(note);
        $('#confirm').modal("show");

        $('#confirm_yes').click(function() {
            if ($('#confirm').hasClass('show')) {
                yes();
            }
            $('#confirm').modal('hide');
        });

        $('#confirm_no').click(function() {
            $('#confirm').modal('hide');
        });
    }
    $(document).ready(function() {

        $('.submit-btn').click(function() {
            // mconfirm('Delete Modal', 'This will Delete All Your Data');
            cconfirm('Delete Model', 'The is not reversable and the token will be deleted, you can still see this in orders record',
                function() {
                    // Do something
                    console.log('YES');
                    $('.cart-btn .badge').load('request/count_carts.php');

                }
            );


        })

    })
</script>
<script>
    window.onscroll = function(e) {
        // print "false" if direction is down and "true" if up
        if (scrollY > 40) {
            $('.action-bar').css('margin-top', '-' + Number($('.action-bar').innerHeight()) + 'px');
        } else {
            $('.action-bar').css('margin-top', '0px');
        }
        if (this.oldScroll > this.scrollY) {
            $('.action-bar').css('margin-top', '0px');
        }
        this.oldScroll = this.scrollY;
    }
    $(document).ajaxStart(function() {
        $('.loading').fadeIn();
    });
    $(document).ajaxSuccess(function() {
        $('.loading').fadeOut();
    })
    $(document).ajaxError(function() {
        // location.reload();
    })

    $(document).ready(function() {
        $('.content-view').css('margin-top', $('.action-bar').innerHeight());
        $('.content-view').css('margin-bottom', $('.bottom-nav').innerHeight());

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