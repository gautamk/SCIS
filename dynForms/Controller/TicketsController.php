<?php

/**
 * Load Email component
 */
App::uses('CakeEmail', 'Network/Email');
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
        $this -> Auth -> allow(array('status'));
        $this->Security->blackHoleCallback = '_blackhole';
        $this->loadModel('DynamicFormResponse');
    }
	protected function _blackhole($type) {
        
    }
    protected function _allow_only_ajax(){
        if (! $this->request->is('ajax')){
            throw new NotFoundException("View not found");
        }
    }
    /**
     * @param $id The ticket ID
     * Checks if a ticket is valid , If not throws a Not found exception.
     * If the ticket it found , It returns the result
     */
    protected function _is_valid_ticket($id=null){
        if(is_null($id)){
            throw new NotFoundException("Ticket not found");
        }
        $result = $this->DynamicFormResponse->isValidResponse($id);
        
        if(is_null($result)||$result==false){
            throw new NotFoundException("Ticket not found");
        }
        return $result;
    }

	/*
	 * List all available tickets 
     * @author  Gautam
	 */
    public function index() {
        // Get Data from Mongodb only if Its an Ajax Request
        if ($this->request->is('ajax')) {
            $this->disableCache();
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
        $tickets = $this->_is_valid_ticket($id);
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
    * 
    */
    public function edit($id=null){
        
        if (!$id && empty($this->data)) {
            throw new NotFoundException("Ticket not Found");
        }
        if($this->DynamicFormResponse->isValidResponse($id) == false){
            throw new NotFoundException("Ticket not Found");
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

    protected function _send_email($to=null,$subject=null,$view_vars=null){
        if(is_null($to)||
           is_null($subject)||
           is_null($view_vars)
           ){
            return false;
        }
        $email = new CakeEmail('gmail');
        return $email   ->template('default', null)
                        ->emailFormat('both')
                        ->from(Configure::read("email.from"))
                        ->to($to)
                        ->subject($subject)
                        ->viewVars($view_vars)
                        ->send();
        
    }

    public function email($id=null){
        $result = $this->_is_valid_ticket($id);
        if($this->request->is("get")){
            $this->set("get",true);
            $this->set("email",
                isset($result["DynamicFormResponse"]["email"])?$result["DynamicFormResponse"]["email"]:false);
            $this->set("id",$result["DynamicFormResponse"]["_id"]);
        }
        if($this->request->is("post")){
            $this->_send_email(
                $this->data["email"]["to"],
                $this->data["email"]["subject"],
                array(
                    "message"=>$this->data["email"]["message"],
                    "id"=>$id,
                    "status"=>$result["DynamicFormResponse"]["status"]
                )
            );
            $this->autoRender=false;
            $this->flash("Email has been sent ",array(
                         "controller"=>"tickets",
                         "action"=>"index",
            ));
        }
    }

    public function status($id=null){
        if(is_null($id)){
            $this->set("ticket",false);
        } else {
            $result = $this->_is_valid_ticket($id);
            $this->set("ticket",$result);
        }
    }

} // END
