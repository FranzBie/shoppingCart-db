<?php
    session_start();
    unset($_SESSION['totalAmount']);
    unset($_SESSION['totalQuantity']);
    unset($_SESSION['cartItems']);
    require_once('header.php');
?>

    <div class="container">        
        <div class="row">
            <div class="col-12">
                <h3>Online Shopping is Successful!</h3>                
                <a href="/shopping-cart/" class="btn btn-danger btn-lg"><i class="fa fa-shopping-bag"></i> Continue</a>
            </div>            
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>