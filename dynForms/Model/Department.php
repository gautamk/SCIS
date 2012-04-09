<?php 

class Department extends AppModel {
    public $useDbConfig = 'mongodb';  
    public $useTable = 'departments';
    public $primaryKey = '_id';

    public isValidDepartment($id){
        if(is_null($id) == true){
            return false;
        }
        /**
         *@var Mongodb Cursor 
         */
        $results = $this->read(null,$id);
        if ($results==null){
            return false;
        }
        return $results;
    }
}