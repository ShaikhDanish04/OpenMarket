<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Buyer</title>
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

    $id = $_POST['id'];
    $password = sha1($_POST['password']);

    $result = $conn->query("SELECT * FROM buyers WHERE (id='$id' AND `password`='$password') OR (username='$id' AND `password`='$password')");
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
    <style>
        .login-card {
            margin: 20px auto;
            max-width: 350px;
            box-shadow: 2px 2px 8px #ccc;
        }
    </style>

    <form action="" method="post">
        <div class="login-card">
            <?php echo $status; ?>
        </div>

        <div class="card login-card">
            <div class="card-body">
                <p class="display-4 text-center">Login</p>
                <p class="text-center mb-4 h3">BUYER</p>

                <div class="form-group">
                    <label for="">ID</label>
                    <input type="text" name="id" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <a href="javascript:void(0)" class="small font-weight-bold">Forgot Password ?</a>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success w-100" name="login_submit">Login</button>
                </div>
            </div>
            <div class="card-footer">
                <p class="small mb-0 text-center">Dont have account ? <a href="register.php" class="font-weight-bold text-underline">Register</a></p>

            </div>
        </div>
    </form>

</body>

</html>