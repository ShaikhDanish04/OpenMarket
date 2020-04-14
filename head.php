<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<meta name="theme-color" content="#1c0d70" />
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


<?php include('connect.php') ?>
<style>
    html {
        overflow-x: hidden;
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
        display: flex;
        background: #ee1565;
        padding: 8px;
        align-items: center;
        justify-content: space-between;
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
</style>