<?php

if (isset($_POST['address_submit'])) {

    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $area = $_POST['area'];
    $region = $_POST['region'];

    $conn->query("UPDATE `sellers` SET `state` = '$state', `district` = '$district', `area` = '$area',`region` = '$region', `pincode`='$pincode' WHERE `id` = '$id'");
    echo "<script>location.reload()</script>";
}
?>
<style>
    [name="pincode"] {
        font-size: 30px;
        letter-spacing: 15px;
        padding-left: 30px;
        text-align: center;
    }
</style>

<div class="container">
    <p class="display-4 text-center mt-3">Location</p>
    <div class="card my-3">
        <div class="card-body">
            <p class="h5 text-primary"><i class="fa fa-street-view"></i> Your Shop Address is :</p>
            <p class="mb-0 small">State : <b><?php echo $row['state'] ?></b></p>
            <p class="mb-0 small">District : <b><?php echo $row['district'] ?></b></p>
            <p class="mb-0 small">Area : <b><?php echo $row['area'] ?> - <?php echo $row['region'] ?></b></p>
            <p class="mb-0 small">Pincode : <b><?php echo $row['pincode'] ?></b></p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="input" class="form-control" maxlength="6" name="pincode" placeholder="000000" required>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input type="input" class="form-control" name="state" placeholder="State" readonly required>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <input type="input" class="form-control" name="district" placeholder="District" readonly required>
                </div>
                <div class="form-group">
                    <label>Area</label>
                    <select class="form-control" name="area" required>
                        <option value="">--- Select Area ---</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Region</label>
                    <select class="form-control" name="region" required>
                        <option value="">--- Select Region ---</option>
                        <option value="E">East (E)</option>
                        <option value="W">West (W)</option>
                        <option value="none">None</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" style="resize:unset" rows="4" maxlength="100"></textarea>
                </div> -->
                <div class="form-group">
                    <button class="btn btn-success" name="address_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    $('[name="pincode"]').on("input propertychange", function() {
        var searchField = $(this).val();

        if (searchField.length == 6) {
            $.ajax({
                dataType: "json",
                url: 'address_map.json',
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