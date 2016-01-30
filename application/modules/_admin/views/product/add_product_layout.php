<!--===================================== My CSS =====================================-->
<link href="<?php echo base_url().'public/css/admin/add_product.css' ?>" rel="stylesheet">
<!--===================================== My CSS =====================================-->

<!-- ===============================       MY JS         ======================== -->
<script src="<?php echo base_url().'public/js/admin/product/add_product.js'?>"></script>
<!-- ===============================       MY JS         ======================== -->

<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">Thêm mới sản phẩm</legend>
<form action="<?php echo base_url().'index.php/_admin/product/add_product' ?>" method="POST" enctype="multipart/form-data">
    <div class="wrap">
        <div id="avatar">
            <div id="myfileupload">
                <input type="file" id="uploadfile" name="avatar" onchange="readURL(this);" />
                <!--      Name  mà server request về sẽ là avatar-->
            </div>
            <div id="thumbbox">
                <img  width="100%" height="100%" alt="Thumb image" id="thumbimage" style="display: none;border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                <a class="removeimg" href="javascript:" ></a>
            </div>
            <div id="boxchoice"  style="display:block;">
                <a href="javascript:" class="Choicefile"><img width="100%" height="100%" src="<?php echo base_url().'public/img/avatar/noimage.jpg' ?>"></a>
                <p style="clear:both"></p>
            </div>
            <!-- <label class="filename"></label> -->
            
        </div>

        <div id="pro_name">
            <label for="name">TÊN SẢN PHẨM</label>
            <input required value="<?php if (isset($re_product_name)) echo $re_product_name; ?>" type="text" name="product_name" class="form-control add" id="name" placeholder="Nhập tên sản phẩm">
        </div>
        <div id="category">
            <label for="cate">LOẠI SẢN PHẨM</label>
            <select required name="category_id" id="cate" class="form-control add">
                <option value="">Chọn loại sản phẩm</option>
                <?php 
                    foreach ($category as $row) {
                        ?>
                        <option <?php if (isset($re_category_id) && $re_category_id == $row['id']) echo 'selected'; ?> value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['category_name']); ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div id="price">
            <label for="gia">GIÁ BÁN (VNĐ)</label>
            <input value="<?php if (isset($re_price)) echo $re_price;?>" name="price" type="text" class="form-control add" id="gia" placeholder="Nhập giá sản phẩm">
        </div>
        <div id="size"><label for="size">KÍCH THƯỚC</label>
            <input value="<?php if (isset($re_size)) echo htmlspecialchars($re_size); ?>" name="size" type="text" class="form-control add" id="size" placeholder="Kích thước">
        </div>
        <div id="substance">
            <label for="chatlieu">CHẤT LIỆU</label>
            <input value="<?php if (isset($re_substance)) echo htmlspecialchars($re_substance); ?>" name="substance" type="text" class="form-control add" id="chatlieu" placeholder="Chất liệu">
        </div>
        <div id="ribbon">
            <label for="ribbon">TEM DÁN</label>
            <input value="<?php if (isset($re_ribbon)) echo htmlspecialchars($re_ribbon); ?>" name="ribbon" type="text" class="form-control add" id="ribbon" placeholder="Tem: SALE, NEW..">
        </div>
        <div id="describe">
            <label for="mota">MÔ TẢ SẢN PHẨM</label>
            <textarea name="des" style="max-height:54%; max-width:100%;" id="mota" class="form-control add" placeholder="Mô tả chi tiết sản phẩm" rows="3"><?php if (isset($re_des)) echo $re_des; ?></textarea>
        </div>
    </div>

    <input value="Thêm" name="btnSubmit" style="margin-right:100px; margin-top:40px; font-size: 17px; width:100px; float:right;" type="submit" class="btn btn-primary">
    <a style="margin-top:40px; font-size: 17px; width:100px; float:right; margin-right:10px;" class="btn btn-info" href="<?php echo base_url().'index.php/_admin/product' ?>" role="button">
        <span style='font-size:20px; padding-right:5px;' class='glyphicon glyphicon-circle-arrow-left'></span>Trở về
    </a>

    <br>

    <table style="width:400px;" class="table">
        <tbody id="add">
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
    <button style="margin-bottom:300px;" id="0" type="button" class="addmore btn btn-info">Thêm ảnh chi tiết</button>  
</form>
