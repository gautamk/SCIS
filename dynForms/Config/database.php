<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource'  => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'cake',
		'password' => 'cake',
		'database' => 'cake',
		'port'=>3306
	);
    public $mongodb=array(
        'datasource' => 'Mongodb.MongodbSource',
        'host' => 'localhost',
        'database' => 'cake',
        'port' => 27017,
        'prefix' => '',
        'persistent' => 'true',
   );
}
