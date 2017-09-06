<?php
    include '../includes/config.php';
    
    if($session->isLoggedIn()) {
        $jsonMessage['status'] = 'Session_Exists';
        die(json_encode($jsonMessage));
    }
    
    $code = clean($_POST['code']);
    $typedEmail = clean($_POST['email']);
    $password = clean($_POST['password']);
    $passwordHash = sha1($password);
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://psglogin.in/php/details.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"code\"\r\n\r\n".$code."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
            "postman-token: f0baf6d4-7ea9-9c8a-cea2-9361da8dfdb3"
        ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        $jsonMessage['status'] = "Failed";
        $jsonMessage['message'] = 'API error';
        die(json_encode($jsonMessage));
    } elseif ($response === 'null') {
        $jsonMessage['status'] = "Failed";
        $jsonMessage['message'] = 'Wrong Code';
        die(json_encode($jsonMessage));
    } else {
        $values = json_decode($response);
        
        $isAlumnus =  clean($values->alumnus);
        $actualEmail = clean($values->email);
        $firstName = clean($values->name);
        $rollno = clean($values->rn);
        $phone = clean($values->phone);
        $activationLink = '';
        
        if ($typedEmail == $actualEmail) {
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
            
            // valid registration
            if ($isAlumnus == '1') {
                $clgName = "PSG";
                $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `course`, `contact`, `year_join`, `seen_announ`)
                VALUES '."('{$firstName}', '{$passwordHash}', '{$isAlumnus}', '{$actualEmail}', '{$clgName}', '{$code}', '{$activationLink}', '{$rollno}', '{$phone}', '', '0')";
            } elseif ($isAlumnus == '0'){
                $clgName = clean($values->cn);
                $sql = 'INSERT INTO '.DBT_USER.'(`name`, `pass`, `type`, `email`, `lname`, `code`, `activation_link`, `course`, `contact`, `year_join`, `seen_announ`)
                VALUES '."('{$firstName}', '{$passwordHash}', '{$isAlumnus}', '{$actualEmail}', '{$clgName}', '{$code}', '{$activationLink}', '{$rollno}', '{$phone}', '', '0')";
            }
            //echo $sql;

            $query = $db->query($sql);
            if(!$query) {
                $jsonMessage['status'] = "Failed";
                $jsonMessage['message'] = 'Registration failed. Please try again after some time.';
                die(json_encode($jsonMessage));
            }

            
            $sql = 'SELECT `id` FROM '.DBT_USER.' WHERE LOWER(`email`) = LOWER(\''.$email.'\')';
            $query = $db->query($sql);
            $result = $db->result($query);
            $user_id = $result->id;

            //Create all the required data.
            LevelCompletionManager::CreateInitSettings($user_id);

            $sql = "UPDATE ".DBT_SESSION." SET `login_stat` = '1' , `user_id` = '{$result->id}' WHERE `id` = '{$_SESSION['id']}'";
            $query = $db->query($sql);

            $jsonMessage['status'] = "Ok";
            $jsonMessage['message'] = "Successfully registered.";
            die(json_encode($jsonMessage));
            
        } else {
            // random person
            $jsonMessage['status'] = "Failed";
            $jsonMessage['message'] = 'Email ID doesnt match';
            die(json_encode($jsonMessage));
        }
    
    }

    $jsonMessage['status'] = "unusual";
    $jsonMessage['message'] = 'Less chance for this to occur!';
    echo json_encode($jsonMessage);
 
?>
