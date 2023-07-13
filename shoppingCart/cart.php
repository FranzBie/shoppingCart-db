<?php
    session_start();
    //a = cart
    $a = 0;
    //b = total
    $b = 0;
    if (isset($_SESSION['cart'])) 
    {
        $cart = ($_SESSION['cart']);
        //CART BADGE
        foreach ($cart as $key => $value) 
        {
            if(isset($value['quantity']))
            {
                $a += $value['quantity'];
            }

            if(isset($value['totalPr']))
            {
                $c = $value['totalPr'];
            }
        }
    }  

    if (isset($_POST['btnUpdate']))
    {     
        $d= 0;
        foreach ($cart as $key => $value) 
        {
            ++$d;
            if ($cart[$key]['quantity'] != $_POST['numQty'.$d] and isset($_POST['numQty'.$d]) ) 
            {
                $cart[$key]['quantity'] = $_POST['numQty'.$d];
                $_SESSION['cart'] = $cart;
                header("location:cart.php"); 
            }
         }
        
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/styleCart.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
    </head>
    <body>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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
                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col"> </th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Size</th>
                                                <th scope="col" class="text-center">Quantity</th>
                                                <th scope="col" class="text-center">Price</th>
                                                <th scope="col" class="text-center">Total</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $e = 0;
                                            foreach ($cart as $key => $value)
                                            {    
                                                ++$e;          
                                                if (!empty($value['name']) && !empty($value['photo1']))
                                                {                         
                                                    $name = urlencode($value['name']);
                                                    $price = urlencode($value['price']);
                                                    $quantity = urlencode($value['quantity']);
                                                    $photo1 = urlencode($value['photo1']);
                                                    $size = urlencode($value['size']);
                                                    $description = urlencode($value['description']);
                                                    $_SESSION['value']   = $value; 
													//TOTAL PRICE
                                                    $totalPr = $price * $quantity;   
													//TOTAL AMOUNT OVERALL													
                                                    $b +=  $totalPr;                                                                          
                                        ?> 
                                            <!--Product-->
                                            <!--START foreach arrProducts-->
                                                <tr>
                                                    <td><img style="max-width: 50px;" class="" src="../img/<?php echo $value['photo1'] ?>"> </td>
                                                    <td><input type="hidden" name="txtName" value ="<?php echo $key ?>"><?php echo $value['name']; ?></td>
                                                    <!--Size-->
                                                    <td class="text-left"><?php echo $value['size']; ?></td>
                                                    <!--Quantity-->  
                                                    <?php
                                                    //UPDATE
                                      
                                                    ?>                             
                                                    <td><input class="text-center form-control" type="number" name="<?php echo 'numQty'.$e;?>" value="<?php echo $quantity ?>"  min="1" max="100"></td>
                                                    <!--Price-->
                                                    <td class="text-center">₱<?php echo $value['price']; ?>.00</td>
                                                    <!--Total-->
                                                    <td class="text-center ">₱<?php echo $price * $quantity;?>.00</td>
                                                    <!--Delete-->
                                                    <td class="text-center">
                                                        <a href="removeConfirm.php?name=<?php echo $name;?>&price=<?php echo $price;?>&photo1=<?php echo $photo1;?>&size=<?php echo $size;?>&quantity=<?php echo $quantity;?>&description=<?php echo $description;?>" type ="submit" name="btnDelete" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php  
                                                }                                              
                                            }
                                        ?>
                                                <!--TOTAl-->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-left"><strong>Total</strong></td>
                                                    <td class="text-center"><strong><?php echo $a; ?></strong></td>
                                                    <td class="text-center">.....</td>
                                                    <td><strong>Total</strong></td>
                                                    <td class="text-right"><strong>₱<?php echo $b; ?>.00</strong></td>
                                                </tr>        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 text-right mt-3">
                                        <a href ="indexToBe.php" class="btn btn-lg btn-block btn-danger" type="submit" name="btnContinue"><i class="fa fa-shopping-bag"></i> Continue Shopping</a>
                                    </div>
                                    <div class="col-sm-12 col-md-4 text-right mt-3">
                                        <button type ="submit" name="btnUpdate" class="btn btn-lg btn-block btn-success ">
                                            <i class="fa fa-refresh"></i> Update Cart
                                        </button>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-4 text-right mt-3">
                                        <a href = "clear.php"class="btn btn-lg btn-block btn-primary" type="submit" name="btnCheckout"><i class="fa fa-money"></i> Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
        <script type="text/javascript" href="../js/jquery.3-6-0.js"></script>
        <script type="text/javascript" href="../js/bootsrap.js"></script>      
    </body>
</html>