<?php


class DynamicFormResponse extends AppModel{
    public $useDbConfig = 'mongodb';  
    public $useTable = 'dynamicFormsResponse';
    public $primaryKey = '_id';
    public $validate=array();
    
    public function setSchema($schema) {
        $this->_schema=$schema;        
    }
    public function getSchema(){
        return $this->_schema;
    }
    
}