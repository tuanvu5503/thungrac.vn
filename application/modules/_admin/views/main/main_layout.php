<?php 
	if (!isset($_SESSION['user'])) {
        header("location:".base_url()."index.php/_admin/login/");
    }
?>
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
	<link href="<?php echo base_url().'public/bootstrap/css/bootstrap.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/admin/menu/menu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/admin/product.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/common/common.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/font-awesome/css/font-awesome.css' ?>" rel="stylesheet">
	<!--===================================== My CSS =====================================-->

	<!-- ===============================       MY JS         ======================== -->
	<script src="<?php echo base_url().'public/jquery/jquery.js'?>"></script>
	<script src="<?php echo base_url().'public/bootstrap/js/bootstrap.js'?>"></script>
	<script src="<?php echo base_url().'public/js/common/bootbox.js'?>"></script>
	<script src="<?php echo base_url().'public/js/common/common.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/menu/menu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/admin/main/header.js'?>"></script>
	<!-- ===============================      MY JS         ======================== -->

</head>
<body>
		<!--============================== Alert ==============================-->
		<div class="ajax_alert"></div>
		
		<?php 
			if (null !== $this->session->flashdata('status')) {
				$notice_data = $this->session->flashdata('status');

				$status = $notice_data['status'];
				$content_arr = (array) $notice_data['content'];
				$notice_time  =  $notice_data['alert_time'];

				?>
				<script type="text/javascript">
					var notice_time  =  <?= $notice_time ?>;
					var content_arr = <?php echo json_encode($content_arr); ?>;
					
					set_notice(<?= $status ?>,content_arr,notice_time);
				</script>
				<?php
			} 

			if (null !== $this->session->flashdata('auth')) {
				$notice_data = $this->session->flashdata('auth');

				$status = $notice_data['status'];
				$content = (array) $notice_data['content'];
				if ($status == 1) {
					$title = '<div style="font-size:18px; color: rgb(79, 180, 94);"><i style="color: rgb(33, 255, 0); font-size: 30px;" class="fa fa-check-square-o"></i> Thành công</div>';
				} else {
					$title = '<div style="font-size:18px; color:red;"><i style="color: rgb(255, 63, 0); font-size: 30px;" class="fa fa-times-circle"></i> Thất bại</div>';
				}

				?>
				<script type="text/javascript">
					var content = <?php echo json_encode($content); ?>;
					var title  =  '<?= $title ?>';
					
					set_alert(<?= $status ?>, title, content);
				</script>
				<?php
			}
		?>	
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
				$active = $this->uri->segment(3);
			 ?>
		<div class="menu">

				<div id="user_panel">
					<li id="logout" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php if ($_SESSION['user']['avatar'] != '') echo base_url().'public/img/avatar/'.$_SESSION['user']['avatar']; else echo base_url().'public/img/avatar/noimage.jpg'; ?>" width="50px" height="50px"></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url().'index.php/_admin/account/edit_account/'.$_SESSION['user']['id']; ?>">Chỉnh sửa</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url().'index.php/_admin/login/logout' ?>">Đăng xuất</a></li>
						</ul>
					</li>
					<div id="user_name"><?php echo $_SESSION['user']['username'];  ?></div>
					<div id="online"><img  style="margin-right:3px; padding-top:3px;" src="<?php echo base_url().'public/icon/online.png' ?>">Online</div>
					<!-- <div id="profile"><span id="edit_user" class="glyphicon glyphicon-pencil"></span></div> -->
				</div>

				<div id="fm_search">
					<form action="<?php echo base_url().'index.php/_admin/product/search_product' ?>" method="get" class="sidebar-form">
						<div class="input-group">
							<input name="key" value="<?php if (isset($_GET['key'])) echo $_GET['key']; ?>" id="input_search" class="form-control" placeholder="Tìm kiếm sản phẩm" type="text">
							<span class="input-group-btn">
								<button type="submit" id="search-btn" class="btn">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
				</div>

				<div id="title_dashboard">BẢNG ĐIỀU HƯỚNG</div>
				<ul class="nav panel-group nav-stacked" id="stacked-menu">

					<li class="menu_collapse <?php if ($this->uri->segment(2) == 'category') echo "menu_collapse_active"; ?>">
						<a data-target="#category" data-toggle="collapse" data-parent="#stacked-menu"><span class="glyphicon glyphicon-list-alt"></span> Quản lý danh mục <span class="caret arrow"></span></a>
					</li>
						<ul class="nav nav-stacked collapse left-submenu <?php if ($this->uri->segment(2) == 'category') echo "in"; ?>" id="category">
							<li class="action <?php if ($active == 'show_super_category') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/category/show_super_category' ?>"><i class="fa fa-angle-right"></i> Quản lý loại danh mục</a></li>
							<li class="action <?php if ($active == 'show_sub_category') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/category/show_sub_category' ?>"><i class="fa fa-angle-right"></i> Quản lý loại sản phẩm</a></li>
						</ul>

					<li class="menu_collapse <?php if ($this->uri->segment(2) == 'product') echo "menu_collapse_active"; ?>">
						<a data-target="#product" data-toggle="collapse" data-parent="#stacked-menu"><i class="fa fa-product-hunt"></i> Quản lý sản phẩm <span class="caret arrow"></span></a>
					</li>
						<ul class="nav nav-stacked collapse left-submenu <?php if ($this->uri->segment(2) == 'product') echo "in"; ?>" id="product">
							<li class="action <?php if ($this->uri->segment(2) == 'product' 
														&& ($this->uri->segment(3) == NULL || $this->uri->segment(3) == 'index')
													) echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/product' ?>"><i class="fa fa-angle-right"></i> Tất cả sản phẩm</a></li>
							
							<?php 
							if (isset($_SESSION['super_category'])) {
								$data = $_SESSION['super_category'];
								// print_r($data);
								foreach ($data as $item) {
									$item['super_categoryName'] = mb_strtolower($item['super_categoryName']);
									$item['super_categoryName'] = ucfirst($item['super_categoryName']);
									$item['super_categoryName'] = htmlspecialchars($item['super_categoryName']);
									?>
									<li class="action <?php if ($this->uri->segment(4) == $item['id']) echo ' act_active';?>">
										<a href="<?php echo base_url().'index.php/_admin/product/product_in_category/'.$item['id']; ?>"><i class="fa fa-angle-right"></i> <?= $item['super_categoryName'] ?></a>
									</li>
									<?php
								}
							}
							?>
						</ul>


					<li class="action <?php if ($this->uri->segment(2) == 'order') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/order/show_order' ?>" ><span class="glyphicon glyphicon-shopping-cart"></span> Quản lý đơn hàng</a></li>
					<li class="action <?php if ($this->uri->segment(2) == 'acticle') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/acticle/show_acticle' ?>" ><i class="fa fa-pencil-square-o"></i> Bài viết - Đăng tin</a></li>
					<!-- <li class="action <?php if ($this->uri->segment(2) == 'account') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/account/show_account' ?>" ><span class="glyphicon glyphicon-user"></span> Quản lý account</a></li> -->
					<li class="menu_collapse <?php if ($this->uri->segment(2) == 'manage_site') echo "menu_collapse_active"; ?>">
						<a data-target="#manage_site" data-toggle="collapse" data-parent="#stacked-menu"><i class="fa fa-desktop"></i> Giao diện website <span class="caret arrow"></span></a>
					</li>
						<ul class="nav nav-stacked collapse left-submenu <?php if ($this->uri->segment(2) == 'manage_site') echo "in"; ?>" id="manage_site">
							<li class="action <?php if ($this->uri->segment(3) == 'slider') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/manage_site/slider/show_slider' ?>"><i class="fa fa-angle-right"></i> Quản lý slider</a></li>
							<li class="action <?php if ($this->uri->segment(3) == 'contact') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/manage_site/contact/show_contact' ?>" ><i class="fa fa-angle-right"></i> Thông tin liên hệ</a></li>
							<!-- <li class="action <?php if ($active == 'show_sub_manage_site') echo ' act_active';?>"><a href="<?php echo base_url().'index.php/_admin/manage_site/show_sub_manage_site' ?>"><i class="fa fa-angle-right"></i> Quản lý loại sản phẩm</a></li> -->
						</ul>
				</ul>
			</div>
		</div>
		<!--============================== Menu END ==============================-->

		<!--============================== Load content START ==============================-->
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<?php 
				$subData = isset($subData) ? $subData : null;
				$this->load->view($subView, $subData);
			?>
		</div>
		<!--============================== Load content END ==============================-->

	</div>
     
</body>
</html>


