<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <p class="display-4 text-center">Register</p>

            <div id="seller_register" class="carousel slide" data-ride="carousel" data-interval="false" data-wrap="true" data-slide="false">
                <div class="carousel-inner">
                    <div class="carousel-item p-1 active">
                        <p class="text-center mb-4 h3">SELLER</p>

                        <div class="form-group">
                            <label for="">Shop Name / Owner Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Select Shop Category</label>
                            <select name="category" class="form-control">
                                <option value="">--- Select ---</option>
                                <option value="">Dairy</option>
                                <option value="">Medical</option>
                                <option value="">Vegitable</option>
                                <option value="">Kirana</option>
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" href="#seller_register" data-slide="next">Next <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="carousel-item p-1">
                        <p class="h3 text-center mb-4">Verification</p>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" name="number" class="form-control">
                            <button class="btn btn-sm btn-success d-block ml-auto mt-1">Send OTP</button>
                        </div>

                        <div class="form-group">
                            <label for="">OTP</label>
                            <input type="text" name="otp" class="form-control">
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button class="btn btn-dark" href="#seller_register" data-slide="prev"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i> Prev</button>
                            <button class="btn btn-primary" href="#seller_register" data-slide="next">Next <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
                        </div>

                    </div>
                    <div class="carousel-item p-1">
                        <p class="h3 text-center mb-3">Thank You</p>
                        <p class="h6 text-center text-success">Your Account is Verified !!!</p>
                        <p class="text-center">Submit Password to Register

                        <div class="form-group">
                            <label for="">Enter Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button class="btn btn-success w-100">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>