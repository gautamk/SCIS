<?php
class DynamicFormResponse extends AppModel {
	public $name="DynamicFormResponse";
	public $useDbConfig = 'mongodb';
	public $useTable = 'dynamicFormResponse';
	public $primaryKey = '_id';
	public $validate = array();
	public $actsAs=array('Mongodb.Schemaless');
	public function getDefaults(){
		$defaultValues=array(
			"escalation"=>Configure::read("scis.ticket.escalation.options.0"),
			"status"=>Configure::read("scis.ticket.status.options.0"),
			"department_id"=>NULL,
			"priority"=>Configure::read("scis.ticket.priority.options.0"),
			"browser"=>get_browser(null,true),
		);
		/**
		 * 
		 * Remove non-utf8 characters
		 * this prevents non-utf8 MongoException
		 * refer http://stackoverflow.com/a/1401716/492561
		 */
		$regex = <<<'END'
/
  (
	(?: [\x00-\x7F]                 # single-byte sequences   0xxxxxxx
	|   [\xC0-\xDF][\x80-\xBF]      # double-byte sequences   110xxxxx 10xxxxxx
	|   [\xE0-\xEF][\x80-\xBF]{2}   # triple-byte sequences   1110xxxx 10xxxxxx * 2
	|   [\xF0-\xF7][\x80-\xBF]{3}   # quadruple-byte sequence 11110xxx 10xxxxxx * 3 
	)+                              # ...one or more times
  )
| .                                 # anything else
/x
END;
		$defaultValues["browser"]["browser_name_regex"] = preg_replace($regex, '$1', $defaultValues["browser"]["browser_name_regex"]);
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
