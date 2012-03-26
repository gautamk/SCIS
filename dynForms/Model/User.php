<?php

class User extends AppModel{
	public $name="User";
	public $useDbConfig = 'mongodb';
	public $useTable = 'users';
	public $primaryKey = '_id';
	public $validate=array(
		'email' => 
		    array (
		      'email' => 
			      array (
			        'rule' => 'email',
			        'required' => true,
			        'message' => 'Not a valid email address',
			        'allowEmpty' => false,
			      ),
    	),
		"password"=>array (
	      'minLength' => array (
	        'rule' => array (
	          '0' => 'minLength',
	          '1' => '6',
	        ),
			'message' => 'password must be atleast 6 characters long',
		    'allowEmpty' => false,
		    ),
    	),
	);
	
	
}
