<?php
	$dbName = $db->name();
	$db_prefix = 'ha_';	//This should be changed when hosted.
	/* Define all table names as constants */
	define('DBT_USER'				, "`{$dbName}`.`{$db_prefix}user`");
	define('DBT_LEVEL'				, "`{$dbName}`.`{$db_prefix}level`");
	define('DBT_SCORE'				, "`{$dbName}`.`{$db_prefix}score`");
	define('DBT_SESSION'			, "`{$dbName}`.`{$db_prefix}session`");
	define('DBT_CONFIG'				, "`{$dbName}`.`{$db_prefix}config`");
	define('DBT_LEVEL_ORDER'		, "`{$dbName}`.`{$db_prefix}level_order`");
	/* Table Replaced by DBT_USER_LEVELS
	 * define('DBT_LEVEL_COMPLETION'	, "`{$dbName}`.`{$db_prefix}level_completion`"); 
	 */
	define('DBT_USER_LEVELS'		, "`{$dbName}`.`{$db_prefix}user_levels`");
	define('DBT_LEVEL_HINTS'		, "`{$dbName}`.`{$db_prefix}level_hints`");
	define('DBT_USER_HINTS'			, "`{$dbName}`.`{$db_prefix}user_hints`");
	define('DBT_INVENTORY_ITEMS'	, "`{$dbName}`.`{$db_prefix}inventory_items`");
	define('DBT_USER_ITEMS'			, "`{$dbName}`.`{$db_prefix}user_items`");
	define('DBT_LEVEL_USER_DATA'	, "`{$dbName}`.`{$db_prefix}level_user_data`");
	define('DBT_LEVEL_ATTEMPTS'		, "`{$dbName}`.`{$db_prefix}level_attempts`");
	define('DBT_COLLEGE_CODE'		, "`{$dbName}`.`{$db_prefix}college_code`");
	define('DBT_ANNOUNCEMENTS'		, "`{$dbName}`.`{$db_prefix}announcements`");
	define('DBT_BOTWARS_CODE'		, "`{$dbName}`.`{$db_prefix}bw_code`");
	
	define('DBT_GAME'               , "`{$dbName}`.`game`");
    define('DBT_MOVES'              , "`{$dbName}`.`moves`");
	
?>