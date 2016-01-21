function  readURL(input,thumbimage) {
   if  (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
    var  reader = new FileReader();
    reader.onload = function (e) {
        $("#thumbimage").attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}
    else  { // Sử dụng cho IE
        $("#thumbimage").attr('src', input.value);

    }
    $("#thumbimage").show();
    $("div#boxchoice").hide();
    $('.filename').text($("#uploadfile").val());
    $('.Choicefile').css('cursor', 'default');
    $(".removeimg").show();
    $(".Choicefile").unbind('click'); //Xóa sự kiện  click trên nút .Choicefile

}
$(document).ready(function () {
   $(".Choicefile").bind('click', function  () { //Chọn file khi .Choicefile Click
    $("#uploadfile").click();

});
   $(".removeimg").click(function () {//Xóa hình  ảnh đang xem
    $("div#boxchoice").show();
    $("#thumbimage").attr('src', '').hide();
    $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
    $(".removeimg").hide();
      $(".Choicefile").bind('click', function  () {//Tạo lại sự kiện click để chọn file
        $("#uploadfile").click();
    });
      $('.Choicefile').css('cursor', 'pointer');
      $(".filename").text("");
  });


   //=====================================
   $("button.addmore").click(function(event) {
      $("#add").append("<tr><td><input type='file' name='detail_img[]'></td><td><button type='button' class='xoaanh btn btn-xs btn-default'>Xóa</button></td></tr>");
   });
    $('#add').on("click","button.xoaanh", function(event) {
      $(this).closest('tr').remove();
   });

  //========================================
  $("button.delete_detail_img").click(function(event) {
      id = $(this).attr('id');
      $("#hidden").append("<input value='"+id+"' type='text' name='delete_detail_img[]'>");
   });
})