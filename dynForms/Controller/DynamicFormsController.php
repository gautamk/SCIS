<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynamicFormsController
 *
 * @author gautam
 */
class DynamicFormsController extends AppController {
    
    public $helpers=array('Form','Html');
    
    /**
     * Contains the form schema retrieved from the database
     * 
     * @var array 
     */
    private $form_schema = null;
    private function _csrf_error() {
        throw new BadRequestException("CSRF Error");
        }
    


    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->_csrf_error();
                break;

            default:
                break;
        }
    }

    public function beforeFilter() {
        $this->Security->blackHoleCallback = 'blackhole';
        
    }

    public function index() {
        
    }
    
    
    /**
     * Check if valid and retrieve a dynamic form
     * from the database
     * @name
     * @param type $id 
     */
    public function getForm($id=null){
        $this->loadModel('DynamicFormResponse');
        /**
         *  Check if form exists 
         */
        $this->form_schema= $this->DynamicForm->isValidForm($id);
        if($this->form_schema == false){
            throw new NotFoundException("Form not found");
        }
        /**
         * Associate form with Model 
         */
        $this->form_schema["DynamicForm"]["model"]="DynamicFormResponse";
        /**
         * Set validation schema 
         */
        $this->DynamicFormResponse->validate = $this->form_schema['DynamicForm']["validation"];
        
        /**
         * Process Form submission 
         */
        if($this->request->is("POST")==true){
            /**
             * Data Validation 
             */
            if($this->DynamicFormResponse->save($this->request->data) == true ){
                $this->set("ticket_id",  $this->DynamicFormResponse->id);
                $this->render('ticket_successfully_saved');
                return;
            }
        }        
        
        $this->set("dynamicForm",$this->form_schema["DynamicForm"]);
        $this->render('get_form');
    }
   
    /**
     *  Alias action for getForm
     *  Use for convienience 
     * @see getForm
     * @param type $id 
     */
    public function gf($id=null) {
         //$this->redirect(array('action' => 'getForm',$id));
         $this->getForm($id);
         return;
    }
}
    
   