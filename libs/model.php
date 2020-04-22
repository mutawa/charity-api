<?php
require_once "libs/db.php";

class Model {
    public static $db;
    
    function __construct() {
        
        self::$db = DB::getInstance();
    }
}