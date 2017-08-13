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

	$rootpath = $_SERVER['DOCUMENT_ROOT'].'/HA17/';

	$session = new Session();
		

?>
