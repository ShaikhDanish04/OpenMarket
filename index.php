<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Bazar</title>

    <?php include('head.php'); ?>

</head>

<body>
    <style>
        .login-card {
            margin: 20px auto;
            max-width: 350px;
            box-shadow: 2px 2px 8px #ccc;
        }

        .logo {
            text-align: center;
            background: #d41c93;
            color: #ffffff;
            height: 80px;
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 5px solid #a9a9a9;
            box-shadow: 0 0 15px #ccc;
            font-size: 2rem;
            text-shadow: 0 0 5px #000;
            margin-right: 1rem;
        }
    </style>
    <div class="d-flex justify-content-center flex-column align-items-center">

        <p class="display-4 mt-3 mb-0">Welcome</p>
        <p class="mb-0">to</p>
        <p class="h4 m-0">Open Market</p>


    </div>
    <div class="p-3">
        <div class="card login-card">
            <div class="card-body">
                <div class="d-flex mt-3 align-items-center justify-content-center">

                    <div class="logo">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <div>
                        <p class="mb-0 h3">OPEN</p>
                        <p class="mb-0 h2">Market</p>
                    </div>
                </div>

                <ul class="p-3 text-justify m-0">
                    <li class="ml-2">
                        <p class="my-3">This is an open service for buyer and seller to interact.</p>
                    </li>
                    <li class="ml-2">
                        <p class="my-3">Here seller can upload their any product online.</p>
                    </li>
                    <li class="ml-2">
                        <p class="my-3">The buyers get an open interface to see the products in shops and can book the products using smart token system.</p>
                    </li>
                </ul>

                <a class="btn btn-primary w-100 mb-3" href="buyer/">Login for Buyer</a>
                <a class="btn btn-success w-100 mb-3" href="seller/">Login for Seller</a>
            </div>
        </div>
    </div>
</body>

</html>