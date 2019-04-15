<?php
/* >_ Developed by Vy Nghĩa */
session_start();
require_once 'SDK/Facebook/autoload.php';
require 'system/config.php';

$fb = new Facebook\Facebook([
  'app_id' => (string) $FacebookAppID,
  'app_secret' => (string) $FacebookAppSecret,
  'default_graph_version' => 'v2.10',
  ]);
  

$helper = $fb->getRedirectLoginHelper();
$permissions = ['public_profile']; //optional

try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();

  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	;
 }

if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		$url = str_replace("///", "/", WEBURL . "{$_SESSION['back']}");
		header("Location: $url");
		unset($_SESSION['back']);
	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		session_destroy();
		// redirecting user back to app login page
		echo '<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	} else {
	$loginUrl = $helper->getLoginUrl(WEBURL.'/login.php', $permissions);
}
?>
