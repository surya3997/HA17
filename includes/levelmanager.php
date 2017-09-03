<?php

/*
 * LevelManager class manages levels of the system. 
 * Handles all level requirements
 */
class LevelManager {
    private $userId;
    /*
     * Get all the details available
     */
    function __construct() {
        global $user;
        $this->userId = $user->getUserId();
        //TODO Do we get all levels completed ?
    }

    /**
     * Checks whether the current user has access to this level or not. 
     */
    public function IsLevelOpen($levelId) {
        global $db;
        $sql = 'SELECT `open_time`, `close_time`
                    FROM '.DBT_USER_LEVELS.'
                    WHERE `user_id` = \''.$this->userId.'\'
                        AND `level_id` = \''.$levelId.'\'';
        $query = $db->query($sql);
        if($db->numRows($query) == 0) {
            return false;
        }
        $result = $db->result($query);
        if($result->close_time != NULL) {
            return false;
        }
        $db->freeResults($query);

        $sql = 'SELECT isImplemented from ha_level WHERE id = '.$levelId;
        $query = $db->query($sql);
        if($db->numRows($query) == 0) {
            return false;
        }
        $result = $db->result($query);
        if($result->isImplemented != 1) {
            return false;
        }
        $db->freeResults($query);
        return true;
    }

    /**
     * Get the cost of the 
     */
     public function GetNextHintCost($level) {
        global $user, $db;

        //Get the Cost of the next hint. 
        $sql = 'SELECT `pts_reduction`
                FROM '.DBT_LEVEL_HINTS.'
                WHERE `level_id` = \''.$level.'\'';
                    /* 'AND `hint_index` > (
                        SELECT MAX(`hint_index`)
                        FROM '.DBT_USER_HINTS.'
                        WHERE `level_id` = \''.$level.'\'
                            AND `user_id` = \''.$user->getUserId().'\''. 
                    ')';*/
        $query = $db->query($sql);
        $retData = array();
        if($db->numRows($query) > 0) {
            $result = $db->result($query);
            $retData['status'] = ENUM_STATUS_OK;
            $retData['cost'] = $result->pts_reduction > 0;
        } else {
            //No hints found.
            $retData['status'] = ENUM_STATUS_FAILED;
        }
        return $retData;
    }

    public function UnlockNextHint($levelId) {
        global $db;
        //Get the last hint available to the user in the level.
        $returnMsg = array();
        $returnMsg['status'] = ENUM_HINT_STATUS_OVER;
        $sql = 'SELECT `hint_index`, `open_timestamp` 
                    FROM '.DBT_USER_HINTS.'
                    WHERE `level_id` = \''.$levelId.'\'
                        AND `user_id` = \''.$this->userId.'\'
                        ORDER BY `hint_index` DESC LIMIT 1';
        $query = $db->query($sql);
        $lastHint = array();
        $lastHint['index'] = 0;
        if($db->numRows($query) > 0) {
            $result = $db->result($query);
            $db->freeResults($query);
            $lastHint['index'] = $result->hint_index;
            $lastHint['open_timestamp'] = $result->open_timestamp;
        }

        //If this is zero we have to get the init delay from the user_levels table. [ie. Level open time.]
        $currentTime = time();
        //Get the next hint from the level_hints table
        $sql = 'SELECT `hint`, `hint_index`, `open_delay`
                    FROM '.DBT_LEVEL_HINTS.'
                    WHERE `level_id` = \''.$levelId.'\'
                        AND `hint_index` > \''.$lastHint['index'].'\'
                    ORDER BY `hint_index` ASC LIMIT 1';
        $query = $db->query($sql);
        if($db->numRows($query) == 0) {
            //No more hints to show for this level.
            $db->freeResults($query);
            return $returnMsg;
        }
        $requiredHintData = $db->result($query);
        $db->freeResults($query);
        
        //Check if the time is right to give him this hint.
        if($lastHint['index'] == 0) {   //We get it from the opening time of the level.
            $sql = 'SELECT `open_time`
                        FROM '.DBT_USER_LEVELS.'
                        WHERE `level_id` = \''.$levelId.'\'
                            AND `user_id` = \''.$this->userId.'\'';
            $query = $db->query($sql);
            if($db->numRows($query) == 0) {
                //This means that the level is not even open. Kill him
                $returnMsg['status'] = ENUM_STATUS_ILLEGAL;
                return $returnMsg;
            }
            //Check the time stamp.
            $result = $db->result($query);
            //This is just a safe gaurd.
            if($result->open_time == NULL) {
                $result->open_time = $currentTime;
            }
            //Check the time stamp and set the result. 
            if($result->open_time + $requiredHintData->open_delay <= $currentTime) {
                $returnMsg['status'] = ENUM_STATUS_OK;
                $returnMsg['newHint'] = $requiredHintData->hint;
                $returnMsg['hint_index'] = $requiredHintData->hint_index;
            } else {
                $returnMsg['status'] = ENUM_HINT_STATUS_COOLDOWN;
                //Time Remaining can be calculated as 
                $secondsLeft = ($result->open_time + $requiredHintData->open_delay) - $currentTime;
                $hours = floor($secondsLeft / 3600);
                $mins = floor($secondsLeft / 60 % 60);
                $secs = floor($secondsLeft % 60);
                $returnMsg['time_left'] = "{$hours} Hours {$mins} Minutes and {$secs} Seconds";
            }
        } else {
            //Get this from the previous hint.
            if($lastHint['open_timestamp'] + $requiredHintData->open_delay <= $currentTime) {
                $returnMsg['status'] = ENUM_STATUS_OK;
                $returnMsg['newHint'] = $requiredHintData->hint;
                $returnMsg['hint_index'] = $requiredHintData->hint_index;
            } else {
                $returnMsg['status'] = ENUM_HINT_STATUS_COOLDOWN;
                //Time Remaining can be calculated as 
                $secondsLeft = ($lastHint['open_timestamp'] + $requiredHintData->open_delay) - $currentTime;
                $hours = floor($secondsLeft / 3600);
                $mins = floor($secondsLeft / 60 % 60);
                $secs = floor($secondsLeft % 60);
                $returnMsg['time_left'] = "{$hours} Hour(s) {$mins} Minute(s) and {$secs} Second(s)";
            }
        }
        //If the status is OK put the data into the DB.
        if($returnMsg['status'] == ENUM_STATUS_OK) {
            $sql = 'INSERT INTO '.DBT_USER_HINTS." VALUES ('{$this->userId}', '{$levelId}', '{$returnMsg['hint_index']}', '{$currentTime}', '1')";
            $query = $db->query($sql);
        }

        return $returnMsg;
    }

    /**
     * Method to get the score of the current user.
     */
     public function GetUserScore() {
        global $db, $user;
        $userId = $user->getUserId();

        $sql = 'SELECT '.DBT_USER.'.`score` 
                FROM '.DBT_USER.' 
                WHERE `id` = \''.$userId.'\'';
        $query = $db->query($sql);
        if($db->numRows($query) > 0)    {
            $result = $db->result($query);
            $userScore = $result->score;
            $db->freeResults($query);
            return $userScore;
        }
        return NULL;
    }

    public function GetLevelInformation($levelId) {
        $jsonMessage = array();
        if(!$this->IsLevelOpen($levelId)) {
            $jsonMessage['status'] = 'ILLEGAL';
            return json_encode($jsonMessage);
        }
        // $levelNameInformation = $this->GetLevelNameAndObjective($levelId);
        $jsonMessage['status'] = 'OK';
        $jsonMessage['stageName'] = '';
        $jsonMessage['stageObjective'] = '';
        $jsonMessage['hints'] = array();
        array_push($jsonMessage['hints'], '');
        return $jsonMessage;
    }
}

?>