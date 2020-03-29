<div class="container py-3">
    <input type="text" name="in_shop_id">
    <div class="form-group d-flex align-items-center justify-content-between">
        <a href="#buyer_process" data-slide="prev" class="btn"><i class="fa fa-chevron-left text-dark"></i></a>
        <p class="h6 mb-0">Products</p>
        <a class="btn" data-toggle="collapse" data-target="#filter_product"><i class="fa fa-search text-dark"></i></a>
    </div>
    <div id="filter_product" class="container collapse">
        <input type="text" name="search_shop" class="form-control mb-3" placeholder="Search">
    </div>

    <div class="product_list_container"></div>

</div>

<style>
    .product-card {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 1rem;
    }

    .product-card .card-side-img {
        height: auto;
        flex-shrink: 0;
    }

    .product-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
        font-size: 13px;
    }

    .product-card .card-text {
        font-size: 14px;
    }
</style>