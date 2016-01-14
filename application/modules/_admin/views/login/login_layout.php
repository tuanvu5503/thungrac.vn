<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<style type="text/css">
		body{
			padding-top: 60px;
		}

	</style>
	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!--===================================== My CSS =====================================-->
	<link href="<?php echo base_url().'public/css/admin/login.css' ?>" rel="stylesheet">
	<!--===================================== My CSS =====================================-->

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
				
				<!--============================ Thong bao loi ============================-->
				<div style="<?php if (isset($error) && count($error) > 0) echo 'display:block;'; else echo 'display:none;'; ?>" class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>
						<?php
						if (isset($error) && count($error) > 0) {
							foreach ($error as $key => $value) {
								echo $value.'<br>';
							}
						} 
						?>
					</strong>         
				</div>
				<!--============================ Thong bao loi ============================-->

				<form class="login" action="<?php echo base_url().'index.php/_admin/login'; ?>" method="POST">
					<h1>Login</h1>
					<input value="<?php if (isset($re_username)) echo htmlspecialchars($re_username); ?>" class="login" name="username" placeholder="Username" type="text" required="">
					<input value="<?php if (isset($re_password)) echo htmlspecialchars($re_password); ?>" class="login" name="password" placeholder="Password" type="password" required="">
					<button class="login" name="btnLogin">Submit</button>
				</form>
			</div>
		</div>
	</div>

</body>
</html>