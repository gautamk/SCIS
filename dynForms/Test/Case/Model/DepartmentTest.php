<?php
App::uses('Department', 'Model');

/**
 * Department Test Case
 *
 */
class DepartmentTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.department');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Department = ClassRegistry::init('Department');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Department);

		parent::tearDown();
	}

/**
 * testIsValidDepartment method
 *
 * @return void
 */
	public function testIsValidDepartment() {

	}
}
