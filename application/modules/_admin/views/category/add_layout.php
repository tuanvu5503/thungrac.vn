<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style type="text/css">
		body{
			width: 99%;
		}
	    
	</style>

	<!--===================================== My CSS =====================================-->
	<link href="<?php echo base_url.'public/css/admin/menu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url.'public/css/admin/product.css' ?>" rel="stylesheet">
	<!--===================================== My CSS =====================================-->

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


	<!-- ===============================       MY JS         ======================== -->
	<script src="<?php echo base_url.'public/js/admin/menu.js'?>"></script>
	<script src="<?php echo base_url.'public/js/admin/header.js'?>"></script>
	<!-- ===============================      MY JS         ======================== -->

</head>
<body>
		<div class="col-xs-3 col-xs-offset-2  col-sm-3 col-sm-offset-2  col-md-3 col-md-offset-2  col-lg-3 col-lg-offset-2 ">

		<!--============================ Thong bao loi ============================-->
         <div style="<?php if (isset($error) && count($error) > 0) echo 'display:block;'; else echo 'display:none;'; ?>" class="alert alert-danger">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <strong><?php
                    if (isset($error) && count($error) > 0) {
                        foreach ($error as $key => $value) {
                            echo $value.'<br>';
                        }
                    } 
              ?></strong>         
        </div>
         <!--============================ Thong bao loi ============================-->
        	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">THÊM DANH MỤC</legend>
        	<form action="<?php echo base_url.'admin/category/add' ?>" method="POST">
				<div class="form-group">
					<label for="category_name">Tên danh mục</label>
					<input value="<?php if (isset($re_category_name)) echo htmlspecialchars($re_category_name); ?>" name="category_name" required type="text" class="form-control" id="category_name" placeholder="Nhập tên danh mục">
				</div>
			
				<button name="btnSubmit" style="float:right;" type="submit" class="btn btn-primary">Thêm</button>
			</form>
		</div>

</body>
</html>