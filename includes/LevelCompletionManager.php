<?php

/**
 * Class that is used to handle the tasks of completing a level.
 * Does all the heavy work such as DB modification and other required items.
 */

class LevelCompletionManager {
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

        /* change this */
        /* //Insert the flash light. 
        $sql = 'INSERT INTO '.DBT_USER_ITEMS.'(`item_id`, `user_id`, `added_timestamp`)
                VALUES '."('2', '{$userId}', '{$cTime}')";
        $db->query($sql); */

        //Add the time in level thing.
        $sql = 'INSERT INTO '.DBT_LEVEL_USER_DATA.'(`level_id`, `user_id`, `data_key`, `data_value`)
                VALUES '."('1', '{$userId}', 'time_spent', '0')";
        $db->query($sql);
    }
}
?>