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
	<!-- ===============================      MY JS         ======================== -->

</head>
<body>
		<div class="col-xs-10  col-sm-10  col-md-10  col-lg-10 ">

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

        <legend style="margin-top:50px; margin-bottom:50px; text-align:center;">DANH MỤC SẢN PHẨM</legend>
			<table style="margin-top:50px;" class="table table-striped table-hover">
				<thead>
					<tr>
						<th style="text-align:center;">#</th>
						<th style="text-align:center;">Hình đại diện</th>
						<th style="text-align:center;">Tên sản phẩm</th>
						<th style="text-align:center;">Loại sản phẩm</th>
						<th style="text-align:center;">Giá</th>
						<th style="text-align:center;">Số lượng</th>
						<th style="text-align:center;">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if (count($all_pro) == 0) {
						?>
							<!-- NO DATA -->
							<tr style="text-align:center;" class="warning">
								<td colspan="7">
									<h2 class="text-center">Không tìm thấy sản phẩm nào!</h2>
								</td>
							</tr>
						<?php
					} else {
						$page = isset($_GET['page']) ? $_GET['page'] : 1;
						$stt= ($page * 5) - 5; 
						foreach ($all_pro as $row) {
							$stt++;
							?>
							<tr style="text-align:center;" id="<?php echo $row['id'] ?>">
								<td><?php echo $stt ?></td>
								<td><img style="margin: 0 auto;" width="70px" src="<?php echo base_url().'public/img/products/'.$row['image'] ?>" class="img-responsive" alt="Image"></td>
								<td><?php echo htmlspecialchars($row['product_name']); ?></td>
								<td><?php echo htmlspecialchars($row['category_name']) ?></td>
								<td style="text-align:right;"><?php echo number_format($row['price']).'$' ?></td>
								<td><?php echo number_format($row['qty']) ?></td>
								<td>
									<a href="<?php echo base_url().'admin/product/edit/'.$row['id'].'/'.$page; ?>">
										<span class="icon_action glyphicon glyphicon-pencil"></span>
									</a>
									<a class="delete" data-toggle="modal" data-id="<?php echo $row['id'] ?>" href='#modal_delete'>
										<span class="icon_action glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>

							<?php
						}
					}
					?>
				</tbody>
			</table>
			<a style="float:left; margin-top:20px;" class="btn btn-primary" href="<?php echo base_url().'admin/product/add' ?>" role="button">THÊM SẢN PHẨM</a>
			<?php 
        		echo $pagination;
			?>
		</div>

		<script type="text/javascript">
			$("a.delete").click(function(event) {
				var id = $(this).data('id');
				$("input#del_id").val(id);
			});
			$("button.delete").click(function(event) {
				$('#modal_delete').modal('hide');
				del_id = $("input#del_id").val();
				$.ajax({
					url: '<?php echo base_url()."admin/product/del_product"?>',
					type: 'POST',
					dataType: 'json',
					data: 
					{
						del_id: del_id
					},
					success: function(msg){
						if (msg.status)
		                {
		                    $.cookie('success','Xóa sản phẩm '+msg.product_name+' thành công');
		                    setAlert('success');
		                    $("tr#"+del_id).addClass('remove');
		                } 
					}
				});

			});
		</script>

</body>
</html>


