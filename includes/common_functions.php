<?php

/*
 * This contains all the common functions.
 */

function generateRandString($length)	{
    //This generates a random string of $length charecters long
    $randomString = '';
    $range = str_split('abcdefghijklmnopqrstuvwxyz1234567890<>?:"{}!@#$%^&*()_+', '1');
    for($i = 0; $i < $length; $i++)	{
        $randomString .= array_rand($range);
    }
    return $randomString;
}

function clean($toCleanStr)	{
	global $db;
	return $db->escapeString(trim($toCleanStr));
}

/**
 * This method is used to redirect the user to a required page.
 */
function PageRedirect($toPage) {
    switch($toPage) {
        case 'login':
            header('Location:login.php');
            break;
        case 'index':
        default:
            header('Location:index.php');
            break;
    }
}

function Dconsole( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
        echo "<script>alert( '" . $output . "' );</script>";
    }

?>
