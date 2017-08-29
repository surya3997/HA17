<?php 
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    //Clean up the requests
    $level = clean($_REQUEST['level']);
    $dataKey = clean($_REQUEST['dataKey']);

    //Get the data.
    $retData = array();
    $retData['status'] = ENUM_STATUS_FAILED;

    $levelDataMgr = new LevelDataManager($level);
    $reqValue = $levelDataMgr->GetData($dataKey);
    if($reqValue != NULL) {
        $retData['status'] = ENUM_STATUS_OK;
        $retData['dataValue'] = $reqValue;
    }

    echo json_encode($retData);
?>