<?php


/**
 * Application model for Form.
 *
 * This Model is used to fetch the dynamic form configuration form 
 * MongoDB datasource
 * 
 *
 * @package       app.Model
 * 
 * 
 * 
 * Schema structure for the database
 * array(
 *     "name" => "Form Name",
 *     "options" => array(
 *         "type" => "post",
 *         'url' => array('controller' => '<CakePHP Controller>', 
 *                         'action' => '<An Action on the controller>'),
 *     ),
 * 
 * // An array of input elements
 *     "inputs" => array(
 * 
 *         "username" => array(
 *             "placeholder" => "Enter your username",
 *         ),
 *         "password" => array(
 *             "placeholder" => "Enter your Password",
 *             "type" => "password"
 *         ),
 *     ),
 * 
 *     "submit" => "Login",
 * // The mongo Schema for the response    
 *     "mongoschema" => array(
 *         "username" => array("type" => "string"),
 *         "password" => array("type" => "string")
 *     ),
 * // The validation for the response
 *     "validation" => array(
 *         "username" => array(
 *             'alphaNumeric' => array(
 *                 'rule' => 'alphaNumeric',
 *                 'required' => true,
 *                 'message' => 'Alphabets and numbers only'
 *             ),
 *             'between' => array(
 *                 'rule' => array('between', 5, 15),
 *                 'message' => 'Between 5 to 15 characters'
 *             )
 *         ),
 *         'password' => array(
 *             'rule' => array('minLength', '8'),
 *             'message' => 'Minimum 8 characters long'
 *         ),
 *     ),
 * );
 */
class Form extends AppModel {
    public $useDbConfig = 'mongodb';  
    public $useTable = 'forms';
    public $primaryKey = '_id';
    public function setSchema($schema) {
        $this->_schema=$schema;        
    }
    
    public function getSchema(){
        return $this->_schema;
    }
    
    public function setValidationRules($validate){
        $this->validate=$validate;
    }
    
}

