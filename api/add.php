<?php

$fname = "test.txt";
switch (true) {
    case (!isset($_POST['name'])):
    case (!isset($_POST['tel'])):
    case (!isset($_POST['email'])):
        echo json_encode(["code" => 400, "data" => [], "error" => "缺少參數"], true);
        exit();
}
$str = file_get_contents($fname);
$newStr = "" ;
if (strlen($str) != 0)  $newStr .= "\r\n";
$newStr .= time() . rand(1, 999) . "|" . $_POST['name'] . "|" . $_POST['tel'] . "|" . $_POST['email'];
// $newStr .= rand(1, 1000000) . "|dasiy|2885252|dasiy@gmail.gg";

file_put_contents("test.txt", "$newStr", FILE_APPEND);
$str = file_get_contents($fname);
$str = explode("\r\n", $str);
$tmp = [];
foreach ($str as $k => $v) {
    $tmp[] =  explode("|", $v);
}

echo json_encode(["code" => 200, "data" => $tmp], true);
