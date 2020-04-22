<?php include('../../connect.php');

if ($_POST['operation'] == 'update_address') {

    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $area = $_POST['area'];
    $region = $_POST['region'];
    $address = $_POST['address'];

    $conn->query("UPDATE `buyers` SET `address` = '$address',`state` = '$state', `district` = '$district', `area` = '$area',`region` = '$region', `pincode`='$pincode' WHERE `id` = '$id'");
}
