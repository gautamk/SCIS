<?php
class DynamicFormResponse extends AppModel {
	public $name="DynamicFormResponse";
	public $useDbConfig = 'mongodb';
	public $useTable = 'dynamicFormResponse';
	public $primaryKey = '_id';
	public $validate = array();
	public $actsAs=array('Mongodb.Schemaless');
	public function getDefaults(){
		$brsr = get_browser(null,true);
		$browser = array();
		$browser["browser_name_pattern"] = $brsr["browser_name_pattern"];
		$browser["parent"] = $brsr["parent"];
		$browser["platform"] = $brsr["platform"];
		$defaultValues=array(
			"escalation"=>Configure::read("scis.ticket.escalation.default"),
			"status"=>Configure::read("scis.ticket.status.default"),
			"department_id"=>NULL,
			"priority"=>Configure::read("scis.ticket.priority.default"),
			"browser"=>$browser,
		);
		return $defaultValues;
	}
	
	
	
	/**
	 * Extends beforeSave() to add default values
	 *
	 * @param array $options
	 * @return bool
	 */
	public function beforeSave($options = array()) {
		// Add default values if not set already
		foreach ($this->getDefaults() as $fieldName => $defaultValue) {
			if (empty($this->data[$this->alias][$fieldName])){
				//$this->data[$this->alias][$fieldName] = $defaultValue;
				$this->set($fieldName,$defaultValue);
			}
				
		}
		

		$this->set($this->data);
		return parent::beforeSave($options);
	}
	/*
	public function save($data = null, $validate = true, $fieldList = array()){
		debug($data);
		debug($validate);
		debug($fieldList);
		return parent::save( $data ,  $validate ,  $fieldList);
	}
	*/
	
	public function setSchema($schema) {
		$this -> _schema = $schema;
	}

	public function getSchema() {
		return $this -> _schema;
	}

	public function isValidResponse($id=null){
		if(is_null($id) == true){
			return false;
		}
		/**
		 *@var Mongodb Cursor 
		 */
		$results = $this->read(null,$id);
		return $results==null ? false : $results;
	}

}
