<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/taikhoanapi.php');

    $db = new db();
    $connect = $db->connect();

    $taikhoanapi = new taikhoanapi($connect);
    $read = $taikhoanapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $taikhoanapi_array = [];
        $taikhoanapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $taikhoanapi_item = array(
                'id' => $id,
                'ten' => $ten,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'phanquyen' => $phanquyen,

            );
            array_push($taikhoanapi_array['data'], $taikhoanapi_item);
        }
        echo json_encode($taikhoanapi_array);
    }
?>