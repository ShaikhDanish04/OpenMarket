<?php include('../../connect.php') ?>

<div class="container py-3">
    <p class="font-weight-light text-center h3 mb-3"><i class="fa fa-list-alt small"></i> Pending Tokens</p>

    <div class="token-card-list"></div>
    <!-- list my tokens -->


    <!-- The Modal -->
    <div class="modal fade" id="card_delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">

                <div class="modal-body text-center">
                    <p class="h3 mb-4 mt-3">Delete Token</p>
                    <p class="">Are Your Sure ?</p>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" class="btn mx-2 btn-danger" data-dismiss="modal">No</button>
                        <button type="button" class="btn mx-2 btn-success delete_token_button">Yes</button>
                    </div>
                    <p class="small text-justify"><b>Note :</b> Your Token number will be set rejected and all your items will be sent back to your cart.</p>
                </div>

            </div>
        </div>
    </div>
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