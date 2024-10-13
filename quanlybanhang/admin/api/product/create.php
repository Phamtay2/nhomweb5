<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/productapi.php');

$db = new db();
$connect = $db->connect();

$productapi = new productapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $productapi->masp = $data->masp;
    $productapi->tensp = $data->tensp;
    $productapi->danhmuc = $data->danhmuc;
    $productapi->gianhap = $data->gianhap;
    $productapi->giaban = $data->giaban;
    $productapi->hienthi = $data->hienthi;
    $productapi->giakm = $data->giakm;
    $productapi->soluong = $data->soluong;
    $productapi->mota = $data->mota;

    if ($productapi->create()) {
        echo json_encode(array('message', 'Tạo thành công'));
    } else {
        echo json_encode(array('message', 'Tạo không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>