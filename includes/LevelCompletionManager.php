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

        $sql = 'select * from ha_level_attempts WHERE level_id = '.$levelId.' and user_id = '.$userId;
        $query = $db->query($sql);

        if($db->numRows($query) <= 0) {
            $sql  = 'INSERT INTO `ha_level_attempts` (`user_id`, `level_id`, `attempt_number`, `solution`, `attempt_time`) VALUES (\''.$userId.'\', \''.$levelId.'\', \'1\', NULL, NULL)';
            $query = $db->query($sql);
            $db->freeResults($query);
            
            return "New log created";
        } else {
            $sql = 'SELECT `attempt_number`
                    FROM '.DBT_LEVEL_ATTEMPTS.'
                    WHERE `level_id` = \''.$levelId.'\'
                    AND `user_id` = \''.$userId.'\'';

            $query = $db->query($sql);
            $result = $db->result($query);
            $result = $result->attempt_number + 1;

            $db->freeResults($query);
            $sql  = 'UPDATE `ha_level_attempts` 
                        SET `attempt_number` = \''.$result.'\' 
                        WHERE `ha_level_attempts`.`user_id` = '.$userId.' AND 
                                `ha_level_attempts`.`level_id` = '.$levelId.' ';
                        
            $db->query($sql);
            $db->freeResults($query);
            
            return "Log updated";
        }

        
       /*  $query = $db->query($sql);
        $result = '';
        if($db->numRows($query) <= 0) {
                $result = '1';
        }
        else {
                
        }
        $db->freeResults($query);
        $sql = 'INSERT INTO '.DBT_LEVEL_ATTEMPTS.'(`user_id`, `level_id`, `attempt_number`, `solution`, `attempt_time`)
                    VALUES '."('{$userId}', '{$levelId}', '{$result}', '{$solution}', '{$cTime}')";
        $db->query($sql); */
        return "Some problem";
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

        if($reduction == '') {
                $reduction = '0';
        }

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
        
        //Set a all good status
        $retData['status'] = ENUM_STATUS_OK;
        //Return the data.
        return $retData;
    }
}
?>