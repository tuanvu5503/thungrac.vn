<?php
if (isset($account_info)) {
	$username 	= htmlspecialchars($account_info['username']);
	$email 		= htmlspecialchars($account_info['email']);
	$level 		= htmlspecialchars($account_info['level']);
	$avatar 	= htmlspecialchars($account_info['avatar']);
	$id 		= $account_info['id'];
}
?>

<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">CẬP NHẬT TÀI KHOẢN</legend>
	<form action="<?php echo base_url().'index.php/_admin/account/edit_account'; ?>" method="POST" enctype="multipart/form-data">
		<input name="id" type="hidden" value="<?php if (isset($re_id)) echo $re_id; elseif (isset($id)) echo $id;  ?>">
		
		<div class="form-group">
			<label for="username">Username</label>
			<input value="<?php if (isset($re_username)) echo $re_username; elseif (isset($username)) echo $username; ?>" name="username" required type="text" class="form-control" id="username" placeholder="Nhập username">
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input value="<?php if (isset($re_email)) echo $re_email; elseif (isset($email)) echo $email; ?>" name="email" required type="text" class="form-control" id="email" placeholder="Nhập email">
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input value="" name="password" type="password" class="form-control" id="password" placeholder="Nhập password">
		</div>

		<div class="form-group">
			<img width="100" src="<?php echo base_url().'public/img/avatar/'.$avatar; ?>" class="img-responsive" alt="Image">
			<label for="avatar">Ảnh đại diện</label>
			<input name="avatar" type="file" id="avatar">
		</div>

		<input style="margin-bottom:300px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_account_btn" value="Cập nhật">
    	<a style="margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="javascript:history.go(-1)" role="button">Hủy</a>
	</form>
</div>