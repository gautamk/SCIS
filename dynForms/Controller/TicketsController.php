<?php

/**
 * Manage Ticktets in the database
 *
 * @package Controller
 * @author  Gautam
 */
class TicketsController extends AppController {
    public $helpers = array('Form', 'Html');

    public function beforeFilter() {
        
    }
	
	/*
	 * List all available tickets 
	 */
    public function index() {

    }
	public function getTickets(){
		$this->loadModel('DynamicFormResponse');
		$tickets = $this->DynamicFormResponse->find('all');
		$this->set('tickets',$tickets);
	}

} // END
