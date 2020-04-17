<?php
include('../../connect.php');

if (isset($_POST['address_submit'])) {

    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $area = $_POST['area'];
    $region = $_POST['region'];
    $address = $_POST['address'];

    $conn->query("UPDATE `buyers` SET `address` = '$address',`state` = '$state', `district` = '$district', `area` = '$area',`region` = '$region', `pincode`='$pincode' WHERE `id` = '$id'");
    echo "<script>location.reload()</script>";
}
$result = $conn->query("SELECT * FROM buyers WHERE id = '$id'");
$row = $result->fetch_assoc();

?>
<style>
    [name="pincode"] {
        font-size: 30px;
        letter-spacing: 15px;
        padding-left: 30px;
        text-align: center;
    }
</style>

<div class="container py-3">
    <p class="display-4 text-center">Location</p>
    <div class="card my-3 <?php echo ($row['pincode'] == '0') ? 'd-none' : ''; ?> ">
        <div class="card-body small">
            <p class=""><b>Address : </b> <?php echo $row['address'] ?></p>
            <div class="divider mb-3"></div>
            <p class="h5 text-center"><i class="fa fa-map-marker text-danger"></i> Your Location Pointer </p>
            <p class="mb-0 text-center">
                <?php echo  $row['area'] . ' - ' . $row['region'] . ', ' . $row['district'] . ', ' . $row['state'] . ' - ' . $row['pincode'] ?>
            </p>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <p class="h5 text-center mb-3 text-info"><i class="fa fa-street-view"></i> Update Location</p>
                <div class="divider mb-2"></div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" rows="4" style="resize:unset" maxlength="200" class="form-control text-justify"><?php echo $row['address'] ?></textarea>
                </div>

                <p class="h6 text-center mb-3"><i class="fa fa-map-marker text-danger"></i> Set Location Pointer</p>
                <div class="form-group">
                    <label>Pincode</label>
                    <input type="number" class="form-control" maxlength="6" value="<?php echo ($row['pincode'] == '0') ? '' : $row['pincode'] ?>" name="pincode" placeholder="000000" required>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input type="input" class="form-control" name="state" value="<?php echo $row['state'] ?>" placeholder="State" readonly required>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <input type="input" class="form-control" name="district" value="<?php echo $row['district'] ?>" placeholder="District" readonly required>
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control" name="area" required>
                        <?php echo (isset($row['area'])) ?
                            ' <option value="' . $row['area'] . '">' . $row['area'] . '</option>' :
                            ' <option value="">--- Select Area ---</option>'
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Region</label>
                    <select class="form-control" name="region" required>
                        <option value="">--- Select Area ---</option>;
                        <option value="E">East (E)</option>
                        <option value="W">West (W)</option>
                        <option value="U">None</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" name="address_submit">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    $('[name="pincode"]').on("input propertychange", function() {
        var searchField = $(this).val();

        if (searchField.length == 6) {
            $('.overlay').fadeIn();
            $.ajax({
                dataType: "json",
                url: '../address_map.json',
                success: function(data) {
                    $.each(data, function(key, val) {
                        if (val.pincode == searchField) {
                            console.log("State : " + val.stateName);
                            console.log("District : " + val.district);
                            console.log("Area : " + val.officeName);
                            console.log("");
                            $('[name="state"]').val(val.stateName);
                            $('[name="district"]').val(val.district);
                            $('[name="area"]').append('<option class="dynamic" value="' + val.officeName + '">' + val.officeName + '</option>');
                        }
                    });
                    $('.overlay').fadeOut();
                    $('[name="area"]').focus();
                }
            });
        } else {
            $('[name="state"]').val('');
            $('[name="district"]').val('');
            $('[name="area"]').html('<option value="">--- Select Distict ---</option>');
        }
    });
</script>