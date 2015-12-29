<!doctype html>
<html lang="en-US">
<head>
   <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url().'public/css/site/Auth/styles.css'; ?>">
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url().'public/css/site/Auth/progression.min.css'; ?>">
  <script type="text/javascript" src="<?php echo base_url().'public/js/site/Auth/progression.min.js'; ?>"></script>
</head>

<body>

  <div id="w">
    <div id="content">
      <h1>Đăng ký tài khoản</h1>
      
      <form id="registerform" method="post" action="<?php echo base_url().'index.php/site/auth/regist_account' ?>">
        <div class="formrow">
          <label for="username">Tên đăng nhập</label>
          <input data-progression="" type="text" name="username" id="username" class="basetxt" tabindex="1" data-helper="Nhập ít nhất 6 ký tự">
          <p class="errmsg">Username không hợp lệ!</p>
        </div>
        
        <div class="formrow">
          <label for="email">Email</label>
          <input data-progression="" type="email" name="email" id="email" class="basetxt" tabindex="2" data-helper="Nhập địa chỉ email của bạn!">
          <p class="errmsg">Email không hợp lệ!</p>
        </div>

         <div class="formrow">
          <label for="phone">Số điện thoại</label>
          <input data-progression="" type="text" name="phone" id="phone" class="basetxt" tabindex="2" data-helper="Nhập số điện thoại của bạn!">
          <p class="errmsg">Số điện thoại không đúng!</p>
        </div>
        
        <div class="formrow">
          <label for="password1">Mật khẩu</label>
          <input data-progression="" type="password" name="password1" id="password1" class="basetxt" tabindex="3" data-helper="Nhập mật khẩu!">
        </div>
        
        <div class="formrow">
          <label for="password2">Nhập lại mật khẩu</label>
          <input data-progression="" type="password" name="password2" id="password2" class="basetxt" tabindex="4" data-helper="Nhập lại mật khẩu!">
          <p class="errmsg">Mật khẩu không khớp nhau!</p>
        </div>
        
        <input type="submit" name="registion_button" id="submitformbtn" class="submitbtn" value="Đăng ký">
      </form>
    </div><!-- @end #content -->
  </div><!-- @end #w -->
    
    
<script type="text/javascript">
$(function(){
  $("#registerform").progression({
    tooltipWidth: '200',
    tooltipPosition: 'right',
    tooltipOffset: '0',
    showProgressBar: false,
    showHelper: true,
    tooltipFontSize: '14',
    tooltipFontColor: 'fff',
    progressBarBackground: 'fff',
    progressBarColor: '7ea2de',
    tooltipBackgroundColor: 'a5bce5',
    tooltipPadding: '7',
    tooltipAnimate: true
  }).submit(function(e){
    // e.preventDefault();
  });
  
  $('#username').on('blur', function(){
    var currval = $(this).val();
    
    if(currval.length < 6) {
      $(this).next('.errmsg').slideDown();
    } else {
      // the username is 6 or more characters and we hide the error
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#email').on('blur', function(){
    // email regex source http://stackoverflow.com/a/17968929/477958
    var mailval = $(this).val();
    
    var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    if(!pattern.test(mailval)) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });

  $('#phone').on('blur', function(){
    var phone_val = $(this).val();
    
    var pattern = new RegExp(/^[0-9]{9,11}$/);
    if(!pattern.test(phone_val)) {
      $(this).next('.errmsg').slideDown();
    } else {
      $(this).next('.errmsg').slideUp();
    }
  });
  
  $('#password2').on('blur', function(){
    var pwone = $('#password1').val();
    var pwtwo = $(this).val();
    
    if(pwtwo.length < 1 || pwone != pwtwo) {
      $(this).next('.errmsg').slideDown();
    } else if(pwone == pwtwo) {
      // both passwords match and we hide the error
      $(this).next('.errmsg').slideUp();
    }
  });
});
</script>
</body>
</html>