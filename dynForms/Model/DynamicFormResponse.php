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
			"browser"=>get_browser(null,true)
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

	public function setSchema($schema) {
		$this -> _schema = $schema;
	}

	public function getSchema() {
		return $this -> _schema;
	}

}
