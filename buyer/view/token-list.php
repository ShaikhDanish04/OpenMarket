<div class="container my-3">
    <p class="display-4 text-center">My Tokens</p>

    <div class="card">
        <div class="card-body">
            <?php $result = $conn->query("SELECT * FROM token_list WHERE buyer_id='$id'");
            while ($row = $result->fetch_assoc()) {
                echo "<pre>";
                print_r($row);
                echo "</pre>";
            }
            ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            
        </div>
    </div>
</div>