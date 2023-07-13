<?php
    session_start();
    require_once('functions.php');

    $firstName = '';
    $lastName = '';
    $address = '';
    $mobileNumber = '';
    $emailAddress = '';
    $err = [];

    if(isset($_POST['btnRegister'])) {
        $con = openConnection();

        $firstName = sanitizeInput($con, $_POST['txtFirstName']);
        $lastName = sanitizeInput($con, $_POST['txtLastName']);
        $birthday = sanitizeInput($con, $_POST['dtpBirthday']);
        $sex = sanitizeInput($con, $_POST['drpSex']);
        $address = sanitizeInput($con, $_POST['txtAddress']);
        $mobileNumber = sanitizeInput($con, $_POST['txtMobileNumber']);
        $emailAddress = sanitizeInput($con, $_POST['txtEmailAddress']);
        $password = sanitizeInput($con, $_POST['txtPassword']);
		$reTypePassword = sanitizeInput($con, $_POST['txtReTypePassword']);

        if(empty($firstName))
			$err[] = "First Name is Required!";

        if(empty($lastName))
			$err[] = "Last Name is Required!";
            
        if(empty($birthday))
			$err[] = "Birthday is Required!";

        if(empty($sex))
			$err[] = "Sex is Required!";
        
        if(empty($address))
			$err[] = "Address is Required!";

        if(empty($mobileNumber))
			$err[] = "Mobile is Required!";
        elseif(strlen($mobileNumber) != 11)
            $err[] = "Mobile should ne 11 characters!";
        
        if(empty($emailAddress))
			$err[] = "Email Address is Required!";
        else {
            $strSql = "SELECT * FROM tbl_customer WHERE emailAddress = '" . $emailAddress . "'";
            if($rsValidate = mysqli_query($con, $strSql)) {
                if(mysqli_num_rows($rsValidate) > 0) {
                    $err[] = "Email Address is already taken!";
                    mysqli_free_result($rsValidate);
                }
            }
        }

        if(empty($password))
			$err[] = "Password is Required!";
        elseif($password != $reTypePassword)
            $err[] = "Password did not match!";

        if(empty($err)) {
            $password = md5($password);
            $strSql = "
                    INSERT INTO tbl_customer(
                        firstName, 
                        lastName, 
                        emailAddress, 
                        password, 
                        birthday, 
                        sex, 
                        address, 
                        mobileNumber
                    ) 
                    VALUES(
                        '$firstName', 
                        '$lastName', 
                        '$emailAddress', 
                        '$password', 
                        '$birthday', 
                        '$sex', 
                        '$address', 
                        '$mobileNumber'
                    )
            ";
            if(mysqli_query($con, $strSql)) {
                $_SESSION['emailAddress'] = $emailAddress;                
                header("location: /shopping-cart-db/");
            }        
        }
        else
            $err[] = "Error: Failed to Register Account!";

        closeConnection($con);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="css/custom-login.css">
	<title>Registration Form</title>
</head>
<body>
	<div class="container">              
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Create Account</h4>                
                
				<?php if(!empty($err)): ?>
					<?php foreach($err as $errMsg): ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong><i class="fa fa-exclamation-triangle"></i> Error Message!</strong> <?php echo $errMsg; ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>

                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" name="txtFirstName" class="form-control" placeholder="First Name" value="<?php echo $firstName; ?>" required autofocus>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" name="txtLastName" class="form-control" placeholder="Last Name" value="<?php echo $lastName; ?>" required>
                    </div> <!-- form-group// -->                    

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                        </div>
                        <input type="date" name="dtpBirthday" class="form-control" placeholder="Birthday" value="<?php echo $birthday; ?>" required>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-venus-mars"></i> </span>
                        </div>
                        <select name="drpSex" class="form-control">                            
                            <option value="Male" selected>Male</option>
                            <option value="Female">Female</option>                            
                        </select>
                    </div> <!-- form-group end.// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-map-location-dot"></i> </span>
                        </div>
                        <input type="text" name="txtAddress" class="form-control" placeholder="Address" value="<?php echo $address; ?>" required>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <input type="text" name="txtMobileNumber" class="form-control" placeholder="Mobile Number" value="<?php echo $mobileNumber; ?>" maxlength="11" minlength="11" required>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input type="email" name="txtEmailAddress" class="form-control" placeholder="Email Address" value="<?php echo $emailAddress; ?>" required>
                    </div> <!-- form-group// -->
                    
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input type="password" name="txtPassword" class="form-control" placeholder="Create password" required>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input type="password" name="txtReTypePassword" class="form-control" placeholder="Repeat password" required>
                    </div> <!-- form-group// -->                                      
                    <div class="form-group">
                        <button name="btnRegister" type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                    </div> <!-- form-group// -->      
                    <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>                                                                 
                </form>
            </article>
        </div> <!-- card.// -->        
    </div><!-- /container -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>