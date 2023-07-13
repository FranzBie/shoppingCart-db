<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link rel="stylesheet" href="css/styles.css">
    <title>Learn IT Easy Online Shop | Shopping Cart</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-7">
                <h1><i class="fa fa-store"></i> Learn IT Easy Online Shop</h1>
            </div>
            <div class="col-5 text-right">
                <?php if(!isset($_SESSION['emailAddress'])): ?>
                    <a href="login.php" class="btn btn-dark">
                        <i class="fa fa-sign-in-alt"></i> Login                        
                    </a>    
                    <a href="register.php" class="btn btn-success">
                        <i class="fab fa-wpforms"></i> Register                        
                    </a>
                <?php else: ?>
                    <a href="change-password.php" class="btn btn-info">
                        <i class="fa fa-edit"></i> Change Password
                    </a>    
                    <a href="/shopping-cart-db/backend/sign-out.php" class="btn btn-warning">
                        <i class="fa fa-right-from-bracket"></i> Sign Out                        
                    </a>
                <?php endif; ?>
                <a href="cart.php" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span class="badge badge-light">
                        <?php echo (isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : '0'); ?>
                    </span>
                </a>
            </div>
        </div>
        <hr>
    </div>