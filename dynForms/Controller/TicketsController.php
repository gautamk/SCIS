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
        $this->loadModel('DynamicFormResponse');
        $tickets = $this->DynamicFormResponse->find('all');
        $this->set('tickets',$tickets);
    }
    
    public function view($id=null) {
        $this->loadModel('DynamicFormResponse');
        $tickets = $this->DynamicFormResponse->read(null,$id);
        if($tickets == false ){
            throw new NotFoundException("Ticket not found");
        }
        $this->set(compact('tickets'));
    }

} // END
