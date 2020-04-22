<?php

class PersonModel extends Model {
    
    public $id;
    public $first_name;
    public $father_name;
    public $grand_name;
    public $family_name;

    function __construct($array=null) {
        parent::__construct();
        
        if($array!=null) {
            foreach($array as $key => $value) {
                $this->{$key} = $value;
            }
        }
        
        
        
    }
    
    function updateFrom(PersonModel $another) {
        $id = $this->id;

        foreach (get_object_vars($another) as $key => $value) {
            $this->$key = $value;
        }

        $this->id = $id;

        // foreach($another as $key => $value) {
        //     $this->{$key} = $value;
            
        // }

        // $this->first_name = $another->first_name;
        // $this->father_name = $another->father_name;
        // $this->grand_name = $another->grand_name;
        // $this->family_name = $another->family_name;
    }

    function getDisplayName() {
        return "name: [" . $this->id . "-" . $this->first_name . " " . $this->family_name . "]";
    }


    public function delete() {
        
        $db = self::$db;
        $sql = "delete from chr_persons where id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

    }


    public function insert() {

        

        $db = self::$db;
        $stmt = $db->prepare("insert into chr_persons(first_name,father_name,grand_name,family_name) values (:first_name, :father_name, :grand_name, :family_name)");
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":father_name", $this->father_name);
        $stmt->bindParam(":grand_name", $this->grand_name);
        $stmt->bindParam(":family_name", $this->family_name);
        $stmt->execute();

        $this->id = $db->lastInsertId();
        //return Person::find($id);


    }

    public function update() {
        $db = self::$db;
        $stmt = $db->prepare("update chr_persons set first_name=:first_name,
                                                     father_name=:father_name,
                                                     grand_name=:grand_name,
                                                     family_name=:family_name
                                                     
                                                     where id=:id
                                                     ");
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":father_name", $this->father_name);
        $stmt->bindParam(":grand_name", $this->grand_name);
        $stmt->bindParam(":family_name", $this->family_name);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $this->id = $db->lastInsertId();
        //return Person::find($id);


    }

    function find($id) {

        $sql = "select * from chr_persons where id = :id";
        $people = array();

        $db = parent::$db;
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        
        $man = null;
        if($row = $stmt->fetch()) {
            $man = new PersonModel($row);
        }
        return $man;
    }
}