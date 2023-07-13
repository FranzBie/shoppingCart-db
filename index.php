<?php
    session_start();
    $_SESSION['current-page'] = '';    
    require_once('dataset.php');
    require_once('header.php');
?>
    <div class="container">        
        <div class="row">
            <?php if(isset($arrProducts)): ?>                
                <?php foreach($arrProducts as $key => $product): ?>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-4">
                        <div class="product-grid2 card">
                            <div class="product-image2">
                                <a href="details.php?k=<?php echo $key; ?>">
                                    <img class="pic-1" src="img/<?php echo $product['photo1']; ?>">
                                    <img class="pic-2" src="img/<?php echo $product['photo2']; ?>">
                                </a>                        
                                <a class="add-to-cart" href="details.php?k=<?php echo $key; ?>"><i class="fa fa-cart-plus"></i> Add to cart</a>
                            </div>
                            <div class="product-content">
                                <h3 class="title">
                                    <?php echo $product['name']; ?>
                                    <span class="badge badge-dark">₱ <?php echo $product['price']; ?></span>
                                </h3>                        
                            </div>
                        </div>
                    </div>                            
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 card text-center">
                    <h4 class="text-danger m-5">No Product Found!</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>