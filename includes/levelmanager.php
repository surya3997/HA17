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
        return true;
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
}

?>