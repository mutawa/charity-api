<?php

class DB {
    private static $instance;
    private function __construct() {}
    public static function getInstance() {
        if (DB::$instance == null) {
            $host    = 'localhost';
            $db      = 'abunoor9_charity';
            $user    = 'abunoor9_charityer';
            $pass    = 'jump2123';
            $charset = 'utf8';
            $opt = array(
                PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES		=> false,
            );

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            DB::$instance = new PDO($dsn,$user,$pass,$opt);
        
        }
        return DB::$instance;
    }
}