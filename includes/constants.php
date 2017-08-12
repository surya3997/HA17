<?php
	define('SESSION_LOGOUT_TIME', 3600); //Idle time after which the user is logged out.

	define('MAX_SCORE_POSSIBLE', 200);

	define('CHECK_TIME_SPENT_INTERVAL', 5);

	//Constants required for transmitting the AJAX reply
	define('ENUM_STATUS_OK', 'OK');
	define('ENUM_STATUS_ILLEGAL', 'ILLEGAL');
	define('ENUM_STATUS_FAILED', 'FAILED');
	define('ENUM_STATUS_AUTH_FAILED', 'AUTH_FAILED');

	//Constants required for sending the hint. Without these there will be confusion between status variables
	define('ENUM_HINT_STATUS_OVER', 'ENUM_HINT_STATUS_OVER'); /* End of hints for this level */
	define('ENUM_HINT_STATUS_COOLDOWN', 'ENUM_HINT_STATUS_COOLDOWN'); /* Have to wait for next hint */

	define('ENUM_STATUS_LEVEL_DONE', 'ENUM_STATUS_LEVEL_DONE');	/* Denotes that the level is already completed. */

	define('ENUM_STATUS_BW_COOLDOWN', 'ENUM_STATUS_BW_COOLDOWN');	/* To denote that the user is on cool down from more submission. */
	define('ENUM_STATUS_LOST', 'ENUM_STATUS_LOST'); /* To Denote lack of score to cross to the next level */
	define('BOTWARS_9_COOLDOWN', 600);

	/* User Types */
	define('UT_ALUMNI', 'UT_ALUMNI');
	define('UT_COLLEGE', 'UT_COLLEGE');
?>