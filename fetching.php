<?php

// define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
// if(!IS_AJAX) {die('Restricted access');}


ini_set('display_errors', 0);
error_reporting(0);
session_start();

   
require_once("includes/SiteSetting.php");
require_once("includes/classes/class.common.php");

// After three click logic
$post = $_POST['num'];
if ($post >= 4) {
	$_SESSION['click'] = "disabled";
	echo json_encode(array('status' => 'disable'));
	exit;
}
if (isset($_SESSION['click'])) {
	echo json_encode(array('status' => 'disable'));
	exit;
}



function myfun_one(){
global $dbObj;
$dbObj->orderBy("id", "DESC");
$employee_list = $dbObj->get("img",20, array('id','name'));
$create_list_name = array_column($employee_list, 'name');

// shuffel fruit name
$splice_name = $create_list_name;
shuffle($splice_name);

// only splice rand from 50 to 70
$rand_number = 10;
array_splice($splice_name, $rand_number);

$create_list = array_column($employee_list, 'id');
$shuffle_list = $create_list;
// final img selectd 
shuffle($shuffle_list); 

$img_id =  $shuffle_list[0]; 


// get image details

$dbObj->where("id", $img_id);

$getArray = $dbObj->getOne("img");

$winner_arr = array($getArray['name']);
$final_result = array_merge($splice_name, $winner_arr);
$return['img_set_1'] = $final_result; 
$return['img_name_1'] = $getArray['name']; 
return $return;
// echo "<pre>";
// print_r(array('img_set_1' => $final_result, 'img_name_1' => $lucky_emp['name']));
// echo "</pre>";
}

function myfun_three(){
global $dbObj;
$dbObj->orderBy("id", "DESC");
$employee_list = $dbObj->get("img",20, array('id','name'));
$create_list_name = array_column($employee_list, 'name');

// shuffel employee name
$splice_name = $create_list_name;
shuffle($splice_name);

// only splice rand from 50 to 70
$rand_number = 10;
array_splice($splice_name, $rand_number);

$create_list = array_column($employee_list, 'id');
$shuffle_list = $create_list;
// winner selectd 
shuffle($shuffle_list); 

$img_id =  $shuffle_list[0]; 


// get winner details

$dbObj->where("id", $img_id);

$getArray = $dbObj->getOne("img");

$winner_arr = array($getArray['name']);
$final_result = array_merge($splice_name, $winner_arr);
$return['img_set_3'] = $final_result; 
$return['img_name_3'] = $getArray['name']; 
return $return;
// echo "<pre>";
// print_r(array('img_set_2' => $final_result, 'img_name_2' => $getArray['name']));
// echo "</pre>";
}

function myfun_two(){
global $dbObj;
$dbObj->orderBy("id", "DESC");
$employee_list = $dbObj->get("img",20, array('id','name'));
$create_list_name = array_column($employee_list, 'name');

// shuffel employee name
$splice_name = $create_list_name;
shuffle($splice_name);

// only splice rand from 50 to 70
$rand_number = 10;
array_splice($splice_name, $rand_number);

$create_list = array_column($employee_list, 'id');
$shuffle_list = $create_list;
// winner selectd 
shuffle($shuffle_list); 

$img_id =  $shuffle_list[0]; 


// get winner details

$dbObj->where("id", $img_id);

$getArray = $dbObj->getOne("img");

$winner_arr = array($getArray['name']);
$final_result = array_merge($splice_name, $winner_arr);
$return['img_set_2'] = $final_result; 
$return['img_name_2'] = $getArray['name']; 
return $return;
// echo "<pre>";
// print_r(array('img_set_2' => $final_result, 'img_name_2' => $lucky_emp['name']));
// echo "</pre>";
}
$data1 = myfun_one();
$data2 = myfun_two();
$data3 = myfun_three();
// Points Collect
$points;
$finalRes_1 = $data1['img_name_1'];
$finalRes_2 = $data2['img_name_2'];
$finalRes_3 = $data3['img_name_3'];
if ( $finalRes_1 === $finalRes_2 && $finalRes_2 === $finalRes_3 ){
    $points = "five_hundred";
}else if($finalRes_1 != $finalRes_2 && $finalRes_2 != $finalRes_3 && $finalRes_3 != $finalRes_1){
	$points = "zero";
}else{
	$points = "two_hundred";
}

// Json response
echo json_encode(array('status' => 'success',
	'img_set_1' => $data1['img_set_1'],
	'img_name_1' => $data1['img_name_1'],
	'img_set_2' => $data2['img_set_2'],
	'img_name_2' => $data2['img_name_2'],
	'img_set_3' => $data3['img_set_3'],
	'img_name_3' => $data3['img_name_3'],
	'points' => $points
));
die;