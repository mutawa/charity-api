<?php
class Bootstrap {
    function __construct() {
        $url;

        if(isset($_GET["url"])) {
            $url = explode("/", rtrim($_GET["url"],"/"));
            
        } else {
            $url = array("index");
        }

     

        $file = "controllers/" . $url[0] . "_controller.php";
        if(file_exists($file)) {
            require $file;
        } else {
            require "controllers/error_controller.php";
            return new ErrorController($url[0]);

            //throw new Exception("Could not load controller [$file]");
        }
        
        $class = $url[0] . "Controller";

        $controller;
        try {
            $controller = new $class;
        } catch (Exception $ex) {
            require "controllers/error_controller.php";
            return new ErrorController();
        }
        

        if(isset($url[1])) {

            if(isset($url[2])) {
                $controller->{$url[1]}($url[2]);
            } else {
                if(is_numeric($url[1])) {
                    
                    $controller->getId($url[1]);
                } else {
                    $controller->{$url[1]}();
                }
                
            }
    
        }

    }
}