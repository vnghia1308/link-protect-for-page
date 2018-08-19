<?php
/* >_ Developed by Vy Nghia */
error_reporting(0);
require_once 'login.php';

if(isset($accessToken)){	
	$link = new Protect;
	$link->fetchHash($db, $_GET['x']);
	$link->setCreatorID($URL['user']);
	$link->getUserInfo($accessToken);
	$link->setTargetID($URL['TargetID']);
	$link->ProtectAnalysis($accessToken);
		
	if(isset($URL['Password'])){
		if($URL['Password'] !== "")
		{
			$PasswordLocked = true;
			if(isset($_POST['password']))
			{
				if($_POST['password'] == $URL['Password'])
				{
					unset($PasswordLocked);
				}
			} 
			else 
			{
				$PasswordLocked = "wrong";
			}
		}
	}
		
	$q = mysqli_query($db, "select * from settings");
	$p = mysqli_fetch_array($q);
		
	$link->Check($db, $accessToken, $p["page_access_token"], $URL['Hash'], $URL['PostID'], $URL['tags_require'], $userID, $userName);
		
	if($FoundPost == true && $URL['PostID'] == 0)
		mysql_query("UPDATE `link` SET `PostID` = '$FoundPostID' WHERE `Hash` = '{$_GET['x']}'");
} else {
	$_SESSION['back'] = $_SERVER['REQUEST_URI'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta property="og:image" content="https://i.imgur.com/UUBhV34.jpg?1">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<base href="<?php echo WEBURL ?>" />
<meta name="description" content="<?php echo $description ?>">
<meta name="author" content="Photoshopvn.com">
<meta content="https://www.facebook.com/100015763034356" property="article:author" />
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:image" content="http://Link.photoshopvn.com/images/logo.png" />
<meta property="og:site_name" content="<?php echo $title ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:url" content="http://link.photoshopvn.com/" />
<meta property="fb:app_id" content="<?php $fbappid ?>" />
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
<div class="container">
<div class="row">
<!-- NULL -->
</div>

<!-- LOGO HERE -->
<div class="logo">
<!--<img class="repo" src="images/logo.png" />-->
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
<a href="/"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Trang chủ</li></a>
<a href="logout.php"><li class="btn btn-primary btn-round bttn-unite bttn-lg bttn-primary">Thoát</li></a>
</ul>
</div>
</div>
</nav>
<?php endif; ?>
</div>
<div class="row">
<div class="col-xs-12" style="text-align: center">
Chào, <a href="https://facebook.com/" target="_blanks"><strong><?php echo isset($userName) ? $userName : 'Bạn chưa đăng nhập'; ?></strong></a>
</div>
</div>
<div class="container">
<?php if(isset($accessToken)): ?>
<div class="row">
<div class="col-sm-3">
<div class="panel panel-primary">
<div class="panel-heading"><i class="fa fa-user-circle"></i> Người chia sẻ</div>
<ul class="list-group">
<a href="https://www.facebook.com/<?php echo $CreatorID ?>" target="_blanks"><li class="list-group-item" style="text-align: center;"><img src="https://graph.facebook.com/<?php echo $CreatorID ?>/picture?type=large&redirect=true&width=80&height=80" alt="<?php echo $CreatorID ?>" class="img-circle">
<div style="font-weight: bold;"><?php echo $CreatorName ?></div></li></a>
<li class="list-group-item" style="font-weight: bold; color: green">Bị báo cáo:</li>
<li class="list-group-item" style="color: gray"><i class="fa fa-bug"></i>Link Virus: 0 / 0 bài</li>
<li class="list-group-item" style="color: red"><i class="fa fa-minus-circle"></i>Spam: 0 / 0 bài</li>
</ul>
</div>
</div>
<div class="col-sm-9">
<div class="panel panel-primary">
<div class="panel-heading"><i class="fa fa-info-circle"></i> Thông tin chung</div>
<div class="panel-body">
<div class="row">
<div class="panel panel-default" style="margin-left: 10px; margin-right: 10px;">
<div class="panel-body" style="word-wrap: break-word">
<center><strong>Link bài viết gốc:</strong><br />
<a style="color: black; font-size: 17px;" <?php echo ($FoundPostURL !== null) ? 'href="'.$FoundPostURL.'"' : null;?> target="_blank" ><?php echo ($FoundPostURL !== null) ? $FoundPostURL : 'Link khóa này chưa được cập nhật link bài viết trong Page/Group';?></a></center>
</div>
</div>
<div class="col-xs-12">
<strong>Kiểm tra điều kiện mở khóa:</strong><br />
<?php // if($URL['tags_require'] == 1): ?>
<!-- <label class="checkbox ct-blue" for="checkbox1"><input type="checkbox" value="" data-toggle="checkbox" <?php echo (max($tagsCount, 0) == 0) ? 'checked' : 'unchecked'; ?>><?php echo (max($tagsCount, 0) == 0) ? 'Bạn đã hoàn thành gắn thẻ 3 người bạn' : 'Vui lòng gắn thẻ 3 người bạn vào liên kết bài viết trên (có thể cộng dồn)'; ?></label>-->
<?php if($Groups == true): ?>
<label class="checkbox ct-blue" for="checkbox1"><input type="checkbox" value="" data-toggle="checkbox" <?php echo ($Joined == true) ? 'checked' : null; ?>><?php echo ($Joined == true) ? 'Bạn đã là thành viên của nhóm' : 'Bạn chưa là thành viên của nhóm'; ?></label>
<?php else: ?>
<label class="checkbox ct-blue" for="checkbox1"><input type="checkbox" value="" data-toggle="checkbox" <?php echo ($FoundPost == true) ? 'checked' : null; ?>><?php echo (isset($FoundPost)) ? 'Đã xác nhận #hashtag của liên kết này' : 'Liên kết này chưa được gắn #hashtag'; ?></label>
<?php endif; ?>
<label class="checkbox ct-red" for="checkbox1"><input type="checkbox" value="" data-toggle="checkbox" <?php echo ($Liked == true) ? 'checked' : null; ?>><?php echo ($Liked == true) ? 'Bạn đã thích bài viết của liên kết này' : 'Bạn phải thích bài viết ở <b>Link bài gốc</b> mới có thể xem được nội dung'; ?></label>
<label class="checkbox ct-orange" for="checkbox1"><input type="checkbox" value="" data-toggle="checkbox" <?php echo (empty($PasswordLocked)) ? 'checked' : null; ?>><?php echo (empty($PasswordLocked)) ? 'Khóa mật khẩu - OK!' : 'Liên kết này có mật khẩu, hãy điền mật khẩu để mở khóa'; ?></label>
<?php if($PasswordLocked): ?>
<form action="" method="POST">
<div class="input-group">
<input type="text" name="password" class="form-control" placeholder="Vui lòng nhập mật khẩu">
<span class="input-group-btn">
<button class="btn btn-info btn-fill" type="submit"><i class="fa fa-unlock"></i> Mở khóa</button>
</span>
</div>
</form>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php else: ?>
<div class="row">
<div class="panel panel-primary">
<div class="panel-heading">Khóa nội dung</div>
<div class="panel-body">
<div class="col-xs-12" style="text-align: center">
<div id="status">Để tiếp tục sử dụng bạn vui lòng nhấn vào nút "<strong>kết nối</strong>".<br /><img src="assets/img/down.gif" /></div>
<center><a href="<?php echo $loginUrl ?>"><button id="btn-ketnoi" class="btn btn-primary btn-fill">Kết nối</button></a>
<br />
<br />
(Lưu ý: Nếu là lần đầu tiên sử dụng Ứng dụng sẽ yêu cầu quyền lấy thông tin cá nhận <strong>Công khai</strong> của bạn. Ứng dụng chỉ lấy những thông tin mà bạn công khai như <strong>Tên</strong> và <strong>ID</strong> để xác nhận. Ngoài ra <strong>không lấy bất cứ quyền nào</strong>, không lưu cookie hay token).</center>
</div>
</div>
</div>
</div>
<?php endif; ?>
<!-- Ads
<div class="panel panel-default">
<div class="panel-body">
<iframe data-aa='533838' src='//ad.a-ads.com/533838?size=990x90' scrolling='no' style='width:990px; height:90px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
<div id="qc" style="font-weight: bold; font-size: 17px;text-align: center;"></div>
</div>
</div> -->
<?php if(isset($FoundPost) && isset($Liked) && empty($PasswordLocked)): /* && max($tagsCount, 0) == 0) */ ?>
<div class="panel panel-primary">
<div class="panel-heading"><i class="fa fa-unlock"></i> Nội dung ẩn</div>
<div class="panel-body">
<div class="row">
<div class="col-xs-12">
<div class="panel panel-default">
<div class="panel-body" style="word-wrap: break-word">
<center><a style="color: black; font-size: 17px;" href="<?php echo $URL['Url'] ?>" target="_blank"><?php echo $URL['Url'] ?></a></center>
</div>
</div>
<br>
<br>
<span style="color: green; font-weight: bold;">Thông tin link:</span><br>
<span style="color: red; font-weight: bold;">- <i class="fa fa-bug"></i> Báo cáo Virus: </span>0 lần<br>
<span style="color: gray; font-weight: bold;">- <i class="fa fa-minus-circle"></i> Báo cáo Spam: </span>0 lần
</div>
</div>
</div>
</div>
<?php endif; ?>
<footer class="footer" style="font-size:12px;">
<p style="font-size:13px;">&copy; <?php echo date('Y'); ?> Vy Nghia</p>
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
