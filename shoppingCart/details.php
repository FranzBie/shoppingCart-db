<?php
    session_start();
    $size = "XS";

    //$a = cart badge
    $a = 0;
    
    //backToIndex
    if (!isset($_GET['name']))
        header('location: indexToBe.php');

    //confirm
    if (isset($_POST['btnConfirm']))
    {      
        if($size = $_POST['radSize'])
        {
            $size       = $_POST['radSize'];
            $quantity   = $_POST['numQty'];
            $name       = $_GET['name'];                
            $price      = $_GET['price'];
            $description      = $_GET['description'];
            $photo1     = $_GET['photo1'];  
            $totalPr = $price * $quantity; 
            
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

            header("location: confirm.php");
        }
        else
            echo 'ENTER SIZE';
    }       

    if (isset($_POST['btnCancel']))
        header('location: indexToBe.php');

    //CART BADGE
    if (isset($_SESSION['cart'])) 
    {
        $_SESSION['a'] = $a;
        $cart = ($_SESSION['cart']);
        foreach ($cart as $key => $value) 
        {
            if(isset($value['quantity']))
            {
                $a += $value['quantity'];
            
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
        <title> Details </title>
    </head>
    <body>     
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
                            <h3>Select Size:</h3>

                            <?php
                                if ($size == "XS") 
                                {
                                    echo '<input type="radio" name="radSize" id="radXS" value="XS" checked>';
                                    echo '<label for="radXS" class="pr-3">XS</label>';
                                }
                                else
                                {
                                    echo '<input type="radio" name="radSize" id="radXS" value="XS">';
                                    echo '<label for="radXS" class="pr-3">XS</label>';
                                }                  
                            ?>
                            <?php
                                if ($size == "S") 
                                {
                                    echo '<input type="radio" name="radSize" id="radS" value="S" checked>';
                                    echo '<label for="radS" class="pr-3">S</label>';
                                }
                                else
                                {
                                    echo '<input type="radio" name="radSize" id="radS" value="S">';
                                    echo '<label for="radS" class="pr-3">S</label>';
                                }                  
                            ?>
                            <?php
                                if ($size == "M") 
                                {
                                    echo '<input type="radio" name="radSize" id="radM" value="M" checked>';
                                    echo '<label for="radM" class="pr-3">M</label>';
                                }
                                else
                                {
                                    echo '<input type="radio" name="radSize" id="radM" value="M">';
                                    echo '<label for="radM" class="pr-3">M</label>';
                                }                  
                            ?>
                            <?php
                                if ($size == "L") 
                                {
                                    echo '<input type="radio" name="radSize" id="radL" value="L" checked>';
                                    echo '<label for="radL" class="pr-3">L</label>';
                                }
                                else
                                {
                                    echo '<input type="radio" name="radSize" id="radL" value="L">';
                                    echo '<label for="radL" class="pr-3">L</label>';
                                }                  
                            ?>
                            <?php
                                if ($size == "XL") 
                                {
                                    echo '<input type="radio" name="radSize" id="radXL" value="XL" checked>';
                                    echo '<label for="radXL" class="pr-3">XL</label>';
                                }
                                else
                                {
                                    echo '<input type="radio" name="radSize" id="radXL" value="XL">';
                                    echo '<label for="radXL" class="pr-3">XL</label>';
                                }                  
                            ?>
            
                        <hr>
                        <!--quantity-->
                        <h3>Enter Quantity:</h3>
                        <input type="number" name="numQty" id="" class="form-control" value="1" min="1" max="100">                      
                        <!--buttons-->
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-4">
                                <button type ="submit" name="btnConfirm" class="btn btn-dark btn-lg form-control"><i class="fa fa-shopping-bag"></i> Confirm Product Purchase</button>
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