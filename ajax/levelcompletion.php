<?php
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    if(!isset($_REQUEST['level'])) {
        die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));
    }

    $levelId = clean($_REQUEST['level']);

    //Any other parameters may be obtained in the appropriate levels' switch case. 
    $result = array();
    $result['status'] = ENUM_STATUS_FAILED;
    switch($levelId) {
        case '1': 
            $answer = clean($_REQUEST['answer']);
            $levelDataMgr = new LevelDataManager('1');
            LevelCompletionManager::LogCompletionAttempt('1', $answer);

            if($answer == $levelDataMgr->GetData('level_solution')) {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('1');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '4':
            $answer = clean($_REQUEST['answer']);
            $levelDataMgr = new LevelDataManager('4');
            LevelCompletionManager::LogCompletionAttempt('4', $answer);

            if($answer == $levelDataMgr->GetData('level_solution')) {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('4');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '11':
            LevelCompletionManager::LogCompletionAttempt('11');
            $completeStatus = LevelCompletionManager::CompleteLevel('11');
            $result['status'] = $completeStatus['status'];
            break;
        
        default:
            $result['status'] = ENUM_STATUS_ILLEGAL;
            break;
    }

    echo json_encode($result);
?>