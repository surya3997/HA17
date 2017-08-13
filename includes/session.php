<?php

/**
 * Description of session
 *  This class is used to maintain the session of the user. This has the constructor which enables the init checking
 *
 */


class Session {
	private $userId;
    
    public function __construct() {
        //This is the main constructor method.
        $currentTime = time();
        $currentIp = $_SERVER['REMOTE_ADDR'];
        $currentBrowser = $_SERVER['HTTP_USER_AGENT'];
        
        //We also call the global $db object.
        global  $db;	

        //Block the user if the request is from the CURL.
        if(strstr($currentBrowser, 'curl') != false) {
            die('Curl is not allowed for this website.');
        }
        
        if ( isset($_SESSION['id']))    {
            //The user has an active session. We have to validate the session.
            $sessionId = $_SESSION['id'];
            $sql = "SELECT `last_active`, `create_ip`, `browser` FROM ".DBT_SESSION." WHERE `id` = '{$sessionId}'";
            $query = $db->query($sql);
            $canValidateID = true;
            if ( $db->numRows($query) == 0)    {
                //Check if the cookie has such a session.
                if(isset($_COOKIE['PHPSESSIONID']) && $_COOKIE['PHPSESSIONID'] != '') { 
                    $cSession = clean($_COOKIE['PHPSESSIONID']);
                    //Check this session id in the DB.
                    $sql = "SELECT `last_active`, `create_ip`, `browser` FROM ".DBT_SESSION." WHERE `id` = '{$cSession}'";
                    $query = $db->query($sql);
                    if($db->numRows($query)) {
                        //We already have a valid session in the DB. SEt this to the $_SESSION['id']
                        $_SESSION['id'] = $cSession;
                    } else {
                        $canValidateID = false;
                        $this->createNewSession();
                    }
                } else {
                    //WE do not have a cookie session either. Kick this guy out.
                    $canValidateID = false;
                    $this->createNewSession();
                }
            } 
            if($canValidateID) {
                //He has a valid session in the Db. Check if it is still within 5 min activity and let him pass.
                $result = $db->result($query);
                if ( ($currentTime - intval($result->last_active)) > SESSION_LOGOUT_TIME /* 5 Mins */)    {
                    //This means that the current Session is over due. Remove it and recreate it.
                    $this->createNewSession();
                } else {
                    //We check the final stage ie) the ip and browser.
                    if ( /* $result->create_ip != $currentIp || */ $result->browser != $currentBrowser)   {
                        //The session and IP dont match. Create a new Session.
                        $this->createNewSession();
                    } else {
                        //This means that the session is valid. Update the time and let him pass.
                        $db->freeResults($query);
                        $sql = "UPDATE ".DBT_SESSION." SET `last_active` = '{$currentTime}' WHERE `id` = '{$sessionId}'";
                        if ( ! $db->query($sql) )   {
                            $db->freeResults($query);
                            die('Session Update Failed. Contact Admin.');
                        }
                    }
                }
                $db->freeResults($query);
            }
        } else {
            //This means we create a new session ID.
            if(isset($_COOKIE['PHPSESSIONID']) && $_COOKIE['PHPSESSIONID'] != '') {
                //Validate this session.
                $sessionId = clean($_COOKIE['PHPSESSIONID']);
                $sql = "SELECT `last_active`, `create_ip`, `browser` FROM ".DBT_SESSION." WHERE `id` = '{$sessionId}'";
                $query = $db->query($sql);
                if($db->numRows($query)) {
                    //We already have a valid session in the DB. SEt this to the $_SESSION['id']
                    $db->freeResults($query);
                    $_SESSION['id'] = $sessionId;
                } else {
                    $this->createNewSession();
                }
            } else {
                $this->createNewSession();
            }
        }
		//We set the userId as a private data member so that it is easier.
		$newSessionId = $_SESSION['id'];
        setcookie("PHPSESSIONID", $newSessionId, time() + SESSION_LOGOUT_TIME);
		$sql = "SELECT `user_id` FROM ".DBT_SESSION." WHERE `id` = '{$newSessionId}'";
		$query = $db->query($sql);
		if($db->numRows($query))	{
			$this->userId = $db->result($query)->user_id;
			$db->freeResults($query);
		} else {
			$this->userId = NULL;
		}
    }
    
    public function isLoggedIn()    {
        return ($this->userId != NULL);
    }
    
    public function login($username, $password) {
        // This is used to check the login credentials.
        if ($this->isLoggedIn())    {
            return false;
        } else {
            //We log the user in.
            global $db;
            $usernameClean = strtolower(trim($db->escapeString($username)));
            $passwordHash = sha1(trim($db->escapeString($password)));
            $sql = "SELECT `id` FROM ".DBT_USER." WHERE LOWER(`email`) = '{$usernameClean}' AND `pass` = '{$passwordHash}' AND `activation_link` = ''";
            $query = $db->query($sql);
            if ($db->numRows($query) > 0) {
                //We proceed to log the user in.
                $result = $db->result($query);
                $db->freeResults($query);
                $sql = "UPDATE ".DBT_SESSION." SET `login_stat` = '1' , `user_id` = '{$result->id}' WHERE `id` = '{$_SESSION['id']}'";
                $query = $db->query($sql);
                $db->freeResults($query);
                return true;
            } else {
				//False credentials. Issue login failure error.
				$db->freeResults($query);
                return false;
            }
        }
    }
    public function getActiveUsers(){
        global $db;
        $user = $this->getUserId();
        $sql = "SELECT `user_id` FROM ".DBT_SESSION." WHERE `login_stat` = '1' and `user_id` <> '{$user}' and `user_id` not in (select `player` from ".DBT_GAME.") and `user_id` not in (select `opponent` from ".DBT_GAME.")";
        $query = $db->query($sql);
       
        if($db->numRows($query) > 0){
            $activeusers = array();
            $i = 0;
            while($row = $db->result($query)){
                $activeusers[$i] = $row->user_id; 
                $i = $i + 1;
            }
            return $activeusers;
        }
        else{
            $db->freeResults($query);
            return;
        }
    }
    
    public function getUserId() {
        // This gets the user id from the instance variable.
        return $this->userId;
    }
	
	public function logout()	{
		//This is used to logout a user.
		global $db;
		
		//First lets get the session id 
		$sesId = $_SESSION['id'];
		$currentTime = time();
		//Now unset it from the db.
		//$sql = "UPDATE ".DBT_SESSION." SET `user_id` = NULL, `last_active` = '".$currentTime."', `login_stat` = '0' WHERE `id` = '{$sesId}'";
        $sql = "DELETE FROM ".DBT_SESSION." WHERE `id`= '{$sesId}'";
		$query = $db->query($sql);
        unset($_SESSION['id']);
        setcookie('PHPSESSIONID', '', time() - 100);
		return $query;
	}
    
	
    
    private function createNewSession() {
        //This is used to make a new session.
        $newSessionId = $this->createNewSessionId();
        $currentTime = time();
        $currentIp = $_SERVER['REMOTE_ADDR'];
        $currentBrowser = $_SERVER['HTTP_USER_AGENT'];
        global $db;
        
		if(isset($_SESSION['id']))	{
			//There is an active Session.
			$sql = "SELECT COUNT(`id`) as count FROM ".DBT_SESSION." WHERE `id` = '{$_SESSION['id']}'";
			$query = $db->query($sql);
			$result = $db->result($query);
			if($result->count == 0)	{
				$sql = "INSERT INTO ".DBT_SESSION." VALUES ('{$newSessionId}', NULL, '{$currentTime}', '{$currentTime}', '{$currentIp}', '{$currentBrowser}', '0')";
			} else {
				$sql = "UPDATE ".DBT_SESSION." SET `create_ip` = '{$currentIp}', `browser` = '{$currentBrowser}', `login_stat` ='0' , `user_id` = NULL, `create_time` = '{$currentTime}', `last_active` = '{$currentTime}' , `id` = '{$newSessionId}' WHERE `id` = '{$_SESSION['id']}'";
			}
			$db->query($sql);
		} else {
			$sql = "INSERT INTO ".DBT_SESSION." VALUES ('{$newSessionId}', NULL, '{$currentTime}', '{$currentTime}', '{$currentIp}', '{$currentBrowser}', '0')";
			$db->query($sql);
		}
		$_SESSION['id'] = $newSessionId;
    }
    
	
    
    private function createNewSessionId()   {
        //This function is used to create a new id.
        $stringToCrpyt = generateRandString(6);
        $encrpytedString = sha1($stringToCrpyt);

        global $db;
        
        $sql = "SELECT `id` FROM ".DBT_SESSION." WHERE `id` = '{$encrpytedString}'";
        $query = $db->query($sql);
        

        while($db->numRows($query) > 0) {
            $stringToCrypt = generateRandString(6);
            $db->freeResults($query);
            $encrpytedString = sha1($stringToCrypt);
            $query = $db->query($sql);
        }
        $db->freeResults($query);
        return $encrpytedString;
    }
}

?>