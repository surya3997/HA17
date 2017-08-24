<?php
    include '../includes/config.php';

    $session->logout();

    echo json_encode(array("status" => "Ok"));
?>