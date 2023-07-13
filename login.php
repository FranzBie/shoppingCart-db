<?php
    session_start();
    require_once('functions.php');

    if(isset($_POST['btnLogin'])) {
        $con = openConnection();

        $emailAddress = sanitizeInput($con, $_POST['txtEmailAddress']);
        $password = sanitizeInput($con, $_POST['txtPassword']);
        $password = md5($password); //hash the password
        $err = true;

        $strSql = "
                    SELECT * FROM tbl_customer 
                    WHERE emailAddress = '$emailAddress' 
                    AND password = '$password'
                ";    

        if($rsLogin = mysqli_query($con, $strSql)){
            if(mysqli_num_rows($rsLogin) > 0){
                // if true, its means it found a record based on the inputted emailAddress and password
                $_SESSION['emailAddress'] = $emailAddress;
                mysqli_free_result($rsLogin);
                header("location: /shopping-cart-db/" . $_SESSION['current-page']);
            }            
        }        

        closeConnection($con);
    }
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
	<link rel="stylesheet" type="text/css" href="css/custom-login.css">
	<title>Login Form</title>
</head>
<body>
	<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <form class="form-signin" method="post">
                <input type="email" name="txtEmailAddress" class="form-control" placeholder="Email Address" required autofocus>
                <input type="password" name="txtPassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="btnLogin">Sign in</button>
                <a href="/shopping-cart-db/" class="btn btn-dark btn-block">Go Back</a>
            </form><!-- /form -->

            <p class="mt-3">Doesn't Have an account? <a href="register.php">Register</a></p>
        </div><!-- /card-container -->
    
    <div class="row">
        <div class="col-12">
            <?php if(isset($err)): ?>
                <div class="offset-4 col-4">
                    <div class="alert alert-danger alert-dismissible  fade show" role="alert">
                        Invalid Email Address / Password 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    </div><!-- /container -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>