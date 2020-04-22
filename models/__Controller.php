<?php
$method = $_SERVER["REQUEST_METHOD"];

$_PUT;
$_DELETE;

switch($method) {
    case "PUT": parse_str(file_get_contents("php://input"), $_PUT); break;
    case "POST": $_POST = json_encode(file_get_contents("php://input"), true); break;
    case "DELETE": $_DELETE = json_encode(file_get_contents("php://input"), true); break;
}

$action = null;
$arg = null;
$id = -1;


$data = json_encode(file_get_contents("php://input"), true);

$uri = explode("/", $_SERVER["REQUEST_URI"]);


if(isset($_GET["action"])) {
    $action = $_GET["action"];
}

if(isset($_GET["arg"])) {
    $arg = $_GET["arg"];
}

if(isset($data["id"])) {
    $id = $data["id"];
} else {
    $id = $uri[3];
}

header("Content-Type: application/json; charset=utf-8");
