<?php
abstract class Controller {
    function __construct() {
        $this->view = new View();
        $this->isPut = false;
        $this->isGet = false;
        $this->isPost = false;
        $this->isDelete = false;
        $method = $_SERVER["REQUEST_METHOD"];
        header("Content-Type: application/json; charset=utf-8");

        switch($method) {
            case "GET":
                //$_GET = json_decode(file_get_contents("php://input"), true);
                $this->isGet = true;
            break;
            case "POST":
                $_POST = json_decode(file_get_contents("php://input"), true);
                $this->isPost = true;
            break;
            case "PUT":
                $_POST = json_decode(file_get_contents("php://input"), true);
                $this->isPut = true;
            break;
            case "DELETE":
                $_POST = json_decode(file_get_contents("php://input"), true);
                $this->isDelete = true;
            break;
            default:
            throw new Exception("Method [$method] is not supported.");

        }
        
        
    }

    function getId($id) {
        echo __CLASS__ . " got id $id";
    }
}