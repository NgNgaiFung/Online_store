<?php 

    include('login/database.php');
    $sql = 'SELECT product_id, product_name, product_description, price, seller_id, sold FROM products ORDER BY product_id DESC';
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);
 ?>

 <style>
    .product-image {
        display: block;
        margin: 0 auto;
        object-fit: cover;
        width:250px;
        height:250px;
    }
</style>

<div class="container">
    <div class="row">
        <!-- Cycle through the output array here -->
        <?php foreach ($products as $product) : ?>
            <?php if ($product['sold'] == 0) : ?>
                <!-- 12 columns in a row -->
                <div class="col s6 md3">
                    <div class="card">
                        <div class="card-content center">
                            <?php 
                                // Construct the path to the product image
                                $imagePath = "product_images/product{$product['product_id']}.jpg";

                                // Check if the image file exists
                                if (file_exists($imagePath)) {
                                    // If the image exists, display it
                                    echo "<img class='product-image' src='$imagePath'>";
                                } else {
                                    // If the image does not exist, display a placeholder image
                                    echo "<img class='product-image' src='product_images/product12.jpg'>";
                                }
                            ?>
                        
                            <h6><?php echo htmlspecialchars($product['product_name']); ?></h6>

                            <?php echo "$" . htmlspecialchars($product['price']); ?>
                            
                        </div>
                        <div class="row center">
                            <div class="col s12 m6 offset-m3 card-action">
                                <a class="btn brand z-depth-0" href="/GP/TABS/product_description.php?id=<?php echo htmlspecialchars($product['product_id']); ?>"> More INFO</a>
                            </div>
                        </div>
                    </div> <!-- card -->
                </div> <!-- col -->
            <?php endif; ?>
        <?php endforeach; ?>    <!-- end foreach -->
    </div> <!-- row -->
</div>