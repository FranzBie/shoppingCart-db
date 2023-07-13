<?php
    session_start();

    if(isset($_GET['k']))
        $_SESSION['current-page'] = 'details.php?k=' . $_GET['k'];

    require_once('dataset.php');

    if(isset($_POST['btnProcess'])) {
        if(isset($_SESSION['emailAddress'])) {
            if(isset($_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']]))
                $_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']] += $_POST['txtQuantity'];
            else
                $_SESSION['cartItems'][$_POST['hdnKey']][$_POST['radSize']] = $_POST['txtQuantity'];
            
            $_SESSION['totalQuantity'] += $_POST['txtQuantity'];
            header("location: confirm.php");
        }
        else
            header("location: login.php");        
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
                            <h3 class="title">Select Size:</h3>
                            <input type="radio" name="radSize" id="radXS" value="XS" checked>
                            <label for="radXS" class="pr-3">XS</label>
                            <input type="radio" name="radSize" id="radSM" value="SM">
                            <label for="radSM" class="pr-3">SM</label>
                            <input type="radio" name="radSize" id="radMD" value="MD">
                            <label for="radMD" class="pr-3">MD</label>
                            <input type="radio" name="radSize" id="radLG" value="LG">
                            <label for="radLG" class="pr-3">LG</label>
                            <input type="radio" name="radSize" id="radXL" value="XL">
                            <label for="radXL" class="pr-3">XL</label>                            
                            <hr>
                            <h3 class="title">Enter Quantity:</h3>
                            <input type="number" name="txtQuantity" id="txtQuantity" placeholder="0" class="form-control" min="1" max="100" required>
                            <br>
                            <button type="submit" name="btnProcess" class="btn btn-dark btn-lg"><i class="fa fa-check-circle"></i> Confirm Product Purchase</button>
                            <a href="/shopping-cart/" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>
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