<style>
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
</style>

<!--Make sure the form has the autocomplete function switched off:-->
<form id="search_all_products" autocomplete="off" action="" class="mb-3">
    <div class="autocomplete d-flex">
        <input id="search_input" class="form-control  mr-2" type="text" name="search" placeholder="Search for products" required>
        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
        <button type="button" class="btn btn-danger" style="display: none"><i class="fa fa-times"></i></button>
    </div>
</form>

<style>
    .searched-product-card .address {
        background: #f3f3f3;
        border-radius: .5rem;
        transition: .5s;
        /* margin-bottom: .5rem; */
        padding: .5rem 1rem;
        text-align: justify;
        box-shadow: 0px 4px 8px #ddd;
    }

    .searched-product-card .rating {
        color: #f8c100;
        margin-right: .5rem;
    }

    .searched-product-card .product {
        display: flex;
        min-height: 150px;
        flex-direction: row;
        margin-bottom: 0px;
    }

    .searched-product-card p {
        margin-bottom: 0px;
    }

    .divider {
        border-bottom: 1px solid rgba(0, 0, 0, .25);
    }
</style>
<div class="all-product-card-list"></div>

<script>
    $('#search_all_products').submit(function(e) {
        $('#search_all_products .btn-success').hide();
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "request/get_from_all_products.php",
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
                $('.all-product-card-list').html(data);
                $('.shop-card-list').html('');
                $('#search_all_products .btn-danger').show();
            }
        });
    });
    $('#search_all_products .btn-danger').click(function() {
        $('.shop-card-list').load('request/shop_list.php');

        $(this).hide();
        $('.all-product-card-list').html('');
        $('#search_all_products input').val('');
        $('#search_all_products .btn-success').show();
    });
    $('#search_all_products input').on('focus keyup', function() {
        $('#search_all_products .btn-success').show();
        $('#search_all_products .btn-danger').hide();

    });


    <?php $result = $conn->query("SELECT * FROM product_list");
    $product_list = array();

    while ($row = $result->fetch_assoc()) {
        array_push($product_list, $row['product_name']);
    }
    ?>
    $(document).ready(function() {
        autocomplete($("#search_input")[0], <?php echo json_encode($product_list); ?>);
    })
</script>

<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
            // console.log();
            if ($(a).text() == '') {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "No result found";
                /*insert a input field that will hold the current array item's value:*/
                /*execute a function when someone clicks on the item value (DIV element):*/
                a.appendChild(b);
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }
</script>