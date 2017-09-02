<?php
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    global $levelDataMgr;

    $retStatus = array();
    $retStatus['status'] = ENUM_STATUS_OK;
    $retStatus['content'] = array();
    $retStatus['open'] = array();

    $sql = 'SELECT current_level FROM `ha_user` WHERE `id` = '.$user->getUserId();
    $query = $db->query($sql);
    $result = $db->result($query);

    //array_push($retStatus['level'], $result->current_level);

    $retStatus['level'] = $result->current_level;

    $sql = 'SELECT `level_id` 
            FROM '.DBT_USER_LEVELS.'
            WHERE `close_time` is not NULL '.
            'AND `user_id` = \''.$user->getUserId().'\'';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        //array_push($retStatus['level'], $template->getLevelId());
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['content'], $row->level_id);
        }
        $db->freeResults($query);
    }

    $sql  = 'SELECT id FROM `ha_level` WHERE isImplemented = 1';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        //array_push($retStatus['level'], $template->getLevelId());
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['open'], $row->id);
        }
        $db->freeResults($query);
    }

    echo json_encode($retStatus);
?>