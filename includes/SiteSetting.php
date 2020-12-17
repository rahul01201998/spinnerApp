<?php
session_start();
/********************************************************************************
*	Filename: SiteSetting.php
*	File Type: Class File
*	Purpose: All site settings and constants are defined in this file.
*	Author: BALU AVHAD 
*	Email: Avhad[dot]Balu[at]gmail[dot]com
*	Creation Date: 08/12/2016
*	Last Modified: 08/12/2016
*********************************************************************************/
require_once("SiteConfig.php");
require_once("classes/class.common.php");
require_once("classes/class.msqli.php");
require_once("classes/Array2XML.php");
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors',0);
error_reporting(E_ALL);
$comObj = new Common();
#---- to check the bowser version ----#
#--- Database object to connect and access database ---#
$dbObj = new MysqliDb(HST, USR, PWD, DBN);
#---- CONSTANTS DEFINED HERE ----#
define("VIEWDIR", "view/");
define("CONTROLLERDIR", "controller/");
define("TEMPDIRF","/");
define("TEMPDIRR","");
define("TOEMAILID","avhad.balu@gmail.com");
define("TOEMAILNAME","Balu Avhad");
$whitelistemails = array("avhad.balu@gmail.com");
function sendMail($mailObj, $ToMail, $Subject, $Body){
	$mailObj->isSMTP();                                      // Set mailer to use SMTP
	$mailObj->Host = 'mail.truevaluemarketing.in';  // Specify main and backup SMTP servers
	$mailObj->SMTPAuth = true;                               // Enable SMTP authentication
	$mailObj->Username = 'info@truevaluemarketing.in';                 // SMTP username
	$mailObj->Password = '4D%cHDlLRwFN';                           // SMTP password
	//$mailObj->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mailObj->Port = 587;                                // TCP port to connect to
	$mailObj->setFrom('info@truevaluemarketing.in', 'House Of Milk');
	$mailObj->addCC('ethinosindia@gmail.com');
	$mailObj->addBCC('avhad.balu@gmail.com');
	$mailObj->addAddress($ToMail);     // Add a recipient
	
	$mailObj->isHTML(true);                                  // Set email format to HTML
	$mailObj->Subject = $Subject;
	$mailObj->Body    = $Body;
	if(!$mailObj->send()) {
	   return 0;
	} else {
	   return 1;
	}
}
function test($data)
{
	echo "<pre>";print_r($data);exit;
}
function datasanitization($inputsting)
{
	return preg_replace('/[^a-zA-Z0-9\-\._]/','', $inputsting);
}
?>