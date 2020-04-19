<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<meta name="theme-color" content="#301ca2" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href)
    };
</script>


<?php include('connect.php');
// setcookie('googtrans', '/en/hi');
?>
<style>
    html {
        overflow-x: hidden;
        user-select: none !important;

    }

    body {
        background: #ededed;
        overflow-x: hidden;
    }

    .divider {
        border-bottom: 1px solid rgba(0, 0, 0, .25);
    }

    .card {
        box-shadow: 2px 2px 8px #ccc;
    }

    .action-bar {
        right: 0;
        left: 0;
        top: 0;
        display: flex;
        background: #ee1565;
        padding: 8px;
        position: fixed;
        align-items: center;
        justify-content: space-between;
        z-index: 9;
        box-shadow: 0 0 5px #aaa;
    }

    .action-bar .start {
        display: flex;
        font-weight: 500;
        align-items: center;
    }

    .action-bar .middle {
        font-weight: 500;
    }

    .side-bar {
        position: fixed;
        width: 230px;
        background: #6b6868;
        height: 100%;
        left: -230px;
        transition: .5s;
        z-index: 1;
    }

    .content-view {
        width: 100%;
        overflow: hidden;
        margin: 0px;
        transition: .5s;
    }

    .menu-open .side-bar {
        left: 0px;
        box-shadow: 0 2px 6px #aaa;
    }

    .menu-open .content-view {
        left: 0px;
        margin-left: 230px;
    }

    .side-bar .display {
        background: #1c0d70;
        color: #fff;
        padding: 1rem;
        box-shadow: -2px 2px 5px #555;
    }

    .display .user-img {
        border: 2px solid #a2a2a2;
        border-radius: 50%;
        height: 50px;
        width: 50px;
        display: block;
        background: #fff;
        margin-bottom: 1rem;
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .display .user-name {
        margin-bottom: 0px;
        font-weight: 600
    }

    .menu-list .list-item {
        display: block;
        padding: .75rem 1rem;
        background: #c4c4c4;
        color: #000;
        margin: 10px 8px;
        border-radius: 10px;
    }

    .menu-list .list-item:nth-child(even) {
        background: #a8a8a8;
    }

    .menu-list .list-item:hover {
        background: #1e1e1e;
        color: #fff;
        text-decoration: none;
    }

    .alert-area .alert {
        box-shadow: 2px 2px 8px #ccc;
    }

    .cart-display.cart-btn {
        position: relative;
        cursor: pointer;
    }

    .cart-display.cart-btn .badge {
        position: absolute;
        top: -8px;
        right: -12px;
    }

    .loading {
        position: absolute;
        top: -5px;
        left: -5px;
        font-size: 65px;
        font-weight: 100;
        color: #ee1565;
        display: none;
    }

    .bottom-nav {
        display: inline-grid;
        background: #fff;
        padding: 8px 0px;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        grid-auto-flow: column;
        grid-auto-columns: 1fr;
        box-shadow: 0 0 5px #ccc;
        justify-items: center;
        z-index: 9;
    }

    .bottom-nav .list-item {
        text-decoration: none;
        color: #000;
        text-align: center;
    }


    .bottom-nav .list-item p {
        font-size: 11px;
        margin-bottom: 0px;
    }

    .bottom-nav a.list-item.active {
        color: #351fb1;
        text-shadow: 0 0 1px;
    }

    .home-nav {
        user-select: none;
        position: relative;
        top: -50%;
        background: #1c0d70;
        color: #fff;
        border-radius: 50%;
        height: 55px;
        width: 55px;
        margin-bottom: -50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 0 20px #aaa;

    }

    .update_product {
        display: flex;
    }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,hi,mr,ur,sd,gu,pa,ml,bn,ta,te,kn,ne,ru,es,ja,ar,la,fr,de,da,id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');

        function changeGoogleStyles() {
            if ($('.goog-te-menu-frame').contents().find('.goog-te-menu2').length) {
                $('.goog-te-menu-frame').contents().find('.goog-te-menu2').css({
                    'max-width': '100%',
                    'overflow-x': 'auto',
                    'box-sizing': 'border-box',
                    'height': 'auto'
                });
            } else {
                setTimeout(changeGoogleStyles, 50);
            }
        }
        changeGoogleStyles();
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
    body {
        top: 0px !important;
    }

    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }

    .goog-te-menu-frame {
        max-width: calc(100% - 1rem) !important;
        padding: .5rem;
        box-shadow: 0 0 0;
    }

    .goog-te-menu2 {
        max-width: calc(100%) !important;
        overflow-x: scroll !important;
        box-sizing: border-box !important;
        height: auto !important;
    }

    #google_translate_element {
        overflow: hidden;
        border-radius: 5px;
        min-width: 100px;
        min-height: 25px;
        display: inline-block;
        background: rgba(0, 0, 0, 0.45);
    }

    .goog-tooltip {
        display: none !important;
    }

    .goog-tooltip:hover {
        display: none !important;
    }

    .goog-text-highlight {
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }

    .carousel-item {
        min-height: 95vh;
    }

    .shop-card.card,
    .product-card.card {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 1rem;
    }


    .searched-product-card .card-side-img,
    .cart-card .card-side-img,
    .shop-card .card-side-img,
    .product-card .card-side-img {
        height: auto;
        width: 135px;
        background: #999997;
        background: url(img/shop_dummy.jpg);
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        flex-shrink: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        z-index: 1;
        border-radius: .25rem;
        transform: scale(1, 1.05);
    }

    .searched-product-card .card-side-img {
        transform: scale(1.05);
        overflow: hidden;
    }

    .searched-product-card .card-body,
    .shop-card .card-body,
    .product-card .card-body {
        padding: 0.75rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* overflow: hidden; */
        background: linear-gradient(43deg, #ffffff, #d4d4d4);
        border-radius: 0px 5px 5px 0px;
    }

    .product-card .card-body {
        border-radius: 0px 0px 5px 5px;
    }


    .searched-product-card .card-title,
    .shop-card .card-title,
    .product-card .card-title {
        border-bottom: 1px solid #ccc;
        padding-bottom: .25rem;
        font-weight: 500;
        margin-bottom: .25rem;
    }


    .searched-product-card .card-text,
    .shop-card .card-text,
    .product-card .card-text {
        font-size: 12px;
    }

    .card.product-card:not(.open) .card-body {
        max-height: 38px;
        padding-top: 10px;
        overflow: hidden;

        background: #ee1565;
        color: #fff;
        text-align: center;
    }

    .product-card.card {
        flex-direction: column;
        margin-left: 5px;
        margin-right: 5px;
        transform: scale(0.95);
    }

    .card.product-card .card-img-top {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, .5);
        overflow: hidden;
        border-radius: 5px;
        transform: scale(1.05);

    }

    .card.product-card.open .card-img-top {
        transform: scale(1.05, 1);
    }

    .cart-card .card-side-img,
    .product-card .card-side-img {
        width: auto;
        height: 135px;
    }

    .card.product-card .card-img-top:active {
        box-shadow: 0px 0px 0px rgba(0, 0, 0, .5);
        transform: scale(1);
    }

    .searched-product-card .incart,
    .card.product-card .incart {
        color: #000;
        position: absolute;
        padding: 5px;
        background: #ffc107;
        border-radius: 5px;
        font-size: 12px;
        right: 5px;
        top: 5px;
        box-shadow: 2px 1px 5px rgba(0, 0, 0, 0.25);
    }

    .card.product-card.open .incart {
        font-size: 16px;
        right: 5px;
        top: 10px;
    }

    .searched-product-card,
    .shop-card.card {
        transform: scale(0.95, 0.97);
        flex-direction: column;
    }

    .shop-card .shop-head {
        display: flex;
        flex-direction: row;
        min-height: inherit;
        transform: scale(1.05, 1.03);
        margin-bottom: 5px;
    }

    .searched-product-card .card-side-img:active,
    .shop-card .shop-head:active {
        transform: scale(1);
    }

    .rating i.fa {
        color: #f8c100;
    }

    .rating span.value {
        margin-right: .5rem;
        font-weight: 600;
        border-left: 1px solid rgba(0, 0, 0, .25);
        padding-left: .25rem;
    }

    .address {
        background: #f3f3f3;
        border-radius: .5rem;
        transition: .5s;
        /* margin-bottom: .5rem; */
        padding: .5rem 1rem;
        text-align: justify;
        box-shadow: 0px 4px 8px #ddd;
    }

    [name="pincode"] {
        font-size: 30px;
        letter-spacing: 15px;
        padding-left: 30px;
        text-align: center;
    }

    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        /* display: inline-block; */
    }


    .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
    }

    .searched-product-card .address {
        background: #f3f3f3;
        border-radius: .5rem;
        transition: .5s;
        /* margin-bottom: .5rem; */
        padding: .5rem 1rem;
        text-align: justify;
        box-shadow: 0px 4px 8px #ddd;
    }


    .searched-product-card .product {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 0px;
        /* overflow: hidden; */
        transform: scale(1.05, 1);
    }

    .searched-product-card p {
        margin-bottom: 0px;
    }

    .divider {
        border-bottom: 1px solid rgba(0, 0, 0, .25);
    }

    .cart-display {
        position: relative;
    }

    .cart-display .badge {
        position: absolute;
        top: -8px;
        right: -8px;

    }

    .cart-display {
        position: relative;
    }

    .cart-display .badge {
        position: absolute;
        top: -8px;
        right: -8px;
    }

    .btn-success {
        color: #fff;
        background: linear-gradient(45deg, #115320, #28a745);
        border-color: #28a745;
        text-shadow: 0 0 1px;
    }

    .btn-danger {
        color: #fff;
        background: linear-gradient(45deg, #7d2a32, #dc3545);
        border-color: #dc3545;
        text-shadow: 0 0 1px;
    }

    .btn-warning {
        color: #212529;
        background: linear-gradient(45deg, #c29c28, #ffc107);
        border-color: #ffc107;
        text-shadow: 0 0 1px;
    }

    .btn-primary {
        color: #fff;
        background: linear-gradient(45deg, #0b3766, #0069d9);
        border-color: #0062cc;
        text-shadow: 0 0 1px;
    }

    .card:not(.open) .card-side-img::after,
    .card-img-top::after {
        content: ' ';
        position: absolute;
        background: linear-gradient(135deg, rgba(242, 246, 248, 0) 0%, rgba(224, 239, 249, 0) 0%, rgba(216, 225, 231, 0.2) 50%, rgba(181, 198, 208, 0.21) 51%, rgba(181, 198, 208, 0) 100%);
        height: 100%;
        width: 100%;
        left: 0;

    }
</style>