<?php 

class Department extends AppModel {
    public $useDbConfig = 'mongodb';  
    public $useTable = 'departments';
    public $primaryKey = '_id';

    public function isValidDepartment($id=null){
        if(is_null($id) == true){
            return false;
        }
        /**
         *@var Mongodb Cursor 
         */
        $results = $this->read(array("_id"),$id);
        if ($results==null){
            return false;
        }
        return true;
    }
}