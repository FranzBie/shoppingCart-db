<?php
	session_start();
	$_SESSION['CURR_PAGE'] = 'products';
	require_once("header.php"); 

	if(isset($_GET['k']))
		$_SESSION['k'] = $_GET['k'];

	$con = openConnection();
	$strSql = "SELECT * FROM tbl_products WHERE id = " . $_SESSION['k'];
	$recProduct = getRecord($con, $strSql);
	closeConnection($con);

	$name = $recProduct['name'];	
	$price = $recProduct['price'];
    $photo1 = $recProduct['photo1'];
    $photo2 = $recProduct['photo2'];	

	if(isset($_POST['btnDelete'])) {
		$con = openConnection();
		
        $strSql = "
                DELETE FROM tbl_products  
                WHERE id = " . $_SESSION['k'];
        mysqli_query($con, $strSql);
        header('location: products-remove-success.php');

        unlink(SITE_ROOT . '/img/' . $photo1);
        unlink(SITE_ROOT . '/img/' . $photo2);

		closeConnection($con);
	}
?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("nav.php"); ?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
		    	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        	<h1 class="h2"><i class="fa fa-cubes"></i> Delete Product</h1>
		    	</div>				

				<form method="post" enctype="multipart/form-data">
					
					<div class="form-group row">
						<div class="col-sm-12">
                            <a href="products.php" class="btn btn-dark"><i class="fa fa-arrow-left"></i> Cancel</a>
							<button type="submit" name="btnDelete" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Record</button>
						</div>
					</div>
				</form>
                <hr>                
                <h3>Are you sure you want to delete this Product?</h3>
                <ul>
                    <li><b>Product Name:</b> <?php echo $name; ?></li>
                    <li><b>Price:</b> ₱ <?php echo number_format($price, 2); ?></li>
                    <img src="../img/<?php echo $photo1; ?>" alt="" class="img-thumbnail w-25">
                    <img src="../img/<?php echo $photo2; ?>" alt="" class="img-thumbnail w-25">
                </ul>
		    </main>
		</div>
	</div>

<?php require_once("footer.php"); ?>