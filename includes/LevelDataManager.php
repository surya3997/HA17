<?php

/**
 * Class used to manage storing and retreiving of level specific data. 
 */
class LevelDataManager {
    private $userId;
    private $levelId;

    public function __construct($levelId) {
        global $user;
        $this->userId = $user->getUserId();
        $this->levelId = $levelId;
    }

    public function getLevelId() {
        return $this->levelId;
    }

    /**
     * Method to set a value. IF the update param is true then we can force an update if it already exists.
     */
    public function SetData($key, $value, $forceUpdate = true) {
        global $db;
        $sql = 'SELECT `data_value` 
                    FROM '.DBT_LEVEL_USER_DATA.'
                    WHERE `data_key` = \''.$key.'\'
                        AND `level_id` = \''.$this->levelId.'\'
                        AND `user_id` = \''.$this->userId.'\'';
        $query = $db->query($sql);
        $nRows = $db->numRows($query);
        $db->freeResults($query);
        if($nRows > 0) {
            //Update the value over here.
            if(!$forceUpdate) { //Do not force an update. Return
                return;
            }
            $sql = 'UPDATE '.DBT_LEVEL_USER_DATA.'
                        SET `data_value` = \''.$value.'\'
                        WHERE `data_key` = \''.$key.'\'
                            AND `level_id` = \''.$this->levelId.'\'
                            AND `user_id` = \''.$this->userId.'\'';
        } else {
            //Insert the value over here.
            $sql = 'INSERT INTO '.DBT_LEVEL_USER_DATA."(`level_id`, `user_id`, `data_key`, `data_value`)
                        VALUES ('{$this->levelId}', '{$this->userId}', '{$key}','{$value}')";
        }
        $query = $db->query($sql);
    }

    /**
     * Method to get a data value from the Table for the particular level and user.
     */
    public function GetData($key) {
        global $db;
        $sql = 'SELECT `data_value` 
                    FROM '.DBT_LEVEL_USER_DATA.'
                    WHERE `data_key` = \''.$key.'\'
                        AND `level_id` = \''.$this->levelId.'\'
                        AND `user_id` = \''.$this->userId.'\'';
        $query = $db->query($sql);
        $retValue = NULL;
        if($db->numRows($query) > 0) {
            $result = $db->result($query);
            $retValue = $result->data_value;
            $db->freeResults($query);
        }
        return $retValue;
    }

    /**
     * Method to modify a special type of data for each level.
     * This is to specify the amount time spent on a particular round.
     * The entry for this is inserted when the level is opened.
     */
     public function IncreaseTimeSpentOnLevel() {
         global $db;
         $sql = 'SELECT `data_value` 
                    FROM '.DBT_LEVEL_USER_DATA.'
                    WHERE `level_id` = \''.$this->levelId.'\'
                        AND `user_id` = \''.$this->userId.'\'
                        AND `data_key` = \'time_spent\'';
        $query = $db->query($sql);
        $result = $db->result($query);
        $timeSpent = intval($result->data_value) + CHECK_TIME_SPENT_INTERVAL;
        $db->freeResults($query);
        $sql = 'UPDATE '.DBT_LEVEL_USER_DATA.'
                    SET `data_value` = \''.$timeSpent.'\'
                    WHERE `level_id` = \''.$this->levelId.'\'
                        AND `user_id` = \''.$this->userId.'\'
                        AND `data_key` = \'time_spent\'';
        $db->query($sql);
     }

}

?>