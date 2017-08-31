<?php 
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    if(!isset($_REQUEST['level'])) {
        die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));
    }

    $level = clean($_REQUEST['level']);

    //Check if the level is legally allowed
    if(!$levelMgr->IsLevelOpen($level)) {
        die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));
    }

    //Check if the hints can be unlocked.
    echo json_encode($levelMgr->UnlockNextHint($level));
?>