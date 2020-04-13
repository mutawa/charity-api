<?php
require_once "db.php";


class Person {
    private $id;
    private $first_name;
    private $father_name;
    private $grand_name;
    private $family_name;

    function __construct($row) {
        $this->id = $row["id"];
        $this->first_name = $row["first_name"];
        $this->father_name = $row["father_name"];
        $this->grand_name = $row["grand_name"];
        $this->family_name = $row["family_name"];
    }
    
    function summary() {
        return array(
            "id" => $this->id,
            "name" => $this->first_name . " " . $this->family_name
        );
    }

    public static function count() {
        $db = DB::getInstance();
        $sql = "select count(*) cnt from chr_persons";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch();
        return $row["cnt"];
    }


    public static function all($id=null, $pn=1) {
        $offset = ($pn-1) * 10;

        $sql = "select * from chr_persons ";
        if($id != null) {
            $sql .= "where id = :id";
        }
        $sql .= " order by first_name, father_name, grand_name, family_name limit $offset,10";

        $people = array();

        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        if($id != null) {
            $stmt->bindParam(":id", $id);
        }
        
        
        
        $stmt->execute();

        while($row = $stmt->fetch()) {
            
            $people[] = new Person($row);
        }

        $reply = array();

        foreach($people as $man) {
            
            $reply[] = $man->summary();
        }
        
        return array("data" => $reply , "allRowsCount" => Person::count(), "currentCount" => count($reply));

    }

    public static function find($id) {
        return Person::all($id);
    }

    public static function delete($id = -2) {
        $confirm = Person::find($id);

        $db = DB::getInstance();
        $sql = "delete from chr_persons where id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $confirm;

    }

    public static function add() {
        $db = DB::getInstance();
        $stmt = $db->prepare("insert into chr_persons(first_name,father_name,grand_name,family_name) values (:first_name, :father_name, :grand_name, :family_name)");
        $stmt->bindParam(":first_name", $_POST["first_name"]);
        $stmt->bindParam(":father_name", $_POST["father_name"]);
        $stmt->bindParam(":grand_name", $_POST["grand_name"]);
        $stmt->bindParam(":family_name", $_POST["family_name"]);
        $stmt->execute();

        $id = $db->lastInsertId();
        return Person::find($id);


    }
}