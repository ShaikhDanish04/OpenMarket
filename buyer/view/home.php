<div id="buyer_process" class="carousel slide" data-ride="carousel" data-slide="false" data-interval="false" data-wrap="false">

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <?php include("home/shop_list.php") ?>
        </div>
        <div class="carousel-item product-carousel">
            <?php include("home/product_list.php") ?>
        </div>
    </div>
</div>
<div class="order-list" style="display: none">
    <div id="check_list" class="collapse">
        <div class="card mb-1">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="h4 m-0">Order list</p>
                    <a class="btn close" data-toggle="collapse" data-target="#check_list">&times;</a>
                </div>
                <div class="items-in-list"></div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> Order</button>
                    <button class="btn btn-success"><i class="fa fa-check"></i> Get Token</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-body p-2">
            <button class="btn btn-primary w-100" data-toggle="collapse" data-target="#check_list"><i class="fa fa-list-alt"></i> Order List</button>
        </div>
    </div>
</div>

<script>
    $("#buyer_process").on('slid.bs.carousel', function() {
        if ($('.product-carousel').hasClass('active')) {
            $.ajax({
                type: "POST",
                url: "request/manage_order_list.php",
                data: {
                    "operation": "get_order_list",
                    "shop_id": $('[name="in_shop_id"]').val()
                },
                success: function(data) {
                    $('.items-in-list').html(data);
                    if (data != '') {
                        $('.order-list').slideDown();
                    }
                }
            });

        } else {
            $('.order-list').slideUp();
        }
    });
    $('[data-target="#check_list"]').click(function() {
        $.ajax({
            type: "POST",
            url: "request/manage_order_list.php",
            data: {
                "operation": "get_order_list",
                "shop_id": $('[name="in_shop_id"]').val()
            },
            success: function(data) {
                // location.reload();
                // console.log(data);
                $('.items-in-list').html(data);
                if (data != '') {
                    $('.order-list').slideDown();
                }
            }
        })
    });
</script>
<style>
    .order-list {
        position: fixed;
        border-radius: 5px;
        bottom: 10px;
        left: 10px;
        right: 10px;
        box-shadow: 0 0 12px #9c9c9c;
    }

    .order-list .items-in-list {
        max-height: 70vh;
        overflow-y: scroll;
    }

    .product-carousel {
        margin-bottom: 50px;
    }
</style>


<!-- The Modal -->
<div class="modal" id="book_product">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">


                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Book Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="">Product Name : <b class="product_name_get"></b></p>
                    <input type="text" name="operation" value="add_order">
                    <input type="text" name="buyer_id">
                    <input type="text" name="shop_id">
                    <input type="text" name="product_name">
                    <input type="text" name="quantity_of_items" value="1">

                    <div class="mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<style>
    .carousel-item {
        min-height: 95vh;
    }
</style>

<script>

</script>