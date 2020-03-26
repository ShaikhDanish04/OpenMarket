<form action="" class="container" method="post">
    <div class="card mt-3">
        <div class="card-header">
            <p class="h5">Add New Product</p>
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
                <label for="">Enter Price Per Item or Kg</label>
                <input type="text" name="quantity" class="form-control">
                <small class="text-muted">*Required</small>
            </div>
            <div class="form-group">
                <label for="">Enter Quantity</label>
                <input type="text" name="quantity" class="form-control">
                <small class="text-muted">*Required</small>
            </div>
            <div class="form-group">
                <button class="btn btn-success w-100">Submit</button>
            </div>
        </div>
    </div>
</form>