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
    .top-stick {
        position: relative;
        border-top: 10px solid #d6135f;
        box-shadow: 0px 2px 18px rgba(0, 0, 0, .5);
        width: 100%;
    }

    .auth {
        background: #e9e9e9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .auth form {
        max-width: 330px;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .login-btn {
        background: linear-gradient(45deg, #751056, #251075);
        color: #fff;
        border: 2px solid transparent;
    }

    .register-btn {
        background: #fff;
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

    .remember-me {
        height: 20px;
        width: 20px;
    }

    .user-input {
        background: #fff;
        padding: 1rem;
        border-radius: 10px;
        margin-top: 1rem;
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
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        border: 0;
        border-bottom: 1px solid #a7a7a7;
        outline: 0;
    }

    .input-box input:focus {
        border-bottom: 1px solid #301071;
    }



    .forgot-link {
        font-weight: 600;
        color: #b31267;
        font-size: 14px;
        /* width: 100%; */
        text-align: right;
        display: block;
        margin: 5px 10px 1.5rem;
        outline: none;
    }

    .terms a {
        color: #6e1059;
        text-decoration: underline;
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
        $status = '<div class="alert alert-danger my-3">Invalid Details !!! Try Again</div>';
    }
}
?>


<body>
    <div class="top-stick"></div>
    <div class="auth">
        <div class="brand-logo text-center mt-3 mb-3">
            <img class="mx-auto my-3 d-block" src="../logo.png" height="120px" alt="">
            <p class="h4">OpenMarket</p>
            <p class="h6">BUYER</p>
        </div>

        <form action="" id="login_form" method="post" data-ajax="false" class="w-100 container">
            <div class="user-input">
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
                    <button class="login-btn" name="login_submit">LOG IN</button>
                </div>
                <div class="form-group">
                    <button class="register-btn">SIGN UP</button>
                </div>
            </div>
        </form>
        <small class="terms">Our <a href="javascipt:void(0)">Terms of Use</a> and <a href="javascipt:void(0)">policy</a></small>
    </div>
</body>


</html>