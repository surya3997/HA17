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

        case '2': 
            $answer = clean($_REQUEST['answer']);
            //$levelDataMgr = new LevelDataManager('1');
            LevelCompletionManager::LogCompletionAttempt('2', $answer);

            if($answer == 'GetThrough') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('2');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '3': 
            $answer = clean($_REQUEST['connection']);

            if($answer == 'OKAY') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('3');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '4':
            $answer = clean($_REQUEST['answer']);
            $levelDataMgr = new LevelDataManager('4');
            $levelMessage = LevelCompletionManager::LogCompletionAttempt('4', $answer);

            if($answer == $levelDataMgr->GetData('level_solution')) {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('4');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            //$result['message'] = $levelMessage;
            break;

        case '5': 
            $answer = clean($_REQUEST['password']);
	    LevelCompletionManager::LogCompletionAttempt('5', $answer);

            if($answer == 'Ethereum') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('5');
                $result['status'] = $completeStatus['status'];
		$result['message'] = "You have completed the level!";
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;


        case '7': 
            $answer = clean($_REQUEST['answer']);
            $levelDataMgr = new LevelDataManager('7');
            LevelCompletionManager::LogCompletionAttempt('7', $answer);

            if($answer == $levelDataMgr->GetData('level_solution')) {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('7');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '8': 
            $answer = clean($_REQUEST['answer']);
            LevelCompletionManager::LogCompletionAttempt('8', $answer);

            if($answer == 'concealed12321') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('8');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;

        case '10': 
            $answer = clean($_REQUEST['answer']);
            LevelCompletionManager::LogCompletionAttempt('10', $answer);

            if($answer == 'cryptdosh') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('10');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;


        case '11':
            $answer = clean($_REQUEST['answer']);
            LevelCompletionManager::LogCompletionAttempt('11');
            if($answer == 'blockchain') {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('11');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            }
            break;
        
        default:
            $result['status'] = ENUM_STATUS_ILLEGAL;
            break;
    }

    echo json_encode($result);
?>
