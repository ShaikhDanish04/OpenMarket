<div class="container py-3">
    <p class="h1 font-weight-light text-center mb-3"><i class="fa fa-shopping-cart"></i> Your Cart</p>

    <div class="cart-card-list"></div>

</div>
<script>
    $(document).ready(function() {
        $('.cart-card-list').load('request/cart_list.php');
    })
</script>