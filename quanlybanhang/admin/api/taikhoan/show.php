<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/taikhoanapi.php');

	$db = new db();
	$connect = $db->connect();

	$taikhoanapi = new taikhoanapi($connect);
	
	$taikhoanapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$taikhoanapi->show();

	$taikhoanapi_item = array(
				'id' => $taikhoanapi->id,
				'ten' => $taikhoanapi->ten,
				'username' => $taikhoanapi->username,
				'password' => $taikhoanapi->password,
				'email' => $taikhoanapi->email,
				'phanquyen' => $taikhoanapi->phanquyen,
			);
	print_r(json_encode($taikhoanapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>