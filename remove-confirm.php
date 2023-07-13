<?php
    session_start();
    require_once('dataset.php');

    if(isset($_POST['btnProcess'])) {
        unset($_SESSION['cartItems'][$_POST['hdnKey']][$_POST['hdnSize']]);        
        $_SESSION['totalQuantity'] -= $_POST['hdnQuantity'];
        header("location: cart.php");
    }    
    require_once('header.php');
?>

    <form method="post">
        <div class="container">        
            <div class="row">
                <?php if(isset($_GET['k']) && isset($arrProducts[$_GET['k']])): ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                        <div class="product-grid2 card">
                            <div class="product-image2">
                                <a href="details.php?k=<?php echo $key; ?>">
                                    <img class="pic-1" src="img/<?php echo $arrProducts[$_GET['k']]['photo1']; ?>">
                                    <img class="pic-2" src="img/<?php echo $arrProducts[$_GET['k']]['photo2']; ?>">
                                </a>                                                    
                            </div>                        
                        </div>
                    </div>    
                    <div class="col-6 col-sm-6 col-md-8 col-lg-8">
                        <div class="product-content">
                            <h3 class="title">
                                <?php echo $arrProducts[$_GET['k']]['name']; ?>
                                <span class="badge badge-dark">₱ <?php echo $arrProducts[$_GET['k']]['price']; ?></span>                            
                            </h3>                        
                            <p class="text-justify"><?php echo $arrProducts[$_GET['k']]['description']; ?></p>
                            <hr>
                            <input type="hidden" name="hdnKey" value="<?php echo $_GET['k']; ?>">
                            <input type="hidden" name="hdnSize" value="<?php echo $_GET['s']; ?>">
                            <input type="hidden" name="hdnQuantity" value="<?php echo $_GET['q']; ?>">
                            <h3 class="title">Size: <?php echo $_GET['s']; ?></h3>                                                      
                            <hr>
                            <h3 class="title">Quantity: <?php echo $_GET['q']; ?></h3>                            
                            <br>
                            <button type="submit" name="btnProcess" class="btn btn-dark btn-lg"><i class="fa fa-trash"></i> Confirm Product Removal</button>
                            <a href="cart.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>
                        </div>
                    </div>                                      
                <?php endif; ?>
            </div>
        </div>
    </form>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>