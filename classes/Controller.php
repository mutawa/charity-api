<?php
$action = null;
$arg = null;
$id = -1;

$_POST = json_decode(file_get_contents("php://input"),true);


if(isset($_GET["action"])) {
    $action = $_GET["action"];
}

if(isset($_GET["arg"])) {
    $arg = $_GET["arg"];
}

if(isset($_POST["id"])) {
    $id = $_POST["id"];
} else {
    ;
    //echo "no id supplied";
}
header("Content-Type: application/json; charset=utf-8");
