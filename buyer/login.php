<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Buyer</title>
    <?php include('../head.php') ?>
</head>

<body>
    <style>
        .login-card {
            margin: 20px auto;
            max-width: 350px;
            box-shadow: 2px 2px 8px #ccc;
        }
    </style>

    <form action="index.php" method="post">
        <div class="card login-card">
            <div class="card-body">
                <p class="display-4 text-center">Login</p>
                <p class="text-center mb-4 h3">BUYER</p>

                <div class="form-group">
                    <label for="">ID</label>
                    <input type="text" name="id" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                    <a href="javascript:void(0)" class="small font-weight-bold">Forgot Password ?</a>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success w-100">Login</button>
                    <a href="register.php" class="small font-weight-bold">Create New Account</a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>