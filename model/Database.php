<?php

class Database 
{
    private static $dbName = 'agnaldo-mendes-livro' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
     
    private static $conn  = null;
     
    public function __construct() {
        
    }
     
    public static function connect()
    {
       if ( null == self::$conn )
       {     
        try
        {
          self::$conn =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$conn;
    }
     
    public static function disconnect()
    {
        self::$conn = null;
    }
}

?>
