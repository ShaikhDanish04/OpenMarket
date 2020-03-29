<div class="container py-3">
    <div class="form-group d-flex">
        <input type="text" name="search_shop" class="form-control" placeholder="Search">
        <button class="btn btn-secondary ml-2" data-toggle="collapse" data-target="#filter_container"><i class="fa fa-filter"></i></button>
    </div>
    <script>
        $('[name="search_shop"]').on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".shop-list .shop-card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
    <div id="filter_container" class="container collapse">
        <div class="card mb-3">
            <div class="card-body">

            </div>
        </div>
    </div>
    <style>
        .shop-card {
            display: flex;
            height: 150px;
            flex-direction: row;
        }

        .card-side-img {
            height: 100%;
            width: 135px;
            background: #999997;
            background: url(img/shop_dummy.jpg);
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
        }

        .shop-card .card-body {
            padding: 0.75rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .shop-card .card-title {
            border-bottom: 1px solid #ccc;
            padding-bottom: .25rem;
            font-weight: 500;
            margin-bottom: .25rem;
        }
    </style>

    <div class="shop-list"></div>
    <script>
        $(document).ready(function() {
            $('.shop-list').load('request/shop_list.php');
        })
    </script>



</div>