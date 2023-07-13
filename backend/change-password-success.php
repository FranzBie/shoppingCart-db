<?php
	session_start();
    $_SESSION['CURR_PAGE'] = 'change-password';
	require_once("header.php"); 
?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("nav.php"); ?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
		    	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        	<h1 class="h2"><i class="fa fa-user"></i> Change Password</h1>
		    	</div>
		    	<p>Password Successfully Changed!</p>
		    	<a href="change-password.php" class="btn btn-info btn-block"><i class="fa fa-check"></i> Ok</a>
		    </main>
		</div>
	</div>

<?php require_once("footer.php"); ?>	