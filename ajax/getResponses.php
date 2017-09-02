<?php
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    $retStatus['query'] = array();
    $retStatus['response'] = array();

    $sql = 'SELECT query, response FROM `ha_query_response`';
    $query = $db->query($sql);
    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            array_push($retStatus['query'], $row->query);
            array_push($retStatus['response'], $row->response);
        }
        $db->freeResults($query);
    }

    echo json_encode($retStatus);
?>