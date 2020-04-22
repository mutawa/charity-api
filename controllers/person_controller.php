<?php

class PersonController extends Controller {
    

    function __construct() {
        parent::__construct();
        
        //echo "we are in the person controller";
        
        
    }

    public function add() {
        if($this->isPut) {
            require "models/person_model.php";
            $newPerson = new PersonModel($_POST);
            $newPerson->insert();
            echo json_encode($newPerson);
        }
    }

    function getId($id) {

        require "models/person_model.php";
        
        

        
        $model = new PersonModel();
        $man = $model->find($id);

        if($this->isGet) {
            
            
            echo json_encode($man);

        } elseif ($this->isPost) {
            
            $newMan = new PersonModel($_POST);
            $man->updateFrom($newMan);
            $man->update();

            
        } elseif ($this->isPut) {
            throw new Exception("can't PUT a person with id. Use /api/person instead");
        } elseif ($this->isDelete) {
            $man->delete();
        }
        
    }

    function jump() {
        echo "jump---------";
        
    }
}
