<?php
	session_start();	
	require_once('functions.php');
	require_once("header.php");
	$err = [];	
	
	$con = openConnection();
	$strSql = "SELECT * FROM tbl_customer WHERE emailAddress = '" . $_SESSION['emailAddress'] . "'";	
	$recUser = getRecord($con, $strSql);	
	closeConnection($con);

	if(isset($_POST['btnUpdate'])) {
		$con = openConnection();

		$currentPassword = sanitizeInput($con, $_POST['txtCurrentPassword']);
		$newPassword = sanitizeInput($con, $_POST['txtNewPassword']);
		$reTypePassword = sanitizeInput($con, $_POST['txtReTypePassword']);

		if(empty($currentPassword))
			$err[] = "Current Password is Required!";

		if(md5($currentPassword) != $recUser['password'])
			$err[] = "Current Password is Incorrect!";

		if(empty($newPassword))
			$err[] = "New Password is Required!";

		if($newPassword != $reTypePassword)
			$err[] = "New Password and Re-Type Password did not match!";

		if(empty($err)) {
			$strSql = "UPDATE tbl_customer SET password = '" . md5($newPassword) . "' WHERE emailAddress = '" . $_SESSION['emailAddress'] . "'";
			if(mysqli_query($con, $strSql))
					header('location: change-password-success.php');
		}
		else
			$err[] = "Error: Failed to Update the Record!";
	
		closeConnection($con);
	}
?>

	<div class="container">
		<div class="row">	
		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
		    	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        	<h1 class="h2"><i class="fa fa-user"></i> Change Password</h1>
		    	</div>

				<div class="row">
					<div class="col-12">
						<?php if(isset($err)): ?>
							<?php foreach($err as $errMsg): ?>
								<div class="col-12">
									<div class="alert alert-danger alert-dismissible  fade show" role="alert">
										<strong><i class="fa fa-exclamation-triangle"></i> Error Message!</strong> <?php echo $errMsg; ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							<?php endforeach;?>
						<?php endif; ?>
					</div>
				</div>

				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="txtCurrentPassword" class="col-sm-4 col-form-label text-right">Current Password <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="txtCurrentPassword" id="txtCurrentPassword" class="form-control" placeholder="Current Password" value="<?php echo ''; ?>" required autofocus>
						</div>
					</div>									

					<div class="form-group row">
						<label for="txtNewPassword" class="col-sm-4 col-form-label text-right">New Password <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="txtNewPassword" id="txtNewPassword" class="form-control" placeholder="New Password" value="<?php echo ''; ?>" required>
						</div>
					</div>									

					<div class="form-group row">
						<label for="txtReTypePassword" class="col-sm-4 col-form-label text-right">Re-Type Password <span class="text-danger">*</span></label>
						<div class="col-sm-8">
							<input type="password" name="txtReTypePassword" id="txtReTypePassword" class="form-control" placeholder="Re-Type Password" value="<?php echo ''; ?>" required>
						</div>
					</div>									
				
					<div class="form-group row">
						<div class="offset-sm-4 col-sm-8">
							<button type="submit" name="btnUpdate" class="btn btn-success"><i class="fa fa-edit"></i> Change Password</button>
						</div>
					</div>
				</form>

				<br><br><br>
		    </main>
		</div>
	</div>