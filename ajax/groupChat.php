<?php 
    $sql = 'SELECT name FROM `ha_level` WHERE `id` = '.$this->getPage();
    global $db;
    $query = $db->query($sql);
    $row = $db->result($query);
    echo $row->name;
?>