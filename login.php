<?php

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) {die('Restricted access');}

require_once("includes/SiteSetting.php");
require_once("includes/classes/class.common.php");

if(($_POST['username']<>"")&&($_POST['password']<>""))
{
	$password  = md5($_POST['password']);
	//$userArray = $objUsers->getRowData("id,username","is_active = '1' AND password = '".$password."' AND username = '".$POST['txt_username']."' ");
	
	$dbObj->where ("password", $dbObj->escape($password));
	$dbObj->where ("username", $dbObj->escape($_POST['username']));
	// $dbObj->where ("is_active", "1");	
	$userArray = $dbObj->getOne("tbl_admin");
	
	// echo "<pre>"; print_r($userArray); die;
	if(count($userArray)>0)
	{	
		#=== Save Data to Session
		$_SESSION['SessAdminName'] 	= $userArray['username'];
		$_SESSION['valid'] = 'true';
		echo json_encode(array('status' => 'success'));
	}
	else
	{
		echo json_encode(array('status' => 'error'));
	}
}
else
{
	echo json_encode(array('status' => 'error'));
}

