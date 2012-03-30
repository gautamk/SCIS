<?php

/**
 * 
 */
class UsersController extends AppController {
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
	}
	
	public function login(){
		//echo AuthComponent::password("password");die();
		if ($this->Auth->login()) {
        	$this->redirect($this->Auth->redirect());
    	} else {
        	$this->Session->setFlash(__('Invalid username or password, try again'));
    	}
	}
	
	public function logout() {
    	$this->redirect($this->Auth->logout());

	}
}
