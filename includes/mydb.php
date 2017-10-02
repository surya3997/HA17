<?php

/*
 * This has the connection to the mysql database.
 */
class DB    {
    private $con;

    /* Must be changed for requirement */
    private $dbHost = 'localhost';
    private $dbUser = 'ha';
    private $dbPass = 'ha';
    private $dbName = 'ha';
  
    //This is the constructor
    function __construct() {
        $this->con = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if (mysqli_connect_errno())  {
            die('Could not Connect to the DataBase.');
        }
    }
    
    function __destruct()   {
        mysqli_close($this->con);
    }
    
    public function escapeString($str)  {
        return mysqli_real_escape_string($this->con, $str);
    }
    
    public function freeResults($result)   {
        if(is_a($result, 'mysqli_result'))  {
            @mysqli_free_result($result);
        }
    }
    
    public function name() {
        return $this->dbName;
    }
    
    public function result($query)  {
        $result =  mysqli_fetch_object($query);
        return $result;
    }
    
    public function numRows($query)  {
        return mysqli_num_rows($query);
    }
    
    public function query($sqlQuery) {
        /**
         * This function is used to perform mysql_query() (or) mysqli_query() on the open Connection.
         */
        if($query = mysqli_query($this->con, $sqlQuery))    {
            return $query;
        } else {
             die('SQL Error'); //.$sqlQuery);
        }
    }
    
}
?>
