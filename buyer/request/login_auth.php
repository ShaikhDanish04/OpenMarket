<?php include('../../connect.php');

if ($_POST['operation'] == "check_username") {

    $username = $_POST['username'];
    echo $conn->query("SELECT username FROM buyers WHERE username='$username'")->num_rows;
}
