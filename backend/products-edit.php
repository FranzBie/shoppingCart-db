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
	$description = $recProduct['description'];
	$price = $recProduct['price'];
	$err = [];

	if(isset($_POST['btnUpdate'])) {
		$con = openConnection();
		$arrAllowedFiles = array('jpeg','jpg','png', '');
		$uploadDIR = '/img/';

		$name = sanitizeInput($con, $_POST['txtName']);
		$description = sanitizeInput($con, $_POST['txtDescription']);
		$price = sanitizeInput($con, $_POST['txtPrice']);

		if(isset($_FILES['filPhoto1'])){			
			$fileName1 = $_FILES['filPhoto1']['name'];
			$fileSize1 = $_FILES['filPhoto1']['size'];
			$fileTemp1 = $_FILES['filPhoto1']['tmp_name'];
			$fileType1 = $_FILES['filPhoto1']['type'];

			$fileExtTemp1 = explode('.', $fileName1); //array
			$fileExt1 = strtolower(end($fileExtTemp1));
			
			if(in_array($fileExt1, $arrAllowedFiles) === false)
				$err[] = "<b>File Upload Error(s):</b><br>Extension File is not Allowed, You can only Choose a JPG or PNG File.";

			if($fileSize1 > 5000000)
				$err[] = "<b>File Upload Error(s):</b><br>File size should be 5Mb Maximum.";			
		}

		if(isset($_FILES['filPhoto2'])){			
			$fileName2 = $_FILES['filPhoto2']['name'];
			$fileSize2 = $_FILES['filPhoto2']['size'];
			$fileTemp2 = $_FILES['filPhoto2']['tmp_name'];
			$fileType2 = $_FILES['filPhoto2']['type'];

			$fileExtTemp2 = explode('.', $fileName2); //array
			$fileExt2 = strtolower(end($fileExtTemp2));
			
			if(in_array($fileExt2, $arrAllowedFiles) === false)
				$err[] = "<b>File Upload Error(s):</b><br>Extension File is not Allowed, You can only Choose a JPG or PNG File.";

			if($fileSize2 > 5000000)
				$err[] = "<b>File Upload Error(s):</b><br>File size should be 5Mb Maximum.";			
		}
		
		if(empty($name))
			$err[] = "Product Name is Required!";		

		if(empty($description))
			$err[] = "Description is Required!";

		if(empty($price))
			$err[] = "Price is Required!";

		if(empty($err)){
			$strSql = "
					UPDATE tbl_products SET 
						name = '$name', 
						description = '$description', 
						price = '$price' 
					WHERE id = " . $_SESSION['k'];

			mysqli_query($con, $strSql);

			if(!empty($fileExt1) || !empty($fileExt2)){
				$fileName1 = 'product' . $_SESSION['k'] . 'A.'. $fileExt1;
				$fileName2 = 'product' . $_SESSION['k'] . 'B.'. $fileExt2;
				
				move_uploaded_file($fileTemp1, SITE_ROOT . $uploadDIR . $fileName1);
				move_uploaded_file($fileTemp2, SITE_ROOT . $uploadDIR . $fileName2);
			}

			header('location: products-save-success.php');													
		}
		else
			$err[] = 'Error: Failed to Insert Record!';

		closeConnection($con);
	}
?>

	<div class="container-fluid">
		<div class="row">
			<?php require_once("nav.php"); ?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
		    	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        	<h1 class="h2"><i class="fa fa-cubes"></i> Update Product</h1>
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
						<label for="txtName" class="col-sm-2 col-form-label text-right">Product Name <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value="<?php echo $name; ?>" required autofocus>
						</div>
					</div>					

					<div class="form-group row">
						<label for="txtDescription" class="col-sm-2 col-form-label text-right">Product Description <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<textarea name="txtDescription" id="txtDescription" class="form-control" cols="30" rows="10" placeholder="Product Description" required><?php echo $description; ?></textarea>
						</div>
					</div>					

					<div class="form-group row">
						<label for="txtPrice" class="col-sm-2 col-form-label text-right">Product Price <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="number" name="txtPrice" id="txtPrice" class="form-control" min="1" max="10000" placeholder="0" value="<?php echo $price; ?>" required>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="filPhoto1" class="col-sm-2 col-form-label text-right">Product Photo 1 </label>
						<div class="col-sm-10">
							<input type="file" name="filPhoto1" id="filPhoto1" class="form-control">
						</div>
					</div>					

					<div class="form-group row">
						<label for="filPhoto2" class="col-sm-2 col-form-label text-right">Product Photo 2 </label>
						<div class="col-sm-10">
							<input type="file" name="filPhoto2" id="filPhoto2" class="form-control">
						</div>
					</div>					
				
					<div class="form-group row">
						<div class="offset-sm-2 col-sm-10">
							<button type="submit" name="btnUpdate" class="btn btn-success"><i class="fa fa-edit"></i> Update Record</button>
						</div>
					</div>
				</form>

				<br><br><br>		    	
		    </main>
		</div>
	</div>

<?php require_once("footer.php"); ?>