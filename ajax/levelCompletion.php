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
    if(!$levelMgr->IsLevelOpen($levelId)) {
        die(json_encode($result));
    }
    switch($levelId) {
        case '6': 
            $answer = 'answer';
            LevelCompletionManager::LogCompletionAttempt('6', $answer);

            $servername = "localhost";
            $username = "inject";
            $password = "injection";
            $database = "dummy";
        
            $conn = new mysqli($servername, $username, $password, $database);
                
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            
            if ($conn->connect_error) {
                //$result['message'] = $conn->connect_error;
                die(json_encode($result)); //. $conn->connect_error);
            } 
        
            $sql  = "SELECT * FROM `injector` WHERE name = '" . $name . "' and pass = '" . $pass ."' ";
        
            //$result['message'] = $sql;
        
            $res = $conn->query($sql);
        
            if ($res->num_rows > 0) {
                $completeStatus = LevelCompletionManager::CompleteLevel('6');
                $result['status'] = "OK";
            } else {
                $result['status'] = "Failed";
            }
        
            $conn->close();

            /* if($answer == $levelDataMgr->GetData('level_solution')) {
                //Add a complete query in here.
                $completeStatus = LevelCompletionManager::CompleteLevel('1');
                $result['status'] = $completeStatus['status'];
            } else {
                $result['status'] = ENUM_STATUS_FAILED;
            } */
            break;
        
        default:
            $result['status'] = ENUM_STATUS_ILLEGAL;
            break;
    }

    echo json_encode($result);
?>
