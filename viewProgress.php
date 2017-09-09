<pre>
<?php
	include 'includes/config.php';

	global $db;
    $sql = 'SELECT * FROM `ha_user`';
	$query = $db->query($sql);

	if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            print_r($row);
        }
        $db->freeResults($query);
    }


	$sql = 'SELECT * FROM `ha_queries`';
    $query = $db->query($sql);

    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            print_r($row);
        }
        $db->freeResults($query);
    }

	$sql = 'SELECT * FROM `ha_level_attempts`';
    $query = $db->query($sql);

    if($db->numRows($query) > 0)    {
        while(($row = $db->result($query)) != NULL) {
            print_r($row);
        }
        $db->freeResults($query);
    }

?>
</pre>
