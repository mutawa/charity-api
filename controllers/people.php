<?php


require_once "../classes/Controller.php";
require_once "../classes/Person.php";



if(is_numeric($action)) {
    echo json_encode(Person::find($action));
} else {
    switch($action) {
        case "all":
            echo json_encode(Person::all(null, $arg));
        break;
        case "delete":
            echo json_encode(Person::delete($id));
        break;
        case "add":
            echo json_encode(Person::add());
        break;
        default:
            
            die("unsupported action [$action is not supported]");
    
    }
}



exit;
