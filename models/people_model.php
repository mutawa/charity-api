<?php
class PeopleModel extends Model {
    function __construct() {
        parent::__construct();
    }

    
    public function all($id=null, $pn=1) {
        

        $offset = ($pn-1) * 10;

        $sql = "select * from chr_persons ";
        if($id != null) {
            $sql .= "where id = :id";
        }
        $sql .= " order by first_name, father_name, grand_name, family_name limit $offset,10";

        $people = array();

        $db = parent::$db;
        $stmt = $db->prepare($sql);
        if($id != null) {
            $stmt->bindParam(":id", $id);
        }
        
        
        
        $stmt->execute();
        

        while($row = $stmt->fetch()) {
            
            $people[] = new PersonModel($row);
        }

        $reply = array();

        foreach($people as $man) {
            
            $reply[] = $man->summary();
        }
        
        return $reply;

    }

    
}