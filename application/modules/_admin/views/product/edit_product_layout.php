    <!--===================================== My CSS =====================================-->
	<link href="<?php echo base_url().'public/css/admin/edit_product.css' ?>" rel="stylesheet">
	<!--===================================== My CSS =====================================-->

	<!-- ===============================      MY JS         ======================== -->
	<script src="<?php echo base_url().'public/js/admin/product/edit_product.js'?>"></script>
	<!-- ===============================      MY JS         ======================== -->
         	
	<?php
		if (isset($info)) {
 		foreach ($info as $row) {
 			$id=$row['id'];
 			$category_id=$row['category_id'];
 			$price=$row['price'];
            $size= htmlspecialchars($row['size']);
 			$substance= htmlspecialchars($row['substance']);
 			$product_name = htmlspecialchars($row['product_name']);
 			$des = htmlspecialchars($row['des']);
            $image = htmlspecialchars($row['image']);
 			$ribbon = htmlspecialchars($row['ribbon']);
 			$detail_image = htmlspecialchars($row['detail_image']);
 		}
 	}
    ?>
<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">Cập nhật sản phẩm</legend>
<form action="<?php echo base_url().'index.php/_admin/product/doedit' ?>" method="POST" enctype="multipart/form-data">
    <div class="wrap">
        <div id="avatar">
            <div id="myfileupload">
                <input type="file" id="uploadfile" name="avatar" onchange="readURL(this);" />
                <!--      Name  mà server request về sẽ là avatar-->

            </div>
            <div id="thumbbox">
                <img height="100%" width="100%" alt="Thumb image" id="thumbimage" style="display: none;border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                <a class="removeimg" href="javascript:" ></a>
            </div>
            <div id="boxchoice"  style="display:block;">
                <a href="javascript:" class="Choicefile"><img width="100%" height="100%" src="<?php echo base_url().'public/img/products/'.$image ?>"></a>
                <p style="clear:both"></p>
            </div>
            <!-- <label class="filename"></label> -->
            
        </div>

        <div id="hidden">
            <input name="product_id" type="hidden" value="<?php if (isset($id)) echo $id; ?>">  
            <input name="page" type="hidden" value="<?php if (isset($re_page)) echo $re_page; elseif (isset($page)) echo $page; ?>">    
        </div>

        <div id="pro_name">
            <label for="product_name">TÊN SẢN PHẨM</label>
            <input required value="<?php if (isset($re_product_name)) echo $re_product_name; elseif (isset($product_name)) echo $product_name; ?>" type="text" name="product_name" class="form-control add" id="product_name" placeholder="Nhập tên sản phẩm">
        </div>
        <div id="category">
            <label for="cate">LOẠI SẢN PHẨM</label>
            <select required name="category_id" id="cate" class="form-control add">
                <option value="">Chọn loại sản phẩm</option>
                <?php 
                    foreach ($category as $row) {
                        ?>
                        <option <?php if (isset($re_category_id) && $re_category_id == $row['id']) echo 'selected'; elseif (isset($category_id) && $category_id == $row['id']) echo 'selected'; ?> value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['category_name']); ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div id="price">
            <label for="gia">GIÁ BÁN (VNĐ)</label>
            <input value="<?php if (isset($re_price)) echo $re_price; elseif (isset($price)) echo $price; ?>" name="price" type="text" class="form-control add" id="gia" placeholder="Nhập giá sản phẩm">
        </div>
        <div id="size"><label for="size">KÍCH THƯỚC</label>
            <input value="<?php if (isset($re_size)) echo $re_size; elseif (isset($size)) echo $size; ?>" name="size" type="text" class="form-control add" id="size" placeholder="Kích thước">
        </div>
        <div id="substance">
            <label for="chatlieu">CHẤT LIỆU</label>
            <input value="<?php if (isset($re_substance)) echo $re_substance; elseif (isset($substance)) echo $substance; ?>" name="substance" type="text" class="form-control add" id="chatlieu" placeholder="Chất liệu">
        </div>
        <div id="ribbon">
            <label for="ribbon">TEM DÁN</label>
            <input value="<?php if (isset($re_ribbon)) echo $re_ribbon; elseif (isset($ribbon)) echo $ribbon; ?>" name="ribbon" type="text" class="form-control add" id="ribbon" placeholder="Tem: SALE, NEW..">
        </div>
        <div id="describe">
            <label for="mota">MÔ TẢ SẢN PHẨM</label>
            <textarea name="des" style="max-height:54%; max-width:100%;" id="mota" class="form-control add" placeholder="Mô tả chi tiết sản phẩm" rows="3"><?php if (isset($re_des)) echo $re_des; elseif (isset($des)) echo $des; ?></textarea>
        </div>
    </div>
    <button name="btnSubmit" id="btnSubmit" type="submit" class="btn btn-success">Cập nhật</button>
    <?php if (isset($re_page)) $page= $re_page; ?>
    <a class="btn btn-danger" id="cancel" href="javascript:history.go(-1)" role="button">Hủy</a>
    <br>
    <table style="width:400px;" class="table">
        <tbody id="add">
            <?php 
            $info = explode('|', $detail_image); 
            if ($detail_image != '') {
                foreach ($info as $value) {
                    ?>
                    <tr>
                        <td>
                            <img width="100" src="<?php echo base_url().'public/img/detail_img/'.$value ?>" class="img-responsive" alt="Image"> 
                        </td>
                        <td>
                            <button id="<?php echo $value; ?>" type="button" class="delete_detail_img xoaanh btn btn-xs btn-default">Xóa</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td>
                    <input type="file" name="detail_img[]">   
                </td>
                <td>
                    <button type="button" class="xoaanh btn btn-xs btn-default">Xóa</button>
                </td>
            </tr>
            <tr>
        </tbody>
    </table>
    <button style="margin-bottom:200px;" id="0" type="button" class="addmore btn btn-info">Thêm ảnh chi tiết</button>  
</form>
