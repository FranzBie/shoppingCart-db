<?php
    session_start();

    //$a = cart badge
    $a = 0;

    if (isset($_POST['btnCancel']))
        header('location: cart.php');
    
    if (!isset($_SESSION['cart']))
        header('location: cart.php');    
    
    //CART BADGE
    if (isset($_SESSION['cart'])) 
    {
        $_SESSION['a'] = $a;
        $cart = ($_SESSION['cart']);
        
        //BADGE
        foreach ($cart as $key => $value) 
        {
            if(isset($value['quantity']))
            {
                $a += $value['quantity'];
            
            }      
        }
    }

    if (isset($_POST['btnConfirm']))
    {    
        unset($_SESSION['cart']);
        foreach ($cart as $key => $value) 
        { 
            if ($value['name'] != $_GET['name']) 
            {          
                $name           = $value['name'];                
                $price          = $value['price'];
                $description    = $value['description'];
                $size           = $value['size'];
                $quantity       = $value['quantity'];   
                $photo1         = $value['photo1'];  
                $totalPr        = $value['totalPr']; 
                
                $_SESSION['name']   = $name;
                $_SESSION['price']  = $price;                            
                $_SESSION['photo1'] = $photo1;
                $_SESSION['description'] = $description;
                $_SESSION['size']   = $size;
                $_SESSION['quantity']   = $quantity;
                $_SESSION['totalPr']   = $totalPr;

                $cart = array
                (
                    "name"      =>"$name",
                    "price"     =>$price,
                    "quantity"  =>$quantity,
                    "description"  =>$description,
                    "size"      =>$size,
                    "photo1"    =>$photo1,
                    "totalPr"   =>$totalPr
                );
                $_SESSION['cart'][] = $cart;

                header("location: cart.php");
                
            }  
        }     
    }   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/styleDetails.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Delete </title>
    </head>
    <body>       
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <form method = "post">
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
                    <!--START prod details-->
                    <!--prodImg-->        
                    <div class="col-4">
                        <img class="pic-1" src="../img/<?php echo $_GET['photo1']; ?>">
                    </div>
                    <div class ="col-8">
                        <h3> <?php echo $_GET['name']; ?> <span class="badge badge-secondary">₱<?php echo $_GET['price']; ?>.00</span></h3>
                        <!--descriptions-->
                        <p>
                            <?php echo $_GET['description']; ?>
                        </p>
                        <hr>
                        <!--size-->                  
                        <h3>Size:</h3>
                        <?php echo $_GET['size']; ?>             
                        <hr>
                        <!--quantity-->
                        <h3>Quantity:</h3>
                        <?php echo $_GET['quantity']; ?>
                    
                        <!--buttons-->
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-4">
                                <button type ="submit" name="btnConfirm" class="btn btn-dark btn-lg form-control"><i class="fa fa-shopping-bag"></i> Remove Product</button>
                            </div>
                            <div class="col-sm-12 col-md-4 mt-4">
                                <button type ="submit" name="btnCancel" class="btn btn-danger btn-lg form-control"><i class="fa fa-ban"></i> Cancel / Go Back</button>
                            </div>

                        </div>
                    </div>   
                    <!--END DEATILS-->  
                </div>
            </div>
        </form>  
        <script type="text/javascript" href="../js/jquery.3-6-0.js"></script>
        <script type="text/javascript" href="../js/bootsrap.js"></script>
    </body>
</html>