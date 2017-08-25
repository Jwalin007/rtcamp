<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '832614510246150',
  'app_secret' => '39cebcb5e281888a77de8254e7df0752',
  'default_graph_version' => 'v2.10',
  ]);

$_SESSION['fb'] = $fb;
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_photos']; // optional
	
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
  	exit;
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
		//header('Location: ./');
	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=id,name,first_name,last_name,email,albums');
		$profile = $profile_request->getGraphNode()->asArray();
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		//header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	
	// getting all photos of user
	try {
		$photos_request = $fb->get('/me/photos?limit=100&type=uploaded');
		$photos = $photos_request->getGraphEdge();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	$all_photos = array();
	if ($fb->next($photos)) {
		$photos_array = $photos->asArray();
		$all_photos = array_merge($photos_array, $all_photos);
		while ($photos = $fb->next($photos)) {
			$photos_array = $photos->asArray();
			$all_photos = array_merge($photos_array, $all_photos);
		}
	} else {
		$photos_array = $photos->asArray();
		$all_photos = array_merge($photos_array, $all_photos);
	}
	$_SESSION['photos'] = $all_photos;
	$_SESSION['FBID'] = $profile["id"];
	$_SESSION['FULLNAME'] = $profile["first_name"];
	$_SESSION['logged'] = "1";
	header('Location: http://ec2-13-59-209-88.us-east-2.compute.amazonaws.com/rtcamp/index.php');
  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	$loginUrl = $helper->getLoginUrl('http://ec2-13-59-209-88.us-east-2.compute.amazonaws.com/rtcamp/fbconfig.php', $permissions);
	header("Location: $loginUrl"); 
}

