<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daily Bazar : Seller</title>
    <?php include('../head.php') ?>
</head>

<body class="">
    <?php
    if (isset($_GET['page'])) {
        if ($_GET['page'] != '') {
            include("view/" . $_GET['page'] . ".php");
        } else {
            include("view/login.php");
        }
    } else {
        include("view/login.php");
    }
    ?>



</body>

</html>