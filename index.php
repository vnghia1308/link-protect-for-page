<?php
require_once 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="theme-color" content="#3498db">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?php echo $title ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?php echo $domain ?>" />
<meta name="description" content="<?php echo $description ?>">
<meta name="author" content="Vy Nghia">
<meta content="100015763034356" property="fb:admins" />
<meta content="https://www.facebook.com/100015763034356" property="article:author" />

<!-- Social meta --> 
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:image" content="https://nghia.org/assets/img/web/thumbnail.jpg" />
<meta property="og:site_name" content="<?php echo $title ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:url" content="http://nghia.org/" />
<meta property="fb:app_id" content="<?php $fbappid ?>" />

<!-- CSS Lib -->
<link href="bootstrap3/css/bootstrap.css?v=1.2" rel="stylesheet" />
<link href="assets/css/gsdk.css?v=1.2" rel="stylesheet" />
<link href="assets/css/styles.css" rel="stylesheet" />
<link href="assets/css/bttn.min.css?v=1.2" rel="stylesheet" />
<link href="css/css.css?v=1.5" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-wysihtml5.css"></link>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
<div class="row"><!-- NULL --></div>
<div class="container">
<div class="logo">
<!--<img class="repo" src="images/logo_anlink.top.png" />-->
</div>
<?php if(isset($accessToken)): ?>
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
<li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary"><a href="/">Trang chủ</a></li>
<li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary"><a href="logout.php">Thoát</a></li>
</ul>
</div>
</div>
</nav>
<?php endif; ?>
</div>
<div class="row">
<div class="col-xs-12" style="text-align: center">
Chào, <a href="https://facebook.com/" target="_blanks"><strong><?php echo isset($profile['name']) ? $profile['name'] : 'Bạn chưa đăng nhập'; ?></strong></a>
</div>
</div>
<div class="container">
<div class="panel panel-primary">
<div class="panel-heading">Khóa nội dung</div>
<div class="panel-body">
<div class="row">

<div class="col-xs-12" style="text-align: center">
<?php if(empty($accessToken)): ?>
<div id="status">Để tiếp tục sử dụng bạn vui lòng nhấn vào nút "<strong>kết nối</strong>".<br /><img src="assets/img/down.gif" /></div>
<center><a href="<?php echo $loginUrl ?>"><button id="btn-ketnoi" class="btn btn-primary btn-fill">Kết nối</button></a>
<br />
<br />
(Lưu ý: Nếu là lần đầu tiên sử dụng Ứng dụng sẽ yêu cầu quyền lấy thông tin cá nhận <strong>Công khai</strong> của bạn. Ứng dụng chỉ lấy những thông tin mà bạn công khai như <strong>Tên</strong> và <strong>ID</strong> để xác nhận. Ngoài ra <strong>không lấy bất cứ quyền nào</strong>, không lưu cookie hay token).</center>
<?php else: ?>
<div id="status">Nhìn ở trên và nhấn vào 1 điều bạn cần</div>
<?php endif; ?>
</div>
</div>
</div>
</div>
<!-- Ads
<div class="panel panel-default">
<div class="panel-body">
<iframe data-aa='533838' src='//ad.a-ads.com/533838?size=990x90' scrolling='no' style='width:990px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
<div id="qc" style="font-weight: bold; font-size: 17px;text-align: center;"></div>
</div>
</div> -->
<footer class="footer" style="font-size:12px;">
<p style="font-size:13px;">&copy; <?php echo date('Y').' '.$copyright; ?></p>
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
</body>
</html>
