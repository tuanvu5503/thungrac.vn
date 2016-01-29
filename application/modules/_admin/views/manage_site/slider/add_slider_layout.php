<script src="<?php echo base_url().'public/js/admin/manage_site/slider/slider.js'?>"></script>

<legend style="margin-top:50px; margin-bottom:30px; text-align:center;">QUẢN LÝ SLIDER HÌNH ẢNH</legend>

<form action="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider'; ?>" method="POST" enctype="multipart/form-data">
	<div id="hidden"></div>
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
	                        <button id="<?=$row['id']?>" type="button" class="xoaanh btn btn-xs btn-default">Xóa</button>
	                    </td>
	                </tr>
	                <?php
	            }
	        }
	        ?>
	        <tr>
	            <td colspan="2">
	                <input type="file" name="add_slide[]">   
	            </td>
	            <td><textarea name="add_des_slider[]" id="inputAdd_des_slider[]" class="form-control" rows="3"></textarea></td>
	            <td>
	                <button type="button" class="delete_add_more_image btn btn-xs btn-default">Xóa</button>
	            </td>
	        </tr>
	        <tr>
	    </tbody>
	</table>
    <input style="margin-bottom:200px; float:right; margin-right:50px;" name="edit_slider_btn" class="btn btn-primary" type="submit" role="button" value ='Lưu thay đổi'>
    <button style="margin-bottom:200px; float:left;" onclick="add_more_slide()" type="button" class="btn btn-info">Thêm ảnh vào slider</button>  
</form>