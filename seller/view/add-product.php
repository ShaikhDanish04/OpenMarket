<style>
    [name="price"] {
        font-size: 30px;
        letter-spacing: 5px;
    }
</style>

<div class="container pt-3">

    <!-- Nav pills -->
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#packed_product">Packed Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#loose_product">Loose Product</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active" id="packed_product">
            <form action="" class="container" method="post">
                <div class="card mt-3">
                    <div class="card-header">
                        <p class="h5">Packed Product</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Select Product Name</label>
                            <select name="name" class="form-control">
                                <option value="">--- Select ---</option>
                                <option value="">abc</option>
                                <option value="">def</option>
                                <option value="">xyz</option>
                            </select>
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Enter Quantity in Number</label>
                            <div class="d-flex">
                                <button type="button" class="btn btn-danger minus-val btn-lg" tabindex="-1"><i class="fa fa-minus"></i></button>
                                <input type="number" value="0" min="0" name="quantity" class="form-control mx-2 btn-lg text-center">
                                <button type="button" class="btn btn-success plus-val btn-lg" tabindex="-1"><i class="fa fa-plus"></i></button>
                            </div>
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Enter Price Per Item</label>
                            <input type="text" name="price" class="form-control">
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane container fade" id="loose_product">
            <form action="" class="container" method="post">
                <div class="card mt-3">
                    <div class="card-header">
                        <p class="h5">Loose Product</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Select Product Name</label>
                            <select name="name" class="form-control">
                                <option value="">--- Select ---</option>
                                <option value="">abc</option>
                                <option value="">def</option>
                                <option value="">xyz</option>
                            </select>
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Enter Quantity in Kilogram</label>
                            <div class="d-flex">
                                <button type="button" class="btn btn-danger minus-val btn-lg" tabindex="-1"><i class="fa fa-minus"></i></button>
                                <input type="number" value="0" min="0" name="kilogram" class="form-control mx-2 btn-lg text-center">
                                <button type="button" class="btn btn-success plus-val btn-lg" tabindex="-1"><i class="fa fa-plus"></i></button>
                            </div>
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Enter Quantity in Gram</label>
                            <div class="d-flex">
                                <button type="button" class="btn btn-danger minus-val btn-lg" tabindex="-1"><i class="fa fa-minus"></i></button>
                                <input type="number" value="0" min="0" name="gram" class="form-control mx-2 btn-lg text-center">
                                <button type="button" class="btn btn-success plus-val btn-lg" tabindex="-1"><i class="fa fa-plus"></i></button>
                            </div>
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Enter Price Kilogram</label>
                            <input type="text" name="price" class="form-control">
                            <small class="text-muted">*Required</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('.minus-val').click(function() {
        $(this).next().val(Number($(this).next().val()) - Number(1));
    })
    $('.plus-val').click(function() {
        $(this).prev().val(Number($(this).prev().val()) + Number(1));
    })
</script>