<?php 
	session_start();
	require_once __DIR__ . '/src/Facebook/autoload.php';

	$fb = new Facebook\Facebook([
	  'app_id' => '832614510246150',
	  'app_secret' => '39cebcb5e281888a77de8254e7df0752',
	  'default_graph_version' => 'v2.10',
	  ]);
	$_SESSION['logged'] = NULL;
	$helper = $fb->getRedirectLoginHelper();
	$website = 'http://ec2-13-59-209-88.us-east-2.compute.amazonaws.com/rtcamp/index.php';
	$logout_url = $helper->getLogoutUrl($_SESSION['facebook_access_token'], $website);
	session_destroy();
	header('Location: '.$logout_url);	
?>