<?php 
    include 'includes/config.php';

    $email = strtolower(urldecode(clean($_GET['email'])));
    $activationCode = urldecode(clean($_GET['verification_code']));

    //Check if such a record exists in the db 
    $sql = 'SELECT `id` 
            FROM '.DBT_USER.'
            WHERE LOWER(`email`) = \''.$email.'\'
                AND `activation_link` = \''.$activationCode.'\'';
    $query = $db->query($sql);
    if($db->numRows($query) == 1) {
        //We have a valid user.
        $result = $db->result($query); 
        $sql = 'UPDATE '.DBT_USER.'
                SET `activation_link` = \'\'
                WHERE `id` = \''.$result->id.'\'';
        $query = $db->query($sql);
        LevelCompletionManager::CreateInitSettings($result->id);
        //Log the User in. 
        $sql = "UPDATE ".DBT_SESSION." SET `login_stat` = '1' , `user_id` = '{$result->id}' WHERE `id` = '{$_SESSION['id']}'";
        $query = $db->query($sql);
        header('Location:index.php');
    } else {
        die('Invalid verification code.');
    }

?>