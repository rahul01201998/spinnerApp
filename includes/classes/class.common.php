<?php
/********************************************************************************
*	Filename: class.common.php
*	File Type: Class File
*	Purpose: All the generic most commonly used functions are defined in this class.
*	Author: BALU AVHAD 
*	Email: Avhad[dot]Balu[at]gmail[dot]com
*	Creation Date: 08/12/2016
*	Last Modified: 08/12/2016
***********************************************************************************/

Class Common
{
	var $skey = "Nothingispermanant@DoNotChangeIt"; // you can change it
	
	function is_valid_browser()
	{
		$arr = $this->browser_info();
		if($arr['name'] == 'msie' && $arr['version'] < 7)
		{
			$_SESSION['is_valid_browser'] = 0;
		}
		else
		{
			$_SESSION['is_valid_browser'] = 1;
		}
		return   $_SESSION['is_valid_browser'];
	}
	
	function redirectpg($url)
	{
		if (!headers_sent())
		{   header('Location: '.$url);
			exit;
			}
		else
			{
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>'; exit;
		}
	}
	
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
 
 
	//Function get browser information
	function browser_info($agent=null)
	{
		// Declare known browsers to look for
		$known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape',
		'konqueror', 'gecko');
					   
		// Clean up agent and build regex that matches phrases for known browsers
		// (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
		// version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
		$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';
					   
		// Find all phrases (or return empty array if none found)
		if (!preg_match_all($pattern, $agent, $matches)) return array();
					   
		// Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
		// Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
		// in the UA).  That's usually the most correct.
		$i = count($matches['browser'])-1;
					   
		//return array($matches['browser'][$i] => $matches['version'][$i]);
		$arr['name'] = $matches['browser'][$i];
		$arr['version'] = $matches['version'][$i];
		return $arr;
	}


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function curPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function curPageURLforShare()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].str_replace("/live1","",$_SERVER["REDIRECT_URL"]);
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].str_replace("/live1","",$_SERVER["REDIRECT_URL"]);
	}
	return $pageURL;
}


	
function sendPHPMail($mail, $Subject, $Body, $Redirect, $isfooter='')
{
	$headers  = "From: Promax TPO < sales@av-soft.in >\n";
	$headers .= "Cc: Promax TPO < sales@av-soft.in >\n"; 
	$headers .= "X-Sender: Promax TPO < sales@av-soft.in >\n";
	$headers .= 'X-Mailer: PHP/' . phpversion();
	$headers .= "X-Priority: 1\n"; 
	$headers .= "Return-Path: sales@av-soft.in\n"; 
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "BCC: ethinosindia@gmail.com\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	if($mail=="") { $to = TOEMAILID; } else { $to = $mail; }
	$retval = mail ($to,$Subject,$Body,$headers);
	
	if(!$retval)
	{
		$error = "There are some problem while sending mail. Please try after sometime.";
	}
	else
	{
		if($isfooter!=1)
		{
			$_SESSION['Error_Message'] = "succeed";
			$sRedirect =  SITEROOT.$Redirect;
			$this->redirectpg($sRedirect);
		}
		else
		{
			$_SESSION['Foo_Error_Message'] = "succeed";
			$sRedirect =  SITEROOT.$Redirect;
			$this->redirectpg($sRedirect);	
		}	
	}
}	
	
	
function datasanitization($inputsting)
{
	$patterns = array(
		'/&/'             => 'and',
		'/[^[:alpha:]]+/' => '_'
	);
	$result = preg_replace(array_keys($patterns), array_values($patterns), $inputsting);
	return $result;
}
function generatePassword( $length = 8 )
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
	$password = substr( str_shuffle( $chars ), 0, $length );
	return $password;
}
function count_digit($number) {
return strlen((string) $number);
}

function imgwidthHeight($imgName)
{
	$imageFile = stripslashes($imgName);
	$maxwidth  = 150;
	$maxheight = 150;
	$info = getimagesize($imageFile);
	$height = $info[1]; 
	$width = $info[0];
	$res = $this->calculateDimensions($width,$height,$maxwidth,$maxheight);
	return $res;
}


function calculateDimensions($width,$height,$maxwidth,$maxheight)
{
        if($width != $height)
        {
            if($width > $height)
            {
                $t_width = $maxwidth;
                $t_height = (($t_width * $height)/$width);
                //fix height
                if($t_height > $maxheight)
                {
                    $t_height = $maxheight;
                    $t_width = (($width * $t_height)/$height);
                }
            }
            else
            {
                $t_height = $maxheight;
                $t_width = (($width * $t_height)/$height);
                //fix width
                if($t_width > $maxwidth)
                {
                    $t_width = $maxwidth;
                    $t_height = (($t_width * $height)/$width);
                }
            }
        }
        else
            $t_width = $t_height = min($maxheight,$maxwidth);
        return array('height'=>(int)$t_height,'width'=>(int)$t_width);
}

function displayerrormsg()
{
	if(isset($_SESSION['addpgmsg']) && $_SESSION['addpgmsg'] != "")
	{
		$message =  $_SESSION['addpgmsg'];
		$_SESSION['addpgmsg'] = "";
		echo $message;
	}
}


function replace_img_src($img_tag) {
    $doc = new DOMDocument();
    $doc->loadHTML($img_tag);
    $tags = $doc->getElementsByTagName('img');
    foreach ($tags as $tag) {
        $old_src = $tag->getAttribute('src');
        $new_src_url = str_replace(TEMPDIRF, TEMPDIRR, $old_src);
        $tag->setAttribute('src', $new_src_url);
    }
    return $doc->saveHTML();
}

function add_img_src($img_tag) {
    $doc = new DOMDocument();
    $doc->loadHTML($img_tag);
    $tags = $doc->getElementsByTagName('img');
    foreach ($tags as $tag) {
        $old_src = $tag->getAttribute('src');
        //$new_src_url = str_replace("testsite/", "", $old_src);
        $new_src_url = TEMPDIRF.$old_src;
        $tag->setAttribute('src', $new_src_url);
    }
	$output = $doc->saveHTML();
    $result = preg_replace('~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', $output);
	return $result;
}

public  function safe_b64encode($string) {
	$data = base64_encode($string);
	$data = str_replace(array('+','/','='),array('-','_',''),$data);
	return $data;
}

public function safe_b64decode($string) {
	$data = str_replace(array('-','_'),array('+','/'),$string);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	return base64_decode($data);
}

public function encode($value){ 
	if(!$value){return false;}
	$text = $value;
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
	return trim($this->safe_b64encode($crypttext)); 
}

public function decode($value){
	if(!$value){return false;}
	$crypttext = $this->safe_b64decode($value); 
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
	return trim($decrypttext);
}
function filterString($stringval)
{
	$newstring = trim($stringval);
	$newstring = str_replace(' ', '-', $newstring);
	$newstring = preg_replace('/[^A-Za-z0-9\-]/', '', $newstring);
	return preg_replace('/-+/', '-', $newstring);
}

function generateIcal($eventid,$dbObj)
{
	$dbObj->where ('id', $eventid);
	$eventdetails = $dbObj->getOne('tbl_events');
	$tdate = date("Y-m-d");
	
	$icaldata = "BEGIN:VCALENDAR \r\nPRODID:-//Microsoft Corporation//Outlook 14.0 MIMEDIR//EN \r\nVERSION:2.0 \r\nMETHOD:PUBLISH \r\nX-MS-OLK-FORCEINSPECTOROPEN:TRUE \r\nBEGIN:VEVENT \r\nCLASS:PUBLIC \r\nCREATED:".date("Ymd\THis\Z",strtotime($tdate))." \r\nDESCRIPTION:Overview\r\n\r\nEvent: ".$eventdetails['event_name']."\r\n\r\nDate: ".$this->eventDateDispaly($eventdetails['event_start_date'], $eventdetails['event_end_date'])." \r\n\r\n".$eventdetails['event_short_desc']."\r\nFor more information click here <".$eventdetails['event_learn_btn_link']."> .\r\n\r\n\r\n* KPIT reserves the right to refuse admission.\r\n \r\nDTEND;VALUE=DATE:".date("Ymd\THis\Z",strtotime($eventdetails['event_start_date']))." \r\nDTSTAMP:".date("Ymd\THis\Z",strtotime($eventdetails['event_start_date']))." \r\nDTSTART;VALUE=DATE:".date("Ymd\THis\Z",strtotime($eventdetails['event_end_date']))." \r\nLOCATION:".$eventdetails['event_location']." \r\nPRIORITY:5 \r\nSEQUENCE:0 \r\nSUMMARY;LANGUAGE=en-us:KPIT: ".$eventdetails['event_name']." \r\nTRANSP:TRANSPARENT \r\nUID:".uniqid()." \r\nX-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 3.2//E N\">\r\n<HTML>\r\n<HEAD>\r\n<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html\; charset=iso-8859-1\">\r\n<META NAME=\"Generator\" CONTENT=\"MS Exchange Server v ersion 14.03.0123.002\">\r\n<TITLE>KPIT: ".$eventdetails['event_name']."</TITLE>\r\n</HEAD>\r\n<BODY>\r\n<!-- Converted from text/rtf format -->\r\n\r\n<P DIR=L TR><SPAN LANG=\"en-us\"><FONT FACE=\"Calibri\">Overview</FONT></SPAN></P>\r\n\r\n< P DIR=LTR><SPAN LANG=\"en-us\"><FONT FACE=\"Calibri\">Event: ".$eventdetails['event_name']." </FONT></SPAN></P>\r\n\r\n<P DIR=LTR><SPAN LANG=\"en-us\"><FONT FACE=\"Calibri\">Date: ".$this->eventDateDispaly($eventdetails['event_start_date'], $eventdetails['event_end_date'])."</FONT></SPAN></P>\r\n\r\n<P DIR=LTR>< SPAN LANG=\"en-us\"><FONT FACE=\"Calibri\">".$eventdetails['event_short_desc']." </FONT></SPAN></P>\r\n\r\n<P DIR=LTR><SPAN LANG=\"en-us\"><FONT FACE= \"Calibri\">For more information</FONT></SPAN><SPAN LANG=\"en-us\"> </SPAN><A HREF=\"".$eventdetails['event_learn_btn_link']."\"><SPAN LANG=\"en-us\"><U><FONT COLOR=\"#0000FF\" FACE=\"Calibri\">click here</FONT></U></SPAN><SPAN LANG=\"en-us\"></SPAN></A><SPAN LANG=\"en-us\"><F ONT FACE=\"Calibri\">.</FONT></SPAN></P>\r\n<BR>\r\n\r\n<P DIR=LTR><SPAN LANG=\"en- us\"><FONT FACE=\"Calibri\">* KPIT reserves the right to refuse admission.</F ONT></SPAN><SPAN LANG=\"en-us\"></SPAN></P>\r\n\r\n</BODY>\r\n</HTML> \r\nX-MICROSOFT-CDO-BUSYSTATUS:FREE \r\nX-MICROSOFT-CDO-IMPORTANCE:1 \r\nX-MICROSOFT-DISALLOW-COUNTER:FALSE \r\nX-MS-OLK-AUTOFILLLOCATION:FALSE \r\nX-MS-OLK-CONFTYPE:0 \r\nBEGIN:VALARM \r\nTRIGGER:-PT1080M \r\nACTION:DISPLAY \r\nDESCRIPTION:Reminder \r\nEND:VALARM \r\nEND:VEVENT \r\nEND:VCALENDAR";
	
	header("Content-type:text/calendar");
	header('Content-Disposition: attachment; filename="'.$this->filterString($eventdetails['event_name']).'.ics"');
	Header('Content-Length: '.strlen($icaldata));
	Header('Connection: close');

echo "BEGIN:VCALENDAR\n";
echo "PRODID:-//Microsoft Corporation//Outlook 12.0 MIMEDIR//EN\n";
echo "VERSION:2.0\n";
echo "METHOD:PUBLISH\n";
echo "X-MS-OLK-FORCEINSPECTOROPEN:TRUE\n";
	
echo "BEGIN:VEVENT\n";
echo "CLASS:PUBLIC\n";
echo "CREATED:".date("Ymd\THis\Z",strtotime($tdate))."\n";
echo "DESCRIPTION:".$eventdetails['event_short_desc']."\n";
echo "DTSTAMP:".date("Ymd\THis\Z",strtotime($eventdetails['event_start_date']))."\n";
echo "DTSTART:".date("Ymd\THis\Z",strtotime($eventdetails['event_start_date']))."\n";
echo "DTEND:".date("Ymd\THis\Z",strtotime($eventdetails['event_end_date']))."\n";
echo "LAST-MODIFIED:0101T000000\n";
echo "LOCATION:".$eventdetails['event_location']."\n";
echo "PRIORITY:5\n";
echo "SEQUENCE:0\n";
echo "SUMMARY;LANGUAGE=en-us: KPIT | ".$eventdetails['event_name']."\n";
echo "TRANSP:OPAQUE\n";
echo "UID:".uniqid()."\n";  // UID just needs to be some random number.  I used rand() in PHP.
echo "X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n";
echo "X-MICROSOFT-CDO-IMPORTANCE:1\n";
echo "X-MICROSOFT-DISALLOW-COUNTER:FALSE\n";
echo "X-MS-OLK-ALLOWEXTERNCHECK:TRUE\n";
echo "X-MS-OLK-AUTOFILLLOCATION:FALSE\n";
echo "X-MS-OLK-CONFTYPE:0\n";

//Here is where you set the reminder for the event.
echo "BEGIN:VALARM\n";
echo "TRIGGER:-PT1440M\n";
echo "ACTION:DISPLAY\n";
echo "DESCRIPTION:".$eventdetails['event_name']."\n";

echo "END:VALARM\n";
echo "END:VEVENT\n";	
echo "END:VCALENDAR\n";
}

function checkURL($url)
{
	if (false === strpos($url, '://'))
	{
		return SITEURL.$url;
	}
	else
	{
		return $url;
	}
}

function checkTargetForMenu($turl)
{
	if (false === strpos($turl, '://'))
	{
	return "target=\"_self\"";
	}
	else
	{
	  return "target=\"_blank\"";
	}
}

function stringTruncate($string, $limit, $break=".", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;
 
  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }
 
  return $string;
}

function checkLink($alink)
{
	if (substr($alink, 0, 1) === '#')
		return true;
	else
		return false;
}

function callToCURL($soap_request, $service_to_call)
{
	$sheader = array(
	"Content-type: text/xml;charset=\"utf-8\"",
		"Accept: text/xml",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"SOAPAction: \"http://tempuri.org/$service_to_call\"",
		"Content-length: ".strlen($soap_request),
	  );
	
		$soap_do = curl_init();
		curl_setopt($soap_do, CURLOPT_URL, "http://115.69.250.212:8181/SenseiWebsite/CRMEntryService.asmx?op=$service_to_call");
		curl_setopt($soap_do, CURLOPT_PORT, 8181);
		curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
		curl_setopt($soap_do, CURLOPT_HEADER, 0);
		curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($soap_do, CURLOPT_POST,           false );
		curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
		curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $sheader);
	  
		$response = curl_exec($soap_do);
		if($response === false) {
			$err = 'Curl error: ' . curl_error($soap_do);
			curl_close($soap_do);
		} else {
			$responsedom = new DomDocument ();
			$responsedom->loadXML ( $response );
			$returnvalue = $responsedom->textContent;	  
			curl_close($soap_do);
		}
	return $returnvalue;
}

function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }
		
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }
	
function arrayToObject($d) {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__FUNCTION__, $d);
        }
        else {
            // Return object
            return $d;
        }
    }
function checkLogin()
{
	if(!isset($_SESSION['Active_UserLeadID']) && $_SESSION['Active_UserLeadID'] == "")
	{
		$this->redirectpg(SITEROOT."my-sensei.php");
	}
}

function confirmLogin()
{
	if(isset($_SESSION['Active_UserLeadID']) && $_SESSION['Active_UserLeadID'] != "")
	{
		$this->redirectpg(SITEROOT."my-sensei-post.php");
	}
}
}
$comObj = new Common();

?>