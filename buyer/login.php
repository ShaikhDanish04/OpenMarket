<!DOCTYPE html>
<html lang="en">

<head>
    <title>OpenMarket</title>
    <?php include('../head.php') ?>
    <?php
    if (isset($_SESSION['id']) && $_SESSION['type'] == "buyer") {
        echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
    }
    ?>
</head>

<style>
    body {
        background: #fafafa
    }

    .top-stick {
        position: relative;
        border-top: 5px solid #a80c45;
        box-shadow: 0px 3px 18px rgba(0, 0, 0, .75);
        width: 100%;
    }

    .auth {
        /* background: #e9e9e9; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        max-width: 330px;
    }


    .submit-btn {
        background: linear-gradient(45deg, #751056, #251075);
        color: #fff;
        border: 2px solid transparent;
    }

    .toggle-btn {
        /* background: #fff; */
        background: linear-gradient(45deg, #d8d8d8, #fff);
        border: 2px solid #70106b;
        color: #331070;
    }

    .user-submit button {
        border-radius: 5rem;
        box-shadow: 0px 9px 15px rgba(0, 0, 0, .35);
        width: 100%;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        user-select: none;
        padding: .375rem .75rem;
        outline: none;
        transition: .15s ease-in-out;
        font-size: 12px;
    }

    .user-submit button:active {
        transform: scale(1.05);
    }

    .user-submit button:disabled {
        opacity: .75;
        cursor: none;
    }

    .remember-me {
        height: 20px;
        width: 20px;
    }

    .user-input {
        background: linear-gradient(45deg, #d8d8d8, #fff);
        padding: 1rem;
        border-radius: 10px;
        margin-top: 1rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    }

    .input-box {
        position: relative;
    }

    .input-box label {
        color: #a71267;
        font-weight: 500;
        font-size: 12px;
        margin: 0px 5px;
    }

    .input-box small {
        font-size: 11px;
    }

    .input-box input {
        background: transparent;
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        border: 0;
        border-radius: 0;
        border-bottom: 1px solid #a7a7a7;
        outline: 0;
        transition: all .3s;
    }

    .input-box input:valid {
        margin-top: 5px;
        background: #fff;
        border: 0;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.5) inset;
    }

    .forgot-link {
        font-weight: 600;
        color: #b31267;
        font-size: 14px;
        text-align: right;
        display: block;
        margin: 10px 10px 1.5rem;
        outline: none;
    }

    .terms a {
        color: #6e1059;
        text-decoration: underline;
    }

    .reg.card {
        background: linear-gradient(45deg, #d8d8d8, #fff);
        width: 100%;
    }
</style>

<?php
$status = "";
if (isset($_POST['login_submit'])) {

    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $result = $conn->query("SELECT (id) FROM buyers WHERE username='$username' AND `password`='$password'");
    $row = $result->fetch_assoc();

    if ($result->num_rows == 1) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['type'] = "buyer";
        echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
    } else {
        $status = '<div class="alert alert-danger mt-3 mb-0 w-100 alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> Invalid Details !!! Try Again</div>';
    }
}
if (isset($_POST['register_submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_name = $_POST['username'];
    $password = sha1($_POST['password']);

    $result = $conn->query("SELECT * FROM buyers ORDER BY `count` DESC LIMIT 1");
    $row = $result->fetch_assoc();

    if ($row['count'] == null) {
        $count = 1;
    } else {
        $count = $row['count'] + 1;
    }
    $id = md5($count);
    $dateCreated = date("d-m-Y h:i:s a");
    $query_response = $conn->query("INSERT INTO buyers (`count`,`id`,`fname`,`lname`, `username`,`password`,`dateCreated`) VALUES ('$count','$id','$fname', '$lname', '$user_name','$password','$dateCreated')");

    if ($query_response === TRUE) {
        $status = '' .
            '<div class="reg card">' .
            '    <div class="card-body text-center">' .
            '        <p class="text-info font-weight-bold mb-2">You are Registed Successfully</p>' .
            '    <div class="divider mb-2"></div>' .
            '        <p class="h4">' . $fname . ' ' . $lname . '</p>' .
            '        <p class="h5">' . $user_name . '</p>' .
            '    </div>' .
            '</div>';
    } else {
        $status = '<div class="alert alert-danger my-3">Error !!! Try Again</div>';
    }
}
?>

<body>
    <div class="top-stick"></div>
    <div class="auth mb-3 mt-4 container">
        <?php echo $status; ?>

        <form action="" id="login_form" method="post" data-ajax="false" class="w-100 collapse show">
            <div class="user-input">
                <div class="brand-logo text-center mt-3 mb-5">
                    <img class="mx-auto my-3 d-block" src="../logo.png" height="120px" alt="">
                    <p class="h4">OpenMarket</p>
                    <p class="h6">BUYER</p>
                </div>

                <div class="input-box mb-3">

                    <label for="">Username</label>
                    <input type="text" name="username" required>
                    <small class="text-muted">*Enter valid Username</small>
                </div>
                <div class="input-box mb-2">

                    <label for="">Password</label>
                    <input type="password" name="password" required>
                    <small class="text-muted">*Enter your password</small>
                </div>
            </div>
            <a href="javascipt:void(0)" class="forgot-link">Forgot Password ?</a>
            <div class="user-submit">
                <div class="form-group">
                    <button class="submit-btn" name="login_submit">LOG IN</button>
                </div>
            </div>
        </form>
        <form action="" id="register_form" data-ajax="false" class="w-100 collapse" method="post">

            <div class="user-input">
                <div class="brand-logo d-flex flex-row text-center align-items-center justify-content-center">
                    <img class="my-3 mr-2 d-block" src="../logo.png" height="70px" alt="">
                    <div>
                        <p class="h4">OpenMarket</p>
                        <p class="h6">BUYER</p>
                    </div>
                </div>
                <div class="divider mb-3"></div>
                <p class="h6  text-center text-uppercase mb-3">Buyer Registeration</p>

                <div class="input-box mb-3">
                    <label for="">First Name</label>
                    <input type="text" name="fname" required>
                    <small class="text-muted">*Enter your name</small>
                </div>
                <div class="input-box mb-3">
                    <label for="">Last Name</label>
                    <input type="text" name="lname" required>
                    <small class="text-muted">*Enter your surname</small>
                </div>
                <div class="input-box mb-3">
                    <label for="">Username</label>
                    <small class="text-danger font-weight-bold invalid" style="display:none"> This username is already taken</small>
                    <input type="text" name="username" required>
                    <small class="text-muted">*Username must be unique</small>
                </div>
                <div class="input-box mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" required>
                    <small class="text-muted">*Enter your password</small>
                </div>
                <div class="input-box mb-3">
                    <label for="">Confirm Password</label>
                    <small class="text-danger font-weight-bold invalid" style="display:none"> Password Should Match</small>
                    <input type="password" name="confirm_password" required>
                    <small class="text-muted">*Confirm your password</small>
                </div>
            </div>
            <div class="user-submit mt-3">
                <div class="form-group">
                    <button class="submit-btn" name="register_submit" disabled>SIGN UP</button>
                </div>
            </div>
        </form>
        <div class="user-submit w-100 ">
            <div class="form-group">
                <button type="button" class="toggle-btn" data-toggle="collapse" data-target=".collapse">SIGN UP</button>
            </div>
        </div>
        <small class="terms">Our <a href="javascipt:void(0)">Terms of Use</a> and <a href="javascipt:void(0)">policy</a></small>
    </div>
</body>

<script>
    $('.collapse').on('show.bs.collapse', function() {
        console.log($(this).attr('id'));
        $('.alert').alert("close");
        if ($(this).attr('id') == "login_form") {
            $('[data-target=".collapse"]').text('SIGN UP');
        }
        if ($(this).attr('id') == "register_form") {
            $('[data-target=".collapse"]').text('LOG IN');
        }
        // alert(1);
    })

    $valid = false;
    $('#register_form [name="username"]').on('focusout', function() {
        $input = $(this).closest('.input-box');

        $.ajax({
            type: "POST",
            url: "request/login_auth.php",
            data: {
                "username": $(this).val(),
                "operation": "check_username"
            },
            success: function(data) {
                if (Number(data) > 0) {
                    $input.find('.invalid').fadeIn();
                    $valid = false;
                } else {
                    $input.find('.invalid').fadeOut();
                    $valid = true;
                }
            }
        })
    })
    $('#register_form [name="confirm_password"]').on('focusout', function() {
        $input = $(this).closest('.input-box');

        if ($(this).val() != $('#register_form [name="password"]').val()) {
            $input.find('.invalid').fadeIn();
            $valid = false;
        } else {
            $input.find('.invalid').fadeOut();
            $valid = true;
        }
    })
    $('input').bind('input propertychange', function() {
        if ($valid) $('[name="register_submit"]').removeAttr('disabled');
        else $('[name="register_submit"]').attr('disabled', 'true');

    })
</script>


</html>