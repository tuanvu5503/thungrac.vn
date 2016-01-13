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
	    .pagination{
	    	float: right;
	    }
	</style>

	<!--===================================== My CSS =====================================-->
	<link href="<?php echo base_url().'public/css/admin/menu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/admin/product.css' ?>" rel="stylesheet">
	<!--===================================== My CSS =====================================-->

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


	<!-- ===============================       MY JS         ======================== -->
	<script src="<?php echo base_url().'public/js/admin/jquery.cookie.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/setAlert.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/product.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/menu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/main/header.js'?>"></script>
	<!-- ===============================      MY JS         ======================== -->

</head>
<body>

		<!--============================== Modal Delte ==============================-->
		<div class="modal fade" id="modal_delete">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Bạn chắc chắn xóa?</h4>
						<input id="del_id" 	type="hidden" value="">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button" class=" delete btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<!--============================== Modal Delte ==============================-->

		<!--============================ Thong bao loi ============================-->
         <div id="war" style="<?php if (isset($_SESSION['war']) && count($_SESSION['war']) > 0) echo 'display:block;'; else echo 'display:none;'; ?>" class="alert alert-warning">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <strong class="war"><?php
                    if (isset($_SESSION['war']) && count($_SESSION['war']) > 0) {
                    	$i = 0;
                    	echo  "<span style='color: green; font-size:16px; font-weight:bold;'>".$_SESSION['war']['title'].'</span> <br>';
                    	unset($_SESSION['war']['title']);  //xoa khoi array
                    	echo "<span style='font-size:15px; font-weight:bold;'>Có ".count($_SESSION['war'])." ảnh chi tiết không được upload vì:</span>";
                        foreach ($_SESSION['war'] as $key => $value) {
                        	$i++;
                           	echo '<li style="margin-left:15px;">Ảnh '.$i.': '.$value.'</li>';
                        }
                        ?>
                        <script type="text/javascript">
                        	$('div#war').delay(5000).fadeTo(2000, 500).slideUp(500,function () {
						        $("strong.war").text('');
						    });
                        </script>
                        <?php
                        $_SESSION['war']=array();
                    } 
              ?></strong>         
        </div>
         <!--============================ Thong bao loi ============================-->

		<!--============================== Alert ==============================-->
		<div style="display:none;" id="success-alert" class="text-center alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong class='mess'></strong>
		</div>

		<div style="display:none;" id="failed-alert" class="text-center alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong class='mess'></strong>
		</div>
		<!--============================== Alert ==============================-->

		<!--============================== Clock header START ==============================-->
		<script type="text/javascript">
    		var delta_time = <?php echo time() * 1000 ?> - Date.now();
		</script>
		
		<div class="row">
				<div class="header_bar">
					<div id="clock"></div>
				</div>
		</div>
		<!--============================== Clock header END ==============================-->

	<div class="row">
		<!--============================== Menu START ==============================-->
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="menu">
			<?php 
				$active = 'product';
			 ?>
			<div class="menu">
				<div id="user_panel">
					<img src="<?php echo base_url().'public/img/avatar/a.png' ?>" width="50px" height="50px">
					<div id="profile"><span id="edit_user" class="glyphicon glyphicon-pencil"></span></div>
					<div id="user_name">Huỳnh Tuấn Vũ</div>
					<div id="online"><img  style="margin-right:3px; padding-top:3px;" src="<?php echo base_url().'public/icon/online.png' ?>">Online</div>
				</div>

				<div id="fm_search">
					<form action="<?php echo base_url().'admin/search' ?>" method="get" class="sidebar-form">
						<div class="input-group">
							<input name="key" value="<?php if (isset($_GET['key'])) echo $_GET['key']; ?>" id="input_search" class="form-control" placeholder="Search..." type="text">
							<span class="input-group-btn">
								<button type="submit" id="search-btn" class="btn">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
				</div>

				<div id="title_dashboard">BẢNG ĐIỀU HƯỚNG</div>
				<a href="<?php echo base_url().'admin/product' ?>" class="action <?php if ($active == 'product') echo ' act_active';?>"><span class="glyphicon glyphicon-gift"></span> Quản lý sản phẩm</a>
				<a href="#" class="action"><span class="glyphicon glyphicon-shopping-cart"></span> Quản lý đơn hàng</a>
				<a href="#" class="action"><span class="glyphicon glyphicon-user"></span> Quản lý account</a>
				<a href="#" class="action"><span class="glyphicon glyphicon-envelope"></span> Hộp thư góp ý</a>
			</div>
		</div>
		<!--============================== Menu END ==============================-->

		<!--============================== Load content START ==============================-->
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<?php 
				$this->load->view($subView, $subData);
			?>
		</div>
		<!--============================== Load content END ==============================-->

	</div>
     
</body>
</html>


