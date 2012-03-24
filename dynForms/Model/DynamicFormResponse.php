<?php
class DynamicFormResponse extends AppModel {
	public $name="DynamicFormResponse";
	public $useDbConfig = 'mongodb';
	public $useTable = 'dynamicFormResponse';
	public $primaryKey = '_id';
	public $validate = array();

	public function getDefaults(){
		$defaultValues=array(
			"escalation"=>0,
			"status"=>"pending",
			"department_id"=>NULL,
			"user_agent"=>env("HTTP_USER_AGENT")
		);
		return $defaultValues;
	}

	public function setSchema($schema) {
		$this -> _schema = $schema;
	}

	public function getSchema() {
		return $this -> _schema;
	}

}
