<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynamicForm
 *
 * @author gautam
 */
class DynamicForm extends AppModel {
    public $useDbConfig = 'mongodb';  
    public $useTable = 'dynamicForms';
    public $primaryKey = '_id';
    public function setSchema($schema) {
        $this->_schema=$schema;        
    }
    
    
    /**
     * This method can be used to check if a form is valid
     * 
     * A form is valid if a configuration corresponding to the id is 
     * present in the mongodb database.
     * 
     * @param type $id 
     * @return boolean if form is not valid
     * @return mixed if form is valid (the form data from the database).
     */ 
    public function isValidForm($id=null) {
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
    
    public function getSchema(){
        return $this->_schema;
    }
    
    
}
