
<style type="text/css">
	table#order hr {
		margin-top: 0px !important;
		margin-bottom: 0px !important;
	}
</style> 
<?php 
	$url = base_url()."index.php/_admin/order/"; 
?>
  <legend style="margin-top:10px; margin-bottom:20px; text-align:center;">QUẢN LÝ ĐƠN HÀNG <?php if ($un_approval_order > 0) echo "<span style='padding:4px; font-size:18px; color:red;'>(<span id='un_approval_order'>".$un_approval_order."</span> chưa duyệt)</span>"; ?></legend>
	<table id="order" class="table table-hover table-bordered">
		<thead style="background-color:#FF811A;">
			<tr>
				<th>#</th>
				<th>Khách hàng</th>
				<th>Điện thoại</th>
				<th>Sản phẩm</th>
				<th>Đơn giá</th>
				<th width="20px">SL</th>
				<th>Thành tiền</th>
				<th>Tổng cộng</th>
				<th width="30px">Ngày đặt</th>
				<th>Trạng thái</th>
				<th>Xóa</th>
			</tr>
		</thead>
		<tbody>
<?php 

$stt=0;
	foreach ($all_order as $row) 
	{
		$stt++;
		$total = 0;
		?>
			<tr id="tr-<?=$row['id']?>" <?php if($row['status']=='0') echo "class='info'"; ?>>
				<td><?=$stt?></td>
				<td><?=$row['customer_name']?></td>
				<td><?=$row['phone']?></td>


				<?php 
				echo "<td>";
				$j=0;
				$num_row = count($row['product_name_and_qty']);
				foreach ($row['product_name_and_qty'] as $item) {
					$j++;
					echo htmlspecialchars($item['product_name']);
					if ($j < $num_row){
						echo "<hr>";
					}
				}
				echo "</td>";

				echo "<td style='text-align: right;'>";
				$j=0;
				foreach ($row['product_name_and_qty'] as $item) {
					$j++;
					echo number_format($item['price']);
					if ($j < $num_row){
						echo "<hr>";
					}
				}
				echo "</td>";

				echo "<td style='text-align: right;'>";
				$j=0;
				foreach ($row['product_name_and_qty'] as $item) {
					$j++;
					echo number_format($item['order_qty']);
					if ($j < $num_row){
						echo "<hr>";
					}
				}
				echo "</td>";

				echo "<td style='text-align: right;'>";
				$j=0;
				foreach ($row['product_name_and_qty'] as $item) {
					$j++;
					$sub_total = $item['order_qty']*$item['price'];
					echo number_format($sub_total);
					
					if ($j < $num_row){
						echo "<hr>";
					}
					$total += $sub_total;
				}
				echo "</td>";
				?>

				<td style='text-align: right;'><span style='font-weight:bold;'><?php echo number_format($total); ?></span></td>

				<?php 
					$date = new DateTime($row['order_datetime']);
				?>
				<td><?=$date->format('d-m-Y H:i:s')?></td>
				<td>
					<?php 
						if($row['status']=='1')
						{
							echo '<button disabled="disabled" type="button" class="btn btn-warning">Đã Duyệt</button>';

						}
						else
						{
							echo '<div id="'.$row['id'].'"> <button onclick="approve_order('.$row["id"].')" style="width:85px;" type="button" class="btn btn-primary">Duyệt</button></div>';
						}
					?>					
				</td>

				<td>
					<button class="btn btn-danger" onclick="delete_modal('<?= $url."delete_order" ?>', <?= $row['id'] ?>,'del_order_success')">Xóa</button>
				</td>
			</tr>
		<?php
	}
 ?>
		</tbody>
	</table>

<?php 
	echo $pagination;
?>

<script type="text/javascript">
	function del_order_success (del_id) {
		console.log(del_id);
		$("#tr-"+del_id).remove();
	}

	function approve_order(id) 
	{
		bootbox.confirm({
		    title: "<div style='color:red;'><i style='color:red;' class='fa fa-exclamation-triangle'></i> Chú ý</div>",
		    message: "Bạn có chắc chắn duyệt đơn hàng không?",
		    size: 'small',
		    buttons: {
		        cancel: {
		            label: "Không",
		            className: "btn-default pull-right button_of_delete_modal"
		        },
		        confirm: {
		            label: "Duyệt",
		            className: "btn-info pull-right button_of_delete_modal"
		        }
		    },
		    callback: function(result) {
		    	if (result) {
					$.ajax({
						url: "<?=$url.'approve_order'?>",
						type: 'post',
						dataType: 'json',
						data: {
							approval_id : id,
						},
						success: function (rs) {
							set_notice(rs.status, rs.mess, 7000);
							if (rs.status == SUCCESS_STATUS) {
								$("span#un_approval_order").html(rs.un_approval_order);

								$("div#"+id).html('<button disabled="disabled" type="button" class="btn btn-warning">Đã Duyệt</button>');
								$("tr#tr-"+id).removeClass('info');
							}
						}
					})
		    	}
		    }
		});
	}
</script>