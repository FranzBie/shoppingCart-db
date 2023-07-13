<?php
    session_start();
  
    //$a = cart badge
    $a = 0;
    
    //PRODUCTS
    $arrProducts = array
    (
        array//0
        (
            'name'          => 'Brown Shirt', 
            'description'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi cupiditate quis sunt consequatur odit dicta molestias explicabo reprehenderit, rerum aut corrupti totam sint autem! Deserunt temporibus soluta quibusdam recusandae fugiat!',
            'price'         => '550',
            'photo1'        => 'produc1A.jpg',
            'photo2'        => 'produc1B.jpg'

        ),
        array//1
        (
            'name'          => 'Gray Shirt', 
            'description'   => 'Nam id mollis turpis. Cras eleifend, quam bibendum luctus aliquam, tellus neque auctor metus, vel ullamcorper eros nisl id ipsum. Donec pretium, enim id aliquam auctor, arcu leo lobortis nisi, ac consectetur lacus erat eget nisl. Pellentesque eget sapien a lectus pharetra convallis.',
            'price'         => '550',
            'photo1'        => 'produc2A.jpg',
            'photo2'        => 'produc2B.jpg'
            
        ),
        array//2
        (
            'name'          => 'White Blazer', 
            'description'   => 'Morbi dignissim augue et lectus efficitur lobortis. Donec posuere auctor orci, consectetur commodo leo gravida vitae. Donec eu tempor quam, non malesuada lorem.',
            'price'         => '800',
            'photo1'        => 'produc3A.jpg',
            'photo2'        => 'produc3B.jpg'
        ),
        array//3
        (
            'name'          => 'Blue Polo Shirt', 
            'description'   => 'Nunc sed mi risus. Ut id lacus dapibus, pretium nulla sed, pretium libero. Donec accumsan, eros nec maximus blandit, metus ipsum efficitur nisi, non mollis odio velit ac est. !',
            'price'         => '860',
            'photo1'        => 'produc4A.jpg',
            'photo2'        => 'produc4B.jpg'
        ),
        array//4
        (
            'name'          => 'Blue Polo', 
            'description'   => 'Praesent volutpat magna et fringilla condimentum. Etiam semper efficitur cursus. Nunc imperdiet risus velit, in vulputate ligula luctus sit amet. Mauris eu lorem ac felis faucibus finibus ut a lacus. Fusce a mauris sem. Etiam sollicitudin magna ac felis porta finibus. ',
            'price'         => '600',
            'photo1'        => 'produc5A.jpg',
            'photo2'        => 'produc5B.jpg'
        ),
        array//5
        (
            'name'          => 'White Polo', 
            'description'   => 'Morbi posuere ipsum mi, sed euismod odio rhoncus sed. Aliquam erat volutpat. Phasellus at gravida ante. Nam volutpat maximus molestie. Donec in felis dapibus, finibus nibh id, scelerisque orci. Aenean nisi urna, imperdiet eu nibh sed, bibendum accumsan urna.',
            'price'         => '550',
            'photo1'        => 'produc6A.jpg',
            'photo2'        => 'produc6B.jpg'
        ),
        array//6
        (
            'name'          => 'Blue Blazer', 
            'description'   => 'Integer tempus rhoncus felis vitae interdum. Nulla facilisis elit mi, nec ultrices tortor vulputate sed. Pellentesque et laoreet sapien. Morbi bibendum arcu id diam volutpat tincidunt. Sed dictum posuere mauris, a aliquam ipsum euismod ut. Pellentesque nec blandit massa. Cras maximus ex eu diam fringilla,',
            'price'         => '850',
            'photo1'        => 'produc7A.jpg',
            'photo2'        => 'produc7B.jpg'
        ),
        array//7
        (
            'name'          => 'Floral Polo', 
            'description'   => 'egestas vestibulum metus laoreet. Fusce nunc neque, placerat eleifend nisi vitae, mattis ornare lorem. Phasellus fringilla lectus interdum fermentum accumsan. Integer malesuada convallis ipsum, in aliquam metus pretium porta. Fusce laoreet placerat odio, in dictum erat ornare vel. ',
            'price'         => '1000',
            'photo1'        => 'produc8A.jpg',
            'photo2'        => 'produc8B.jpg'
        )
    ); 
             
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
        <link rel="stylesheet" type="text/css" href="../css/styleIndex.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
    </head>
    <body>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <div class="container">
            <div class = "row">
                <div class="col-md-11  col-sm-12 mt-5 mb-3">
                    <h1><i class="fa fa-home"></i> Franz IT Shopee</h1>
                </div>
                <div class="col-md-1 col-sm-12 mt-5 mb-3">
                    <a class="btn btn-primary btn-sm ml-3" href="cart.php">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span class="badge badge-light"><?php echo $a ?></span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">               
                <?php   if (isset($arrProducts)) :?>
                    <!--START foreach arrProducts-->
                    <?php
                        foreach ($arrProducts as $key => $value) 
                        {   
                            $name = urlencode($value['name']);
                            $price = urlencode($value['price']);
                            $description = urlencode($value['description']);
                            $photo1 = urlencode($value['photo1']);
                    ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid2">
                                <div class="product-image2"> 
                                    <!--details.php URL ENCODING-->
                                    <a href="details.php?name=<?php echo $name;?>&price=<?php echo $price;?>&description=<?php echo $description;?>&photo1=<?php echo $photo1;?>">                                       
                                        <?php
                                            //IMAGES PHOTO 1 AND 2
                                            echo'<img name="imgOne" id="imgOne" class="pic-1" src="../img/'.$value['photo1'].'">
                                            <img name="imgTwo" id="imgTwo" class="pic-2" src="../img/'.$value['photo2'].'">' ;
                                        ?>
                                    </a>
                                    <a class="add-to-cart" href="details.php?name=<?php echo $name;?>&price=<?php echo $price;?>&description=<?php echo $description;?>&photo1=<?php echo $photo1;?>">Add to cart</a>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><?php echo $value['name'] ?>
                                    <span class="badge badge-dark">₱<?php echo $value['price'] ?>.00</span></h3>
                                </div>
                            </div>
                        </div> 
                    <?php      
                        }                 
                    ?>
                    <!--END foreach arrProducts-->  
                    <!--Inayos ko po yung indentation off-cam. minor changes lang po na wala sa vid-->
                <?php endif; ?>
            </div>
        <script type="text/javascript" href="../js/jquery.3-6-0.js"></script>
        <script type="text/javascript" href="../js/bootsrap.js"></script>
    </body>
</html>