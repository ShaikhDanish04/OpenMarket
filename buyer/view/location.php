<?php
// if (isset($_POST['address_submit'])) {

//     $state = $_POST['state'];
//     $district = $_POST['district'];
//     $sub_district = $_POST['sub-district'];
//     $area = $_POST['area'];
//     $address_submit = $_POST['address_submit'];

//     $conn->query("UPDATE `sellers` SET `state` = '$state', `district` = '$district', `sub-district` = '$sub_district', `area` = '$area' WHERE `id` = '$id'");
//     echo "<script>location.reload()</script>";
// }
?>



<div class="container">
    <p class="display-4 text-center mt-3">Location</p>

    <div class="card mt-3">
        <div class="card-header">
            <p class="h3 mb-0"><i class="fa fa-edit"></i> Edit Location</p>
        </div>
        <div class="card-body">
            <form action="" method="post">

                <div class="form-group">
                    <label for="">Select State</label>
                    <select class="form-control" name="state" required>
                        <option value="">--- Select ---</option>
                    </select>
                    <small class="text-muted">*Required</small>
                </div>

                <div class="form-group">
                    <label for="">Select District</label>
                    <select class="form-control" name="district" required>
                        <option value="">--- Select ---</option>
                    </select>
                    <small class="text-muted">*Required</small>
                </div>

                <div class="form-group">
                    <label for="">Select Sub-District</label>
                    <select class="form-control" name="sub-district" required>
                        <option value="">--- Select ---</option>
                    </select>
                    <small class="text-muted">*Required</small>
                </div>

                <div class="form-group">
                    <label for="">Select Area</label>
                    <select class="form-control" name="area" required>
                        <option value="">--- Select ---</option>
                    </select>
                    <small class="text-muted">*Required</small>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <button type="button" onclick='location.reload()' tabindex="-1" class="btn btn-danger">Reset</button>
                    <button type="submit" name="address_submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "request/address_mapper.php",
                data: {
                    "column": "state"
                },
                success: function(data) {
                    var dataObj = JSON.parse(data);
                    $.each(dataObj, function(index, data) {
                        $('[name="state"]').append('<option value="' + data + '">' + data + '</option>');
                    });
                }
            });

            $('[name="state"]').change(function() {
                $(this).focusout(function() {
                    $(this).attr('readonly', 'true');
                })
                $.ajax({
                    type: "POST",
                    url: "request/address_mapper.php",
                    data: {
                        "state": $('[name="state"]').val(),
                        "column": "district"
                    },
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        // console.log(dataObj);
                        $.each(dataObj, function(index, data) {
                            $('[name="district"]').append('<option class="dynamic" value="' + data + '">' + data + '</option>');
                        });
                    }
                });
            });

            $('[name="district"]').change(function() {
                $(this).focusout(function() {
                    $(this).attr('readonly', 'true');
                })
                $.ajax({
                    type: "POST",
                    url: "request/address_mapper.php",
                    data: {
                        "district": $('[name="district"]').val(),
                        "column": "sub-district"
                    },
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        // console.log(dataObj);
                        $.each(dataObj, function(index, data) {
                            $('[name="sub-district"]').append('<option class="dynamic" value="' + data + '">' + data + '</option>');
                        });
                    }
                });
            });

            $('[name="sub-district"]').change(function() {
                $(this).focusout(function() {
                    $(this).attr('readonly', 'true');
                })
                $.ajax({
                    type: "POST",
                    url: "request/address_mapper.php",
                    data: {
                        "sub-district": $('[name="sub-district"]').val(),
                        "column": "area"
                    },
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        // console.log(dataObj);
                        $.each(dataObj, function(index, data) {
                            $('[name="area"]').append('<option class="dynamic" value="' + data + '">' + data + '</option>');
                        });
                    }
                });
            })

        })
    </script>
</div>