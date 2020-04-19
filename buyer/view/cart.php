<div class="container py-3">
    <p class="display-4 text-center"><i class="fa fa-shopping-cart"></i> Cart List</p>

    <div class="cart-card-list"></div>

</div>
<script>
    $(document).ready(function() {
        $('.cart-card-list').load('request/cart_list.php');
    })
</script>