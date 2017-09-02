<?php
    include '../includes/config.php';
    /* Dconsole("Surya"); */
    $jsonMessage = array();

    if(!$session->isLoggedIn()) {
        $jsonMessage['status'] = "Fail";
        echo json_encode($jsonMessage);
    }

    $unsafeQuery = clean($_POST['query']);

    global $db;
    $safeQuery = $db->escapeString($unsafeQuery);
    global $user;

    $sql = 'INSERT INTO `ha_queries` (`query_id`, `user_id`, `query`) VALUES (NULL, \''.$user->getUserId().'\', \''.$safeQuery.'\');';
    $query = $db->query($sql);

    echo json_encode($jsonMessage);
?>