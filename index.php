<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Bazar</title>

    <?php include('head.php') ?>
</head>

<body>
    <div class="d-flex justify-content-center flex-column align-items-center">

        <p class="display-3 mt-3">Welcome to Daily Bazar</p>
        <div class="row">
            <div class="col-md-6">
                <?php include('buyer/view/login.php')?>
            </div>
            <div class="col-md-6">
                <?php include('seller/view/login.php')?>
            </div>
        </div>
    </div>
</body>

</html>