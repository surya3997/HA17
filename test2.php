<?php

$inputData = $_POST['data'];
$lang = $_POST['lang'];
$game = $_POST['game'];
$id = 'surya';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8000",
  CURLOPT_URL => "http://34.212.155.13:8000/run",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $inputData,
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "game: " . $game,
    "id: " . $id,
    "language: " . $lang,
    "postman-token: 98b9939d-def2-9a1d-07f3-aa88d3aeeb2b"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "Error";
} else {
  echo $response;
}
