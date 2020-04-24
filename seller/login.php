<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Seller</title>
    <?php include('../head.php') ?>
    <?php
    if (isset($_SESSION['id']) && $_SESSION['type'] == "buyer") {
        echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
    }
    ?>
</head>
<?php

$status = "";
if (isset($_POST['login_submit'])) {

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $result = $conn->query("SELECT (id) FROM sellers WHERE username = '$username' AND `password` = '$password'");
    $row = $result->fetch_assoc();

    if ($result->num_rows == 1) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['type'] = "seller";
        echo "<script type='text/javascript'>document.location.href = 'index.php';</script>";
    } else {
        $status = '<div class="alert alert-danger my-3">Invalid Details !!! Try Again</div>';
    }
}
?>

<body>
    <style>
        .login-card {
            margin: 20px auto;
            max-width: 350px;
            box-shadow: 2px 2px 8px #ccc;
        }
    </style>

    <form action="" data-ajax="false" method="post" class="p-3">
        <div class="login-card">
            <?php echo $status; ?>
        </div>

        <div class="card login-card">
            <div class="card-body">

                <p class="display-4 text-center">Login</p>
                <p class="text-center mb-4 h3">SELLER</p>

                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                    <a href="javascript:void(0)" class="small font-weight-bold">Forgot Password ?</a>
                </div>

                <div class="form-group text-center">
                    <button type="submit" name="login_submit" data-ajax="false" class="btn btn-success w-100">Login</button>
                </div>

            </div>
            <div class="card-footer">
                <p class="small mb-0 text-center">Dont have account ? <a href="register.php" data-ajax="false" class="font-weight-bold text-underline">Register</a></p>

            </div>
        </div>
        <div class="d-flex align-items-baseline justify-content-center">
            Translate : <div id="google_translate_element"></div>
        </div>

    </form>
</body>

</html>