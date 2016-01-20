


<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<h3 class="text-center">Quản lý bài viết</h3> 
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead style="background-color:#FF811A;">
			<tr>
				<th>#</th>
				<th>Tiêu đề bài viết</th>
				<th style="width:60%;">Nội dung</th>
				<th style="width:12%;">Thao tác</th>
				
			</tr>
		</thead>
		<tbody>
				<?php
					$stt=0;
					foreach ($all_acticle as $row) 
					{  
						$noidung = word_limiter($row['acticle_content'], 40);
						$stt++;  
						?>
						<tr id="<?=$row['id']?>" style="display:table-row;">
							<td><?=$stt?></td>
							<td><?=$row['acticle_name']?></td>
							<td><?=$noidung?></td>
							<td>
								<a href="<?php echo base_url().'index.php/_admin/acticle/view_acticle/'.$row['id']; ?>">
									<span style="font-size: 22px !important; padding-right: 10px !important;" class="glyphicon glyphicon-eye-open"></span>
								</a>

								<a href="<?php echo base_url().'index.php/_admin/product/edit/'.$row['id']; ?>">
									<span class="icon_action glyphicon glyphicon-pencil"></span>
								</a>

								<a class="delete" data-toggle="modal" data-id="<?php echo $row['id'] ?>" href='#modal_delete'>
									<span class="icon_action glyphicon glyphicon-trash"></span>
								</a>
							</td>
						</tr>
						<?php
					}
				?>
		</tbody>
	</table>
</div>
<a style="margin: 0 auto; margin-right:10px;" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/_admin/acticle/add_acticle" role="button">Thêm bài viết</a>
