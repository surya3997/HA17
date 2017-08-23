<?php
/*
 * This is the main configuration file that is included in all the pages.
 */
	session_start();

	include_once 'constants.php';

	//We invoke the DB first as we need it everywhere else.
	include_once 'mydb.php';
	$db = new DB();

	//Now we include all the table names constants
	include_once 'db_table.php';

	//This holds all the general functions.
    include_once 'common_functions.php';

	//Now we invoke the session
    include_once 'session.php';

	//This is for sending mail and stuff. 
	include_once 'emailSender.php';

	//This is for handling data related to the level. 
	include_once 'LevelCompletionManager.php';

	//Now we include the template.
	include_once 'template.php';
	
	//This is for the levels
	include_once 'levelmanager.php';

	$rootpath = $_SERVER['DOCUMENT_ROOT'].'/HA17/';

	$session = new Session();

	//We invoke the user class 
	include_once 'user.php';

	$user = new User(); 
	$levelMgr = new LevelManager();
	$template = new Template();
	
	//This is for handling data related to the level. 
	include_once 'LevelDataManager.php';
?>
