<?php 

    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    $retStatus = array();
    $retStatus['status'] = ENUM_STATUS_OK;
    $retStatus['level_id'] = array();
    $retStatus['count'] = array();
    $sql = 'SELECT level_id, count(level_id) as users from ha_user_levels WHERE close_time is not NULL GROUP by level_id';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['level_id'], $row->level_id);
            array_push($retStatus['count'], $row->users);
        }
        $db->freeResults($query);
    }

    echo json_encode($retStatus);
?>