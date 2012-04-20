<?php 

class Department extends AppModel {
    public $useDbConfig = 'mongodb';  
    public $useTable = 'departments';
    public $primaryKey = '_id';

    public $validate=array(
            'name' => array(
                'alphaNumeric' => array(
                    'rule'     => 'alphaNumeric',
                    'required' => true,
                    'message'  => 'Alphabets and numbers only',
                    'allowEmpty' => false
                )
            ),
            "description"=>array(
                "minLength"=>array(
                    'rule'    => array('minLength', '30'),
                    'message' => 'Minimum 30 characters long',
                    'allowEmpty' => false
                )
            ),

    );

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