<?php


require_once "../classes/Controller.php";
require_once "../classes/Person.php";


switch($method) {
    case "GET":
        if(is_numeric($action)) {
            echo json_encode(Person::find($action));
        } else {
            echo json_encode(Person::all(null, $arg));
        }
    break;
    case "PUT":
        global $_PUT;
        echo json_encode(Person::add($_PUT));
    break;
    case "DELETE":
        echo json_encode(Person::delete($id));
        //echo json_encode(array("want" => $id));
        
    break;
    case "POST":
    break;
    default:
    die("method [$method / $action] is not supported");
}




exit;
