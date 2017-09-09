<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$c = $_POST['code'];
$url = "https://psglogin.in/php/details.php";
$data = array('code' => $c, 'origin' => 'https://hack-a-venture.psglogin.in');

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) { /* Handle error */ }
//var_dump($result);
//die(json_encode($result));
print_r($result);

?>

