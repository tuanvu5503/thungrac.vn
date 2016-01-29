<script src="<?php echo base_url().'public/js/admin/manage_site/slider/slider.js'?>"></script>
<?php 
	$delete_url = base_url()."index.php/_admin/manage_site/slider/delete_slider"; 
?>
<legend style="margin-top:50px; margin-bottom:30px; text-align:center;">QUẢN LÝ SLIDER HÌNH ẢNH</legend>

<form action="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider'; ?>" method="POST" enctype="multipart/form-data">
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="35%">Hình ảnh</th>
				<th width="50%">Mô tả</th>
				<th width="10%">Thao tác</th>
			</tr>
		</thead>
		<tbody id="add">
	        <?php 
	        if ( ! empty($slider_info)) {
	        	$i = 0;
	            foreach ($slider_info as $row) {
	            	$i ++;
	                ?>
	                <tr id="<?=$row['id']?>">
	                	<td><?=$i?></td>
	                    <td>
	                        <img width="100" src="<?php echo base_url().'public/img/slider/'.$row['link_slider']; ?>" class="img-responsive" alt="Image"> 
	                    </td>
	                    <td><?php echo htmlspecialchars($row['des_slider']); ?></td>
	                    <td>
							<a href="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider/'.$row['id']; ?>">
								<span class="icon_action glyphicon glyphicon-pencil"></span>
							</a>

							<a class="delete" onclick="delete_modal('<?= $delete_url ?>', <?= $row['id'] ?>,'del_acticle_success')">
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
	<a style="margin-bottom:200px; float:right; margin-right:50px;" class="btn btn-primary" href="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider'; ?>" role="button">Thêm ảnh vào slider</a>
</form>