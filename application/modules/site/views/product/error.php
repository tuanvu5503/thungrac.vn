<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style type="text/css">
		body{
			min-height: 1000px;
			padding-top: 75px;
		}
	</style>

	<!-- My CSS -->
	<link href="<?php echo base_url.'public/css/site/product.css' ?>" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url.'public/js/site/products.js'?>"></script>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php 
			if (isset($error)) {
				echo "<div style='font-size:20px; margin-top:50px;'>".$error."</div>";
			}
			 ?>
				
			</div>
		</div>
	</div>
</body>
</html>