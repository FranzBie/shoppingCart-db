<?php
    session_start(); 
    $_SESSION['current-page'] = 'cart.php';
    
    if(!isset($_SESSION['emailAddress']))
        header("location: login.php");

    require_once('dataset.php');
    
    $_SESSION['totalAmount'] = 0;

    if(isset($_POST['btnUpdate'])) {
        $cartKeys = $_POST['hdnKey'];
        $cartSize = $_POST['hdnSize'];
        $cartQty = $_POST['txtQuantity'];

        if(isset($cartKeys) && isset($cartSize) && isset($cartQty)) {
            $_SESSION['totalQuantity'] = 0;

            foreach($cartKeys as $index => $key) {
                $_SESSION['cartItems'][$key][$cartSize[$index]] = $cartQty[$index];
                $_SESSION['totalQuantity'] += $cartQty[$index];
            }
        }
    }
    require_once('header.php');
?>

    <form method="post">
        <div class="container">        
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-1"> </th>
                            <th class="col-3">Product</th>
                            <th class="col-1">Size</th>
                            <th class="col-2 text-center">Quantity</th>
                            <th class="col-2 text-right">Price</th>
                            <th class="col-2 text-right">Total</th>
                            <th class="col-1"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($_SESSION['cartItems'])): ?>                    
                            <?php foreach($_SESSION['cartItems'] as $key => $value): ?>
                                <?php foreach($value as $size => $quantity): ?>                            
                                    <?php $_SESSION['totalAmount'] += $arrProducts[$key]['price'] * $quantity; ?>
                                    <tr>
                                        <td><img class="img-thumbnail" src="img/<?php echo $arrProducts[$key]['photo1']; ?>" style="height: 50px;"></td>
                                        <td><?php echo $arrProducts[$key]['name']; ?></td>
                                        <td><?php echo $size; ?></td>
                                        <td>
                                            <input type="hidden" name="hdnKey[]" value="<?php echo $key; ?>">
                                            <input type="hidden" name="hdnSize[]" value="<?php echo $size; ?>">
                                            <input type="number" name="txtQuantity[]" class="form-control text-center" value="<?php echo $quantity; ?>" placeholder="0" min="1" max="100" required>
                                        </td>
                                        <td class="text-right">₱ <?php echo number_format($arrProducts[$key]['price'], 2); ?></td>
                                        <td class="text-right">₱ <?php echo number_format($arrProducts[$key]['price'] * $quantity, 2); ?></td>
                                        <td class="text-right"><a href="remove-confirm.php?<?php echo 'k=' . $key . '&s=' . $size . '&q=' . $quantity; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                                <tr>
                                    <td colspan="2"> </td>
                                    <td><b>Total</b></td>
                                    <td class="text-center"><?php echo $_SESSION['totalQuantity']; ?></td>
                                    <td class="text-right">----</td>
                                    <td class="text-right"><b>₱ <?php echo number_format($_SESSION['totalAmount'], 2); ?></b></td>
                                    <td class="text-right">----</td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-4">
                    <a href="/shopping-cart/" class="btn btn-danger btn-lg btn-block"><i class="fa fa-shopping-bag"></i> Continue Shopping</a>
                </div>
                <div class="col-4">
                    <button type="submit" name="btnUpdate" class="btn btn-success btn-lg btn-block"><i class="fa fa-edit"></i> Update Cart</button>
                </div>
                <div class="col-4">
                <a href="clear.php" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-out-alt"></i> Checkout</a>
                </div>
            </div>
        </div>    
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>