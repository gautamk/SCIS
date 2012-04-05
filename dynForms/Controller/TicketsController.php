<?php

/**
 * Manage Ticktets in the database
 *
 * @package Controller
 * @author  Gautam
 */
class TicketsController extends AppController {
    public $helpers = array('Form', 'Html');
    public $components=array('RequestHandler');

    public function beforeFilter() {
         $this->Security->blackHoleCallback = '_blackhole';
    }
	protected function _blackhole($type) {
        
    }
    protected function _allow_only_ajax(){
        if (! $this->request->is('ajax')){
            throw new NotFoundException("View not found");
        }
    }

	/*
	 * List all available tickets 
     * @author  Gautam
	 */
    public function index() {
        // Get Data from Mongodb only if Its an Ajax Request
        if ($this->request->is('ajax')) {
            $this->disableCache();
            $this->loadModel('DynamicFormResponse');
            $tickets = $this->DynamicFormResponse->find('all');
            $this->set('tickets',$tickets);
        }
    }
    
    /**
    * @author  Gautam
    * Load a particular ticket
    * Only AJAX Requests Allowed
    */
    public function view($id=null) {

        $this->_allow_only_ajax();

        $this->response->disableCache();
        $this->loadModel('DynamicFormResponse');
        $tickets = $this->DynamicFormResponse->read(null,$id);
        if($tickets == false ){
            throw new NotFoundException("Ticket not found");
        }
        $tickets["DynamicFormResponse"]["modified"] = date('h:i:s d-M-Y ', $tickets["DynamicFormResponse"]["modified"]->sec);
        $tickets["DynamicFormResponse"]["created"] = date('h:i:s d-M-Y ', $tickets["DynamicFormResponse"]["created"]->sec);
        $this->set(compact('tickets'));
    }

    /**
    * @author  Gautam
    * Load a particular ticket and update it 
    * Only AJAX Requests Allowed
    */
    public function edit($id=null){
        $this->loadModel('DynamicFormResponse');
        
        if (!$id && empty($this->data)) {
            $this->flash(__('Invalid Ticket', true), array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->DynamicFormResponse->save($this->data)) {
                $this->flash(__('The Ticket has been updated.', true), array('action' => 'index'));
            } else {
            }
        }
        if (empty($this->data)) {
            $this->data = $this->DynamicFormResponse->read(
                array('_id','status','escalation','priority','department_id'), $id);
            
            //$this->data = $this->Post->find('first', array('conditions' => array('_id' => $id)));
        }
        
    }

} // END
