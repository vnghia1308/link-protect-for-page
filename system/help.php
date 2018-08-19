<?php
/* >_ Developed by Vy Nghĩa */
session_start();
require "admin_login_fb.php"; //include config.php
require 'data/admin_info.php';

if(isset($_SESSION['admin']))
{
	$checksession = mysqli_query($db, "SELECT * FROM `manager` WHERE `username` = '{$_SESSION['admin']}'");
	$admins = mysqli_fetch_array($checksession);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Link Protect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?php echo WEBURL ?>" />
<meta name="author" content="Vy Nghia">
<meta property="og:title" content="Link Protect" />
<meta property="og:image" content="http://domain.com/logo.png" />
<meta property="og:site_name" content="Link Protect" />
<meta property="og:url" content="<?php echo WEBURL ?>" />
<link href="bootstrap3/css/bootstrap.css?v=1.2" rel="stylesheet" />
<link href="assets/css/gsdk.css?v=1.2" rel="stylesheet" />
<link href="assets/css/styles.css" rel="stylesheet" />
<link href="assets/css/bttn.min.css?v=1.2" rel="stylesheet" />
<link href="css/css.css?v=1.5" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-wysihtml5.css"></link>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="row"><!-- NULL --></div>
<div class="container">
<div class="logo">
<!--<img class="repo" src="images/logo_anlink.top.png" />-->
</div>
<?php if(isset($_SESSION['admin'])): ?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div id="navbar1" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<a href="system/admin?page=/role/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Quản trị viên</li></a>
<a href="system/admin?page=/page/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Thiết đặt Trang</li></a>
<a href="system/admin?page=/link/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Quản lý liên kết</li></a>
<a href="system/admin?page=/protect/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Tạo liên kết</li></a>
<a href="system/admin?page=/options/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Tùy chọn hệ thống</li></a>
<a href="system/admin?page=/content/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Nội dung</li></a>
<a href="system/help"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Hổ trợ</li></a>
<a href="system/logout.php"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Thoát</li></a>
</ul>
</div>
</div>
</nav>
<?php endif; ?>
</div>
<div class="row">
<div class="col-xs-12" style="text-align: center">
Chào, <a><text id="adminName"><strong><?php echo isset($Name) ? $Name : 'Bạn chưa đăng nhập'; ?></strong></text></a>
</div>
</div>
<div class="container">
<div class="panel panel-primary">
<div class="panel-heading">Tài liệu giúp đỡ</div>
<div class="panel-body">
<div class="row">
<div class="col-xs-12">
<?php 
/* Admin login */
if(empty($_SESSION['admin']))
{
	include __DIR__ . "/path/login";
}
else
{
	echo "Will update coming soon!";
}
?>
</div>
</div>
</div>
</div>
<footer class="footer" style="font-size:12px;">
<p style="font-size:13px;">&copy; 2017 Vy Nghia</p>
</footer>
<div id="loading">
<img src="assets/img/load2.gif" /><br />
<strong>Loading...</strong>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="assets/js/gsdk-checkbox.js"></script>
<script src="assets/js/gsdk-radio.js"></script>
<script src="assets/js/gsdk-bootstrapswitch.js"></script>
<script src="assets/js/get-shit-done.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="assets/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/bootstrap-wysihtml5.js?v=1507225806"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
<script>
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$(".btn").click();
		}
	});
	var clipboard = new Clipboard('.btn');
		
	<?php if(isset($_SESSION['admin'])): ?>
		
	<?php else: ?>
	$("#login").on('submit',(function(e) {
			e.preventDefault();
			if(!$('#username').val() || !$('#password').val()){
				$('#LoginStatus').html('<div class="alert alert-warning"><strong>Lỗi đăng nhập!</strong> Vui lòng nhập đủ thông tin đăng nhập và thử lại!</div>')
			} else {
				$.ajax({
				method: 'POST',
				url: 'system/data/admin_login.php',
				data: new FormData(this),
				contentType: false,
				cache: false,
    			processData:false,
				beforeSend: function () {
					$("#loading").show()
				},
				success: function (data) {
						if(data == 1){
							$('#LoginStatus').html('<div class="alert alert-success"><strong>Đăng nhập thành công!</strong> Đâng thực thi đăng nhập ....</div>')
							location.reload();
						} else if(data == 2){
							$('#LoginStatus').html('<div class="alert alert-danger"><strong>Lỗi đăng nhập!</strong> Tài khoản không tồn tại, vui lòng thử lại!</div>')
						} else {
							$('#LoginStatus').html('<div class="alert alert-danger"><strong>Lỗi đăng nhập!</strong> Có lẽ bạn đã nhập sai mật khẩu, vui lòng thử lại!</div>')
						}
					},
				complete: function(){
					$("#loading").hide()
				}
				});
			}
		}));
		<?php endif; ?>
</script>
</body>
</html>
