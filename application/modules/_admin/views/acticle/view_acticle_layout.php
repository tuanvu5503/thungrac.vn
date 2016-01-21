<div class="page-header">
  <h2 class="text-center"><?= $acticle_info['acticle_name'] ?></h2>
</div>
<div class="acticle_content">
	<?php 
		echo $acticle_info['acticle_content'];
	?>
</div>

<a style="font-size: 20px; margin-bottom:300px; margin-top:100px; width:100px; float:right; margin-right:100px;" class="btn btn-info" href="<?php echo base_url().'index.php/_admin/acticle/show_acticle' ?>" role="button">
	<span style='font-size:20px; padding-right:5px;' class='glyphicon glyphicon-circle-arrow-left'></span>Trở về
</a>
