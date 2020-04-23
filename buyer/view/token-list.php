<?php include('../../connect.php') ?>

<div class="container py-3">
    <p class="font-weight-light text-center h3 mb-3"><i class="fa fa-list-alt small"></i> Pending Tokens</p>

    <div class="token-card-list"></div>
    <!-- list my tokens -->
</div>
<style>
    .token-card .card-side-img {
        width: 70px;
        height: 70px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        flex-shrink: 0;
    }
</style>


<script>
    $(document).ready(function() {
        $('.token-card-list').load('request/token_list.php')
    })

    $('.delete_token').click(function() {
        var $card = $(this).closest('.card');

        $('#card_delete_modal').attr('data-token-number', $card.attr('data-token-number'));
        $('#card_delete_modal').attr('data-shop-id', $card.attr('data-shop-id'));

        $('#card_delete_modal').modal('show');
    });


</script>