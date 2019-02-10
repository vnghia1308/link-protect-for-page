<?php
/* Developed by Vy Nghia */
session_start();
require_once '../config.php';
require_once 'admin_api.php';
require_once '../class/PseudoCrypt.php';

switch ($_GET['action']) {
	case 'create':
		if(isset($_SESSION['admin']) && isset($_SESSION['facebook_access_token']))
		{
			if(isset($_POST['link']))
			{
				
			$qr = mysqli_query($con, "select * from options");
			$op = mysqli_fetch_array($qr);

			$user = new Protect;
			$user->getUserInfo($_SESSION['facebook_access_token']);

			$EncodeLink = PseudoCrypt::hash(time(), 10);
			$LockedLink = WEBURL.'/x/'.$EncodeLink;
			$HashLink = '#protect@'.$EncodeLink.'@';
			
			$link = new CreateLink;
			
			if($op["google_short_link"] == 1)
			{
				$link->setGoogleApiKey($GoogleApiKey);

				$GoogleShortUrl = $link->getShortenedLink($LockedLink);
				
				$LinkProtect = $GoogleShortUrl;
			}
			else
				$LinkProtect = $LockedLink;
			
			$link->insertLink($con, $userID, $EncodeLink, $_POST['target'], $_POST['pass'], $_POST['link'], $LinkProtect, date("Y-m-d H:i:s"));
			}
		}
		break;

		case 'delete':
		if(isset($_POST['id']))
		{
			$link = new CreateLink;
			$link->deleteLink($con, $_POST['id']);
		}
		break;
}
?>
<br />
<div class="alert alert-info" style="color:blue" role="alert">
<strong>*Lưu ý:</strong><br>
- Khi post bài trong Group bạn phải kèm theo <span class="label label-danger">Hash của bài viết</span> Có thể để ở bất cứ đâu trong bài viết để tool có thể tự cập nhật link bài viết cho bạn.<br>
- Nếu link của bài viết không tự cập nhật. Bạn vui lòng vào mục <a href="catnhat.html" <span="" class="label label-danger">Cập nhật link</a> <a target="_blank" style="color:black" href="laylink.php">Xem cách lấy link bài viết</a><br>
- Nếu link bài viết không được cập nhật thì ngoài chức năng khóa mật khẩu các chức năng khác sẽ không hoạt động.
</div>
<strong>Link khóa &amp; Hash của bài viết:</strong>
<br/>
<div class="input-group">
<input id="linktonghop" class="form-control" value="<?php echo $LinkProtect.' | '.$HashLink; ?> " style="width: 100%"><br>
<span class="input-group-btn">
<button class="btn btn-info btn-fill" data-clipboard-target="#linktonghop">Copy</button>
</span>
</div>
