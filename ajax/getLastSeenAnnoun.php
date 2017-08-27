<?php 
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    //Check the actual latest announcement
    $sql = 'SELECT MAX(`id`) as max_id
            FROM '.DBT_ANNOUNCEMENTS;
    $query = $db->query($sql);
    $result = $db->result($query);
    $latestAnnoun = $result->max_id;
    $db->freeResults($query);

    if(isset($_REQUEST['PUT'])) {
        $sql = 'UPDATE '.DBT_USER.'
                SET `seen_announ` = \''.$latestAnnoun.'\'
                WHERE `id` = \''.$user->getUserId().'\'';
        $db->query($sql);
        echo json_encode(array('status' => ENUM_STATUS_OK));
    } else {
        //Check if the hints can be unlocked.
        $sql = 'SELECT `seen_announ`
                FROM '.DBT_USER.'
                WHERE `id` = \''.$user->getUserId().'\'';
        $query = $db->query($sql);
        $result = $db->result($query);
        $lastSeen = $result->seen_announ;
        $db->freeResults($query);
        
        echo json_encode(array(
            'status' => ENUM_STATUS_OK,
            'count' => ($latestAnnoun - $lastSeen)
        ));
    }
?>