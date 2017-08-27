<?php 

    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    $retStatus = array();
    $retStatus['status'] = ENUM_STATUS_OK;
    $retStatus['content'] = array();
    $sql = 'SELECT *
            FROM '.DBT_ANNOUNCEMENTS.'
            ORDER BY `id` DESC';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['content'], array('data' => $row->content, 'time' => $row->post_time));
        }
        $db->freeResults($query);
    }

    echo json_encode($retStatus);
?>