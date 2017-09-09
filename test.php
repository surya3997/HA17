<?php
$c = $_POST['code'];

$url = "https://psglogin.in/php/details.php";

//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, "https://psglogin.in/php/details.php");
//curl_setopt($curl, CURLOPT_POST, 1);
//curl_setopt($curl, CURLOPT_POSTFIELDS, "code=".$c);
//$response = curl_exec($curl);

$data = array('code' => $c);
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
//echo $result;
if ($result === FALSE) { /* Handle error */ }
//var_dump($result);
die(json_encode($result));

//echo $response;
?>

