<?php 
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    if(!isset($_REQUEST['level'])) {
        die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));
    }

    $levelHash = clean($_REQUEST['level']);

    $retData = '';

    if(isset($_REQUEST['nHintCost'])) {
        $retData = json_encode($levelMgr->GetNextHintCost($levelHash));
    } else {
        $retData = json_encode($levelMgr->GetLevelInformation($levelHash));
    }

    echo $retData;
?>