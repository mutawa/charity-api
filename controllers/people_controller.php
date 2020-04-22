<?php
class PeopleController extends Controller {
    function __construct() {
        parent::__construct();
    }
    public function all($pn) {
        require "models/people_model.php";

        $model = new PeopleModel();
        echo json_encode($model->all(null, $pn));
    }

    function getId($id) {
        if($this->isGet) {
            require "models/people_model.php";
            $model = new PeopleModel();

            echo print_r($model->all($id, 1));
        }
    }
}