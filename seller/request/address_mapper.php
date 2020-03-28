<?php include('../../connect.php');

if ($_POST['column'] == "state") {

    $result = $conn->query("SELECT * FROM address_mapper");
    $list = array();

    while ($row = $result->fetch_assoc()) {
        array_push($list, $row['state']);
    }
    echo json_encode(array_unique($list));
}

if ($_POST['column'] == "district") {

    $state = $_POST['state'];
    $result = $conn->query("SELECT * FROM address_mapper WHERE `state`='$state'");
    $list = array();

    while ($row = $result->fetch_assoc()) {
        array_push($list, $row['district']);
    }
    echo json_encode(array_unique($list));
}

if ($_POST['column'] == "sub-district") {

    $district = $_POST['district'];
    $result = $conn->query("SELECT * FROM address_mapper WHERE `district`='$district'");
    $list = array();

    while ($row = $result->fetch_assoc()) {
        array_push($list, $row['sub-district']);
    }
    echo json_encode(array_unique($list));
}

if ($_POST['column'] == "area") {

    $sub_district = $_POST['sub-district'];
    $result = $conn->query("SELECT * FROM address_mapper WHERE `sub-district`='$sub_district'");
    $list = array();

    while ($row = $result->fetch_assoc()) {
        array_push($list, $row['area']);
    }
    echo json_encode(array_unique($list));
}
