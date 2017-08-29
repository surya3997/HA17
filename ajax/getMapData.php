<?php
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    $retStatus = array();
    $retStatus['status'] = ENUM_STATUS_OK;
    $retStatus['content'] = array();

    $sql = 'SELECT `level_id` 
            FROM '.DBT_USER_LEVELS.'
            WHERE `close_time` is not NULL '.
            'AND `user_id` = \''.$user->getUserId().'\'';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['content'], $row->level_id);
        }
        $db->freeResults($query);
    }

    echo json_encode($retStatus);
?>