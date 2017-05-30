<?php

  /**
  * 
  */
  class Settings 
  {
    
    protected static $host = 'localhost';
    protected static $db   = 'database_name';
    protected static $user = 'root';
    protected static $password = '';
    protected static $charset = 'utf8';
    protected static $opt = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    public static function get() {
      $connectionString = "mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset;
      return [$connectionString, self::$user, self::$password, self::$opt];
    }

  }
  

  
  
