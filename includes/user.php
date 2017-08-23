<?php
	/*
	 * This class contains all the things related to the user.
	 */
	class User 	{
		private $userId;
		private $userName;
		private $userType;
	
		public function __construct()	{
			//This inits the user id with which most of the operations will be done.
			global $session, $db;
			if($session->isLoggedIn())	{
				//we have to get the user id from the session and from it the username.
				$this->userId = $session->getUserId();
				
				$sql = "SELECT `name`, `type` FROM ".DBT_USER." WHERE `id` = '{$this->userId}'";
				$query = $db->query($sql);
				if (!$db->numRows($query))	{
					//No user found with that ID. Kill the session.
					$session->logout();
				} else {
					//We have a user. Get the name
					$result = $db->result($query);
					$this->userName = $result->name;
					if($result->type == 1) {
						$this->userType = UT_ALUMNI;
					} else {
						$this->userType = UT_COLLEGE;
					}
					$db->freeResults($query);
				}
			} else {
				$this->userId = null;
				$this->userName = null;
				$this->userType = null;
			}
		}

		public function getUserId() {
			return $this->userId;
		}

		public function getUserName() {
			return $this->userName;
		}

		public function GetUserType() {
			return $this->userType;
		}
		
		//OBSOLETE
		public static function createNewUser($username, $password, $type, $email)	{
			//This is used to create a new user.
			global $db, $session;
			$usernameClean = clean($username);
			$usernameLower = strtolower($usernameClean);
			$passwordClean = clean($password);
			$emailClean = clean($email);
			//Check fi the user already exists
			$sql = "SELECT COUNT(`id`) as t_count FROM ".DBT_USER." WHERE LOWER(`name`) = '{$usernameLower}'";
			$query = $db->query($sql);
			$result = $db->result($query);
			$db->freeResults($query);
			if($result->t_count == 0)	{
				//Register the user.
				$passHash = sha1($passwordClean);
				$sql = "INSERT INTO ".DBT_USER." VALUES (NULL, '{$usernameClean}', '{$passHash}', '0', '0', 'default_avatar', '{$emailClean}')";
				$query = $db->query($sql);
				if($query)	{
					if($session->login($username, $password))	{
						return self::OPERATION_SUCCESS;
					}
				}
			} else {
				return self::USER_EXISTS;
			}
			return self::OPERATION_FAILED;
		}

		const USER_EXISTS = -1;
		const OPERATION_FAILED = -2; 
		const OPERATION_SUCCESS = 0;
	}
?>