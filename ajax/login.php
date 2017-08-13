<?php
    include '../includes/config.php';
    /* Dconsole("Surya"); */
    $jsonMessage = array();

    if($session->isLoggedIn()) {
        $jsonMessage['status'] = "Ok";
        echo json_encode($jsonMessage);
    }

    $username = clean($_POST['username']);
    $password = clean($_POST['password']);

    if($session->login($username, $password))   {
        $jsonMessage['status'] = "Ok";
    } else {
        $jsonMessage['status'] = "Authentication Failed";
    }

    echo json_encode($jsonMessage);
?>