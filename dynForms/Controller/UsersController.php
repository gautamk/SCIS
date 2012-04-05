<?php

/**
 * 
 */
class UsersController extends AppController {
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login','is_logged_in');
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

    public function is_logged_in(){
        $this->autoRender = false;
        //$this->response->header(array('Content-type: application/json'));
        if($this->request->is('ajax')){
            echo json_encode(array("response"=>$this->Auth->loggedIn()));
        } else {
            echo $this->Auth->loggedIn();
        }
    }
}
