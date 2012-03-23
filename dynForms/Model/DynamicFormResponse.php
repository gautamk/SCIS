<?php


class DynamicFormResponse extends AppModel{
    public $useDbConfig = 'mongodb';  
    public $useTable = 'dynamicFormsResponse';
    public $primaryKey = '_id';
    public $validate=array();
    
    public $mongoschema = array(
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime'),
        'escalation'=>array(
            'type'=>"integrer",
            "default value"=>0
            ),
        "status"=>array(
            "type"=>"string",
            "default value"=>"pending"
            ),
        
    );
    
    public function setSchema($schema) {
        $this->_schema=$schema;        
    }
    public function getSchema(){
        return $this->_schema;
    }
    
}