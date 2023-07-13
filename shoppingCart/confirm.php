<?php
    session_start();
    //$a = cart badge
    $a = 0;
    $_SESSION['a'] = $a;
    $cart = ($_SESSION['cart']);

    if (!isset($_SESSION['name']))
        header('location: indexToBe.php');

    if (isset($_POST['btnConfirm']))
    {                     
        $_SESSION['cart'] = $cart;
            
        header("location:cart.php"); 
    } 

    //CART
    foreach ($cart as $key => $value) 
    {
        if(isset($value['quantity']))
        {
            $a += $value['quantity'];
        }
    }

    //COntinue shopping
    if (isset($_POST['btnCancel']))
        header('location: indexToBe.php');         
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/styleDetails.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> CONFRIM </title>
    </head>
    <body>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <form action="" method="post">
            <div class="container">
                <div class = "row">
                    <div class="col-md-11  col-sm-12 mt-5 mb-3">
                        <h1><i class="fa fa-home"></i> Franz IT Shopee</h1>
                    </div>
                    <div class="col-md-1 col-sm-12 mt-5 mb-3">
                        <a class="btn btn-primary btn-sm ml-3" href="cart.php">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="badge badge-light"><?php echo $a; ?></span>
                        </a>
                    </div>
                </div>
                <hr>
                <div class = "row"> 
                    <div class="col-md-12  col-sm-12">
                        <h3> Product Successfully Added to Cart, what do you want to do next? </h3>
                    </div>
                    <!--buttons-->
                    <div class="col-sm-12 col-md-2 mt-4">
                        <button class="btn btn-dark btn-lg form-control" type ="submit" name="btnConfirm" ><i class="fa fa-shopping-cart"></i> View Cart</button>
                    </div>
                    <div class="col-sm-12 col-md-4 mt-4">
                        <button class="btn btn-danger btn-lg form-control" type="submit" name="btnCancel"><i class="fa fa-shopping-bag"></i> Continue Shopping</button>
                    </div>
                </div>   
            </div>
        </form>       
        <script type="text/javascript" href="../js/jquery.3-6-0.js"></script>
        <script type="text/javascript" href="../js/bootsrap.js"></script>
    </body>
</html>