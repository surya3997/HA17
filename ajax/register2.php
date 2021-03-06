<?php
    include '../includes/config.php';
    //header('Content-Type: application/json');
    //header('Vary: Accept-Encoding,User-Agent');
    //header('Transfer-Encoding: chunked');

    if($session->isLoggedIn()) {
        $jsonMessage['status'] = 'Session_Exists';
        $jsonMessage['message'] = 'Session_Already_Exists';
        die(json_encode($jsonMessage));
    }

    $code = clean($_POST['code']);
    $typedEmail = clean($_POST['email']);
    $password = clean($_POST['password']);
    $passwordHash = sha1($password);



    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, "https://psglogin.in/php/details.php");
    // curl_setopt($curl, CURLOPT_POST, 1);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, "code=".$code);
    // $response = curl_exec($curl);
    // $err = curl_error($curl);
    // curl_close($curl);

    // if ($err) {
    //     $jsonMessage['status'] = "Failed";
    //     $jsonMessage['message'] = 'Try after some time';
    //     die(json_encode($jsonMessage));
    // } elseif ($response === 'null') {
    //     $jsonMessage['status'] = "Failed";
    //     $jsonMessage['message'] = 'First register at PSG Login website';
    //     die(json_encode($jsonMessage));
    // } else {
    //     $values = json_decode($response);
    //     echo $values;
    //     $isAlumnus =  clean($values->alumnus);
    //     $actualEmail = clean($values->email);
    //     $firstName = clean($values->name);
    //     $rollno = clean($values->rn);
    //     $phone = clean($values->phone);
    //     $activationLink = '';
    //     if ($typedEmail == $actualEmail) {
            // valid user
            $sql = 'SELECT `email`
                    FROM '.DBT_USER.'
                    WHERE `email` = \''.$typedEmail.'\'';
            $query = $db->query($sql);
            if($db->numRows($query) > 0) {
                // invalid registration
                $jsonMessage['status'] = "Failed";
                $jsonMessage['message'] = 'Email ID Already exists.';
                die(json_encode($jsonMessage));
            }
            $db->freeResults($query);

            if ($isAlumnus == '1') {
                $clgName = "PSG";
                $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `course`, `contact`, `year_join`, `seen_announ`)
                VALUES '."('{$firstName}', '{$passwordHash}', '{$isAlumnus}', '{$actualEmail}', '{$clgName}', '{$code}', '{$activationLink}', '{$rollno}', '{$phone}', '', '0')";
            } else{
                $clgName = clean($values->cn);
                $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `course`, `contact`, `year_join`, `seen_announ`)
                VALUES '."('{$firstName}', '{$passwordHash}', '{$isAlumnus}', '{$actualEmail}', '{$clgName}', '{$code}', '{$activationLink}', '{$rollno}', '{$phone}', '', '0')";
            }

            $query = $db->query($sql);
	    $db->freeResults($query);
            if(!$query) {
                $jsonMessage['status'] = "Failed";
                $jsonMessage['message'] = 'Registration failed. Please try again after some time.';
                die(json_encode($jsonMessage));
            }

            $sql = 'SELECT `id` FROM '.DBT_USER.' WHERE LOWER(`email`) = LOWER(\''.$typedEmail.'\')';
            $query = $db->query($sql);
            $result = $db->result($query);
	    $db->freeResults($query);
            $user_id = $result->id;

            //Create all the required data.
            LevelCompletionManager::CreateInitSettings($user_id);

            $sql = "UPDATE ".DBT_SESSION." SET `login_stat` = '1' , `user_id` = '{$result->id}' WHERE `id` = '{$_SESSION['id']}'";
            $query = $db->query($sql);
	    //$db->freeResults($query);

            $jsonMessage['status'] = "Ok";
            $jsonMessage['message'] = "Successfully registered.";
            die(json_encode($jsonMessage));
    //     } else {
    //         // random person
    //         $jsonMessage['status'] = "Failed";
    //         $jsonMessage['message'] = 'Email ID doesnt match';
    //         die(json_encode($jsonMessage));
    //     }
    // }

    $jsonMessage['status'] = "unusual";
    $jsonMessage['message'] = "Less chance for this to occur!";
    echo json_encode($jsonMessage);
?>
