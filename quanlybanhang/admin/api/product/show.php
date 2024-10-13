<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/productapi.php');

	$db = new db();
	$connect = $db->connect();

	$productapi = new productapi($connect);
	
	$productapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$productapi->show();

	$productapi_item = array(
				'id' => $productapi->id,
                'masp' => $productapi->masp,
                'tensp' => $productapi->tensp,
                'danhmuc' => $productapi->danhmuc,
                'gianhap' => $productapi->gianhap,
                'giaban' => $productapi->giaban,
                'giakm' => $productapi->giakm,
                'soluong' => $productapi->soluong,
                'hienthi' => $productapi->hienthi,
                'mota' => $productapi->mota,
			);
	print_r(json_encode($productapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>