<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/danhmucapi.php');

	$db = new db();
	$connect = $db->connect();

	$danhmucapi = new danhmucapi($connect);
	
	$danhmucapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$danhmucapi->show();

	$danhmucapi_item = array(
				'id' => $danhmucapi->id,
				'tendm' => $danhmucapi->tendm,
				'hienthi' => $danhmucapi->hienthi,
				'uutien' => $danhmucapi->uutien,
				'ghichu' => $danhmucapi->ghichu,
			);
	print_r(json_encode($danhmucapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>