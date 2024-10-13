<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/taikhoanapi.php');

$db = new db();
$connect = $db->connect();

$taikhoanapi = new taikhoanapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $taikhoanapi->ten = $data->ten;
    $taikhoanapi->username = $data->username;
    $taikhoanapi->password = $data->password;
    $taikhoanapi->email = $data->email;
    $taikhoanapi->phanquyen = $data->phanquyen;

    if ($taikhoanapi->create()) {
        echo json_encode(array('message', 'Tạo thành công'));
    } else {
        echo json_encode(array('message', 'Tạo không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>