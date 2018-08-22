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
<div class="panel-heading"><?php
if (isset($_GET['page'])) {
  switch ($_GET['page']) {
    case '/role/':
      echo 'Thêm & chỉnh sửa quản trị viên';
      break;
    case '/page/':
      echo 'Thiết đặt Trang';
      break;
    case '/link/':
      echo 'Quản lý liên kết';
      break;
    case '/protect/':
      echo 'Khóa liên kết';
      break;
	case '/options/':
	  echo 'Tùy chọn hệ thống';
	  break;
    case '/content/':
      echo 'Nội dung';
      break;
    }
} else {
  echo 'Trang chủ liên kết';
}
?></div>
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
	if(empty($_GET['page']))
	{
		echo '<center>Chào mừng bạn đến trang admin, bạn muốn làm gì?<center>';
	}
	else
	{
		switch($_GET['page'])
		{
			/* Add & Change admin */
			case '/role/':
				include __DIR__ . "/path/role";
			break;
			/* Settings page */
			case '/page/':
				include __DIR__ . "/path/page";
			break;
			/* Upload ads on website */
			case '/ads/':
				if($Level == 1)
					include __DIR__ . "/path/ads";
				else
				  echo 'Bạn không có quyền thực hiện tác vụ với trang này!';
			break;
			/* Manage link list */
			case '/link/':
				include __DIR__ . "/path/link";
			break;
			/* Web Content Settings */
			case '/content/':
				$WebST = mysqli_query($db, "SELECT * FROM `web`");
				$web = mysqli_fetch_array($WebST);

				if($Level == 1)
					include __DIR__ . "/path/web";
				else
				  echo "Chỉ quản trị viên mới có thể truy cập trang này!";
			break;
			/* Genarator Link Protect */
			case '/protect/':
				include __DIR__ . "/path/protect";
			break;
			/* Website options */
			case '/options/':
				if($Level == 1)
					include __DIR__ . "/path/options";
				else
					echo "Chỉ quản trị viên mới có thể truy cập trang này!";
			break;
		}
	}
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
		$("#adminAdd").on('submit',(function(e) {
			e.preventDefault();
			if($("input[name='role']:checked").val() == 1)
				var roles = 'Administrator';
			else
				var roles = 'Moderator';

			if(!$('#username').val() || !$('#password').val()){
				$('#LoginStatus').html('<div class="alert alert-warning"><strong>Hệ thống cảnh báo!</strong> Vui lòng nhập đủ thông ở trên và thử lại!</div>')
			} else {
				$.ajax({
				method: 'POST',
				url: 'system/data/admin_action.php?action=add',
				data: new FormData(this),
				dataType: "json",
				contentType: false,
				cache: false,
    			processData:false,
				beforeSend: function () {
					$("#loading").show()
				},
				success: function (r) {
						if(r.code == 1){
							$('#Status').html('<div class="alert alert-success"><strong>Thêm thành công!</strong> Tài khoản đã được thêm vào cơ sở dữ liệu ....</div>')
							$('#adminTBresult').prepend('<tr id="user-' + r.id +'">'+
			'<td>'+ r.name +'</td>'+
			'<td>'+ $('#username').val() +'</td>'+
			'<td>'+ $('#password').val() +'</td>'+
			'<td>'+ roles +'</td>'+
			'<td><center><a id="delete" data-user="'+ $('#username').val() +'" style="cursor:pointer"><i class="fa fa-trash" aria-hidden="true"></i></a></center></td></td>'+
		  '</tr>')
						} else {
							$('#Status').html('<div class="alert alert-danger"><strong>Không thể thêm!</strong> Tài khoản này đã tồn tại trong cơ sở dữ liệu!</div>')
						}
					},
				complete: function(){
					$("#loading").hide()
				}
				});
			}

		}));

    $("#protect").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				method: 'POST',
				url: 'system/data/admin_link.php?action=create',
				data: new FormData(this),
				contentType: false,
					cache: false,
					processData:false,
				beforeSend: function () {
					$("#loading").show()
				},
				success: function (data) {
					$("#ketqua").html(data);
				},
				complete: function(){
					$("#loading").hide()
				}
			});

		}));
		
	$("#contentWeb").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "system/data/admin_update.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$("#loading").show()
			},
			success: function (data) {
				$("#loading").hide()
			},
			complete: function(){
				$("#loading").hide()
			}
	   });
	}));
		
	$(function(){
		$('#updateAdmin').on('click',function(){
			var name = $('#name').val()
			var pass = $('#pass').val()
			$.ajax({
			method: 'POST',
			url: 'system/data/admin_change.php',
			data: { name: name, pass: pass},
			beforeSend: function () {
				$("#loading").show()
			},
			success: function (data) {
				$("#adminName").html("<strong>" + name + "</strong>")
				swal(
				'Đã thay đổi!',
				'Thông tin quản trị viên đã được thay đổi!',
				'success'
			  )
			  console.log(data);
			},
			complete: function(){
				$("#loading").hide()
			}
			});
		});
	});


  //Delete user
  $(function(){
		$('#adminTBresult').on('click', '#delete' ,function(event){
			let $this = $(this);
			let id = $this.data('id');
			let user = $this.data('user');
			
			swal({
			  title: 'Bạn chắc chắn điều này?',
			  text: "Có thật bạn muốn xóa tài khoản này? Điều này khi hoàn thành sẽ không thể hoàn tác!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Vâng, xóa nó!',
			  cancelButtonText: 'Hủy'
			}).then(function () {
				$.ajax({
				method: 'POST',
				url: 'system/data/admin_action.php?action=delete',
				data: { user: user },
				beforeSend: function () {
					$("#loading").show()
				},
				success: function (data) {
					swal(
						'Đã xóa!',
						'Tài khoản này đã được xóa!',
						'success'
					  )
					remove($this)
				},
				complete: function(){
					$("#loading").hide()
				}
				});
			})
		});
  });
  
  function remove(e)
  {
	  $(e).closest("tr").remove()
  }
  
  /* Options starts */
  function GGSLinkOptions(){
	  var r = $('input[name=slink]:checked', '#GoogleShortLink').val()
	  switch(r)
	  {
		  case "1":
			r = 0
			break;
		  case "0":
			r = 1
			break;
	  }
	  
	  $.ajax({
		method: 'POST',
		url: 'system/data/admin_options.php?opt=google_short_link',
		data: {
			v: r
		},
		beforeSend: function () {
			$("#loading").show()
		},
		success: function (data) {
			$("#updated_status").show()
			
			setTimeout(function(){
				$("#updated_status").hide()
			}, 1500)
		},
		complete: function(){
			$("#loading").hide()
		}
		});
  }
  
  function AdminSecurityOptions(){
	  var r = $('input[name=adminscrt]:checked', '#GoogleShortLink').val()
	  switch(r)
	  {
		  case "1":
			r = 0
			break;
		  case "0":
			r = 1
			break;
	  }
	  
	  $.ajax({
		method: 'POST',
		url: 'system/data/admin_options.php?opt=admin_security',
		data: {
			v: r
		},
		beforeSend: function () {
			$("#loading").show()
		},
		success: function (data) {
			$("#updated_status").show()
			
			setTimeout(function(){
				$("#updated_status").hide()
			}, 1500)
		},
		complete: function(){
			$("#loading").hide()
		}
		});
  }
  /* Options ends */
  
  /* Settings page starts */
  $("#loginAccessToken").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			method: 'POST',
			url: 'public/api/v1/facebook/buildLogin.php',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function () {
				$("#loading").show()
			},
			success: function (s) {
				$("#loginResult").show()
				$("#redirectConfirm").attr("href", s)
			},
			complete: function(){
				$("#loading").hide()
			}
		});
	}));
	
	$("#confirmAccessToken").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			method: 'GET',
			url: 'https://graph.facebook.com/me/accounts',
			dataType: "json",
			data: {
				access_token: $("#access_token").val()
			},
			beforeSend: function () {
				$("#loading").show()
			},
			success: function (c) {
				saveToken($("#access_token").val())
				$("#pageList").html("")
				c.data.forEach(function(e){
					$("#pageList").prepend('<div class="form-check">' +
	  '<input class="form-check-input" type="radio" name="page" value="' + e.id + '|' + e.access_token +'">' +
	  '<label class="form-check-label" for="page">&nbsp;' +
		e.name +
	  '</label>' +
	'</div>')
				})
			},
			complete: function(){
				$("#loading").hide()
			}
		});
	}));
	
	$('#loginJson').on('paste', function () {
		setTimeout(function () {
			var t = $('#loginJson').val()
		
			$.ajax({
				method: 'POST',
				url: 'public/api/v1/facebook/parseLogin.php',
				data: {
					j: t
				},
				dataType: "json",
				beforeSend: function () {
					$("#loading").show()
				},
				success: function (j) {
					console.log(j)
					
					if(j.error == false)
						$("#access_token").val(j.message)
					else
					{
						$("#loginJson").val(j.message).select()
					}
				},
				complete: function(){
					$("#loading").hide()
				}
			});
		}, 100);
	});
	
	$("#ShowHidenLogin").on("click", "#showLogin", function(){
		$("#showLogin").text("[Nhấn ẩn] Đăng nhập bằng Facebook để lấy access_token").attr("id", "hideLogin")
		$("#LoginWithFacebook").show()
	})
	
	$("#ShowHidenLogin").on("click", "#hideLogin", function(){
		$("#hideLogin").text("[Nhấn hiện] Đăng nhập bằng Facebook để lấy access_token").attr("id", "showLogin")
		$("#LoginWithFacebook").hide()
	})
	
	$("#pageList").on("change", "input[name=page]", function(){
		console.log($("input[name=page]:checked").val())
		
		$.ajax({
			method: 'POST',
			url: 'system/data/admin_page.php',
			data: {
				page: $("input[name=page]:checked").val()
			},
			beforeSend: function () {
				$("#loading").show()
			},
			success: function (j) {
				if($("#defaultPage").text() != "")
				{
					$("#defaultPage").text("Bạn đã thay đổi trang mặc định, vui lòng tải lại trang để cập nhật!")
				}
				$("#pageStatus").show()
					
				setTimeout(function(){
					$("#pageStatus").hide()
				}, 2000)
			},
			complete: function(){
				$("#loading").hide()
			}
		});
	})
	
	function saveToken(t){
		$.ajax({
			method: 'POST',
			url: 'system/data/admin_token.php',
			data: {
				token: t
			},
			beforeSend: function () {
				$("#loading").show()
			},
			complete: function(){
				$("#loading").hide()
			}
		});
	}
 
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
