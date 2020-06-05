<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
 

switch (true) {
    case (!isset($_POST['id'])):
    case (!isset($_POST['name'])):
    case (!isset($_POST['tel'])):
    case (!isset($_POST['email'])):
        echo json_encode(["code" => 400, "data" => [], "error" => "缺少參數"], true);
        exit();
}

$fname = "test.txt";
$o_str = file_get_contents($fname);
$str = explode("\r\n", $o_str);
$tmp = "";
foreach ($str as $k => $v) {
    $data =  explode("|", $v);
    if ($data[0] == $_POST['id']) {
        $newStr = $_POST['id'] . "|" . $_POST['name'] . "|" . $_POST['tel'] . "|" . $_POST['email'];
        $tmp = str_replace($v, $newStr , $o_str);
        file_put_contents($fname, $tmp);
    }
}




$str = file_get_contents($fname);
$str = explode("\r\n", $str);
$tmp = [];
foreach ($str as $k => $v) {
    $tmp[] =  explode("|", $v);
}

echo json_encode(["code" => 200, "data" => $tmp], true);
