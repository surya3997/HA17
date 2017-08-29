<?php

/**
 * Class that is used to handle the tasks of completing a level.
 * Does all the heavy work such as DB modification and other required items.
 */

class LevelCompletionManager {

        /**
     * This is used to check if a level can be completed by checking the closed time stamp of said level.
     */
    public static function IsLevelCompletable($levelId) {
        global $db, $user;
        //Check the level_completion table
        $sql = 'SELECT `close_time`
                    FROM '.DBT_USER_LEVELS.'
                    WHERE `level_id` = \''.$levelId.'\'
                        AND `user_id` = \''.$user->getUserId().'\'';
        $query = $db->query($sql);
        if($db->numRows($query) <= 0) {
            return false;
        }
        //Check if it is not null
        $result = $db->result($query);
        $db->freeResults($query);
        return ($result->close_time == NULL);
    }

    /**
     * Method to open up the various things required for the first round.
     */
     public static function CreateInitSettings($userId) {
        global $db;
        $cTime = time();
        //Insert the first level.
        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '1', '0')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '2', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '3', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '4', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '5', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '6', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '7', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '8', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '9', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '10', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '11', '1')";
        $db->query($sql);

        $sql = 'INSERT INTO '.DBT_USER_LEVELS.'(`user_id`, `level_id`, `anim_viewed`)
                VALUES '."('{$userId}', '12', '1')";
        $db->query($sql);

        //Add the time in level thing.
        $sql = 'INSERT INTO '.DBT_LEVEL_USER_DATA.'(`level_id`, `user_id`, `data_key`, `data_value`)
                VALUES '."('1', '{$userId}', 'time_spent', '0')";
        $db->query($sql);
    }

    /**
     * Method to log the various attempts made by the users. 
     * Made to stop plagarism.
     */
     public static function LogCompletionAttempt($levelId, $solution) {
        global $user, $db;
        $userId = $user->getUserId();
        $cTime = time();
        //First get the previous attempt number.
        $sql = 'SELECT MAX(`attempt_number`) as max_attempt_number
                    FROM '.DBT_LEVEL_ATTEMPTS.'
                    WHERE `level_id` = \''.$levelId.'\'
                        AND `user_id` = \''.$userId.'\'';
        $query = $db->query($sql);
        $result = $db->result($query);
        $result = $result->max_attempt_number + 1;
        $db->freeResults($query);
        $sql = 'INSERT INTO '.DBT_LEVEL_ATTEMPTS.'(`user_id`, `level_id`, `attempt_number`, `solution`, `attempt_time`)
                    VALUES '."('{$userId}', '{$levelId}', '{$result}', '{$solution}', '{$cTime}')";
        $db->query($sql);
    }

    /**
     * Method for calculating the score of the current level.
     * Does some computation to check the hints opened by the user and such.
     */
     private static function AddScoreForLevel($levelId) {
        global $db, $user;
        $userId = $user->getUserId();
        //First get the score of the level.
        $sql = 'SELECT `max_score`
                    FROM '.DBT_LEVEL.'
                    WHERE `id` = \''.$levelId.'\'';
        $query = $db->query($sql);
        $result = $db->result($query);
        $db->freeResults($query);
        $maxScore = intval($result->max_score);
        //Get all the hints that were brought by the user and their costs.
        $sql = 'SELECT SUM(`pts_reduction`) as `total_reduction`
                    FROM '.DBT_USER_HINTS.', '.DBT_LEVEL_HINTS.'
                    WHERE '.DBT_USER_HINTS.'.`user_id` = \''.$userId.'\'
                        AND '.DBT_USER_HINTS.'.`user_opened` = \'1\'
                        AND '.DBT_USER_HINTS.'.`level_id` = \''.$levelId.'\'
                        AND '.DBT_USER_HINTS.'.`level_id` = '.DBT_LEVEL_HINTS.'.`level_id`
                        AND '.DBT_USER_HINTS.'.`hint_index` = '.DBT_LEVEL_HINTS.'.`hint_index`';
        $query = $db->query($sql);
        $reduction = $db->result($query)->total_reduction;
        $grossScore = $maxScore - $reduction;
        $cTime = time();
        //Insert this into the DB
        $sql = 'INSERT INTO '.DBT_SCORE.'(`user_id`, `level_id`, `reduction`, `gross_score`, `remark`, `timestamp`)
                    VALUES '."('{$userId}', '{$levelId}', '{$reduction}', '{$grossScore}', 'Level{$levelId} Completion', '{$cTime}')";
        $query = $db->query($sql);
    }

    /**
     * Method to complete the Level 1
     */
     public static function CompleteLevel($levelId) {
        global $db, $user;
        $userId = $user->getUserId();
        //Complete the level by adding the close time. 
        $cTime = time();
        $retData = array();
        $retData['status'] = ENUM_STATUS_FAILED;
        //Check if this level requires completion.
        if(!LevelCompletionManager::IsLevelCompletable($levelId)) {
            $retData['status'] = ENUM_STATUS_LEVEL_DONE;
        }
        $sql = 'UPDATE '.DBT_USER_LEVELS.'
                    SET `close_time` = \''.$cTime.'\'
                    WHERE `user_id` = \''.$userId.'\'
                        AND `level_id` = \''.$levelId.'\'';
        $query = $db->query($sql);
        //Calculate the score for the user.
        //First get the maximum score for that level.
        LevelCompletionManager::AddScoreForLevel($levelId);
        //Now get the next few levels that have to be opened up. 
        /* $sql = 'SELECT `to`
                FROM '.DBT_LEVEL_ORDER.'
                WHERE `from` = \''.$levelId.'\'';
        $query = $db->query($sql);
        if($db->numRows($query) > 0) {
            while(($row = $db->result($query)) != NULL) {
                //First check if this already exists in the user. This is mainly required when it is level 7 that is to be opened.
                if($row->to == '7') {
                    $sql = 'SELECT * 
                            FROM '.DBT_USER_LEVELS.'
                            WHERE `user_id` = \''.$userId.'\'
                                AND `level_id` = \'7\'';
                    $query = $db->query($sql);
                    if($db->numRows($query) > 0) {
                        $db->freeResults($query);
                        continue; // No need to insert. Already exists.
                    }
                }
                //Add these to the open levels.
                $sql = 'INSERT INTO '.DBT_USER_LEVELS."
                            (`user_id`, `level_id`, `open_time`, `close_time`)
                            VALUES('{$userId}', '{$row->to}', NULL, NULL)";
                $db->query($sql);
                //Add time spend LEVEL_USER_DATA 
                $lvlDataMgr = new LevelDataManager($row->to);
                $lvlDataMgr->SetData('time_spent', '0');
            }
            $db->freeResults($query);
        } */
        //Add the required inventory items to the game.
        //LevelCompletionManager::AddInventoryItems($levelId);
        //Set a all good status
        $retData['status'] = ENUM_STATUS_OK;
        //Return the data.
        return $retData;
    }
}
?>