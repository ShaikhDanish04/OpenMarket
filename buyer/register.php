<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Buyer</title>
    <?php include('../head.php') ?>
</head>

<body>
    <style>
        .card {
            margin: 20px auto;
            max-width: 350px;
            box-shadow: 2px 2px 8px #ccc;
        }

        [name="OTP"] {
            font-size: 35px;
            letter-spacing: 10px;
            text-align: center;
            font-weight: 400;
        }
    </style>
    <div class="container">

        <div class="card my-3">
            <div class="card-body">
                <p class="display-4 text-center">Register</p>

                <form action="" method="post">
                    <div id="seller_register" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="true" data-slide="false">
                        <div class="carousel-inner">
                            <div class="carousel-item p-1 active">
                                <p class="text-center mb-4 h3">BUYER</p>

                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <small class="text-muted">*Enter Your Name</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <small class="text-muted">*Enter Your Surname</small>
                                </div>

                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-primary initial">Next <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
                                </div>
                                <script>
                                    $('.initial').click(function() {
                                        if ($('[name="name"]').val() != '' && $('[name="category"]').val() != "") $("#seller_register").carousel("next");
                                        else $('.response').text('Please Fill All Details First');
                                    })
                                </script>
                            </div>

                            <div class="carousel-item p-1">
                                <p class="h3 text-center mb-4">Verification</p>
                                <div class="form-group">
                                    <label for="">Email ID</label>
                                    <input type="text" name="email" class="form-control">
                                    <button type="button" class="btn btn-sm btn-success d-block ml-auto mt-1">Send OTP</button>
                                </div>

                                <div class="form-group">
                                    <label for="">OTP</label>
                                    <input type="text" name="OTP" maxlength="6" class="form-control">
                                </div>

                                <div class="form-group d-flex justify-content-between">
                                    <button type="button" class="btn btn-dark" href="#seller_register" data-slide="prev"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i> Prev</button>
                                    <button type="button" class="btn btn-primary verification">Next <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
                                </div>
                                <script>
                                    $('.verification').click(function() {
                                        if ($('[name="phone"]').val() != '' && $('[name="OTP"]').val() != "") $("#seller_register").carousel("next");
                                        else $('.response').text('Please Fill All Details First');

                                    })
                                </script>
                            </div>


                            <div class="carousel-item p-1">
                                <p class="h3 text-center mb-3">Thank You</p>
                                <p class="h6 text-center text-success">Your OTP is Verified !!!</p>

                                <div class="form-group">
                                    <label for="">Enter Password</label>
                                    <input type="password" name="password" minlength="6" class="form-control">
                                    <small class="text-muted">*Must be more than 6 Digit</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control">
                                </div>

                                <div class="form-group d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success w-100" minle disabled name="register_submit">Submit</button>
                                </div>

                                <script>
                                    $('[name="confirm_password"]').keyup(function() {
                                        if ($(this).val() != $('[name="password"]').val()) {
                                            $('[name="register_submit"]').attr('disabled', 'true');
                                            $('.response').text('Password Should Match');
                                        } else {
                                            $('[name="register_submit"]').removeAttr('disabled');
                                            $('.response').text('');
                                        }
                                    })
                                </script>

                            </div>
                        </div>

                    </div>
                </form>
                <p class="response small font-weight-bold text-center text-danger m-0"></p>
                <script>
                    $("#seller_register").on('slide.bs.carousel', function() {
                        $(".response").text('');
                    });
                </script>
            </div>
            <div class="card-footer">
                <p class="text-center small mb-0">Already Registed ? <a href="login.php" class="font-weight-bold">Login</a></p>

            </div>
        </div>
    </div>
    </div>
</body>

</html>