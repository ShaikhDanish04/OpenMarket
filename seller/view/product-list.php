<style>
    .product {
        padding: .25rem !important;
    }

    .product .card-img-top {
        height: 130px;
        background: #ccc;
        margin-bottom: 0px;
    }

    .product .card {
        height: 100%;
        font-size: 12px;
        max-width: 220px;
        margin: auto;
    }

    .product .card-body {
        padding-top: .5rem;
    }

    .product .card-title {
        font-weight: 500;
        font-variant-caps: titling-caps;
        font-size: 15px;
        padding-bottom: .25rem;
        margin-bottom: .25rem;
        border-bottom: 1px solid #ccc;
    }
</style>
<div class="container py-3">
    <p class="display-4 text-center">Products</p>
    <!-- Nav pills -->
    <ul class="nav nav-pills nav-justified mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#packed_product">Packed Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#loose_product">Loose Product</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="packed_product">
            <p class="small">Packed Products are the products with have quantity and are having fixed rate as each</p>
            <div class="row no-gutters">
                <div class="col-6 product">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title">Amul Cheese</p>
                            <p class="card-text mb-0">Quantity : <b>80</b></p>
                            <p class="card-text">Price : <b>6 Rs</b></p>
                            <button class="btn btn-warning btn-sm w-100"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 product">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title">Amul Cheese</p>
                            <p class="card-text mb-0">Quantity : <b>80</b></p>
                            <p class="card-text">Price : <b>6 Rs</b></p>
                            <button class="btn btn-warning btn-sm w-100"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 product">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title">Amul Cheese</p>
                            <p class="card-text mb-0">Quantity : <b>80</b></p>
                            <p class="card-text">Price : <b>6 Rs</b></p>
                            <button class="btn btn-warning btn-sm w-100"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 product">
                    <div class="card">
                        <img class="card-img-top" src="holder.js/100x180/" alt="">
                        <div class="card-body">
                            <p class="card-title">Amul Cheese</p>
                            <p class="card-text mb-0">Quantity : <b>80</b></p>
                            <p class="card-text">Price : <b>6 Rs</b></p>
                            <button class="btn btn-warning btn-sm w-100"><i class="fa fa-edit"></i> Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="loose_product">
        </div>
    </div>


</div>